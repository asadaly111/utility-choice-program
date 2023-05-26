<?php

namespace App\Http\Controllers\Api;

use PDF;
use App\Models\Account;
use App\Models\Contract;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\CommercialRate;
use DocuSign\eSign\Model\Tabs;
use DocuSign\eSign\Model\Signer;
use DocuSign\eSign\Model\SignHere;
use App\Http\Controllers\Controller;
use DocuSign\eSign\Client\ApiClient;
use DocuSign\eSign\Model\Recipients;
use App\Http\Resources\ContractResource;
use DocuSign\eSign\Model\InlineTemplate;
use DocuSign\eSign\Model\CompositeTemplate;
use DocuSign\eSign\Model\EnvelopeDefinition;
use DocuSign\eSign\Api\EnvelopesApi;

class ContractController extends Controller
{
    private $config;

    private $signer_client_id = 1000;

    private $args;

    //
    public function index(Request $request)
    {

        $contracts = Contract::query()
            ->with('customer', 'account', 'user')
            ->applyFilters($request)
            ->when($request->perPage, function ($query, $perPage) {
                return $query->orderByDesc('id')->paginate($perPage);
            }, function ($query) {
            return $query->orderByDesc('id')->get();
        });

        return ContractResource::collection($contracts);
    }

    public function store(Request $request)
    {

        $commercialRate = CommercialRate::where('id', $request->rate_id)->first();
        $customerAccount = Account::where('id', $request->account_id)->first();
        $customer = Customer::find($request->customer_id);

        $user = $request->user();

        $contract = Contract::create([
            'user_id' => $user->id,
            'customer_id' => $customer->id,
            'account_id' => $request->account_id,
            'state' => $commercialRate->state,
            'utility' => $commercialRate->utility,
            'account_number' => $customerAccount->account_number,
            'ein' => $customer->ein,
            'commodity' => $commercialRate->commodity,
            'supplier' => $commercialRate->supplier,
            'product' => $commercialRate->product,
            'start_month' => $commercialRate->start_month,
            'rate_class' => $commercialRate->rate_class,
            'current_rate' => $commercialRate->current_rate,
            'volume' => $commercialRate->demand_size,
            'status' => 'Draft',
            // 'flag' => $commercialRate->customer_id,
        ]);


        $this->generateDownload($contract->id);

        return response()->json([
            'message' => 'Contract successfully created.',
            'contract' => $contract,
        ], 200);

    }

    public function show(Contract $contract)
    {
        return new ContractResource($contract);
    }

    public function update(Request $request, Contract $contract)
    {
        $contract->update($request->all());

        return new ContractResource($contract);
    }

    public function destroy(Contract $contract)
    {
        $contract->delete();

        return response()->json(null, 204);
    }

    public function sendContractForSignature(Request $request, $contractId)
    {
        $contract = Contract::find($contractId);
        $contract->update([
            'status' => 'Sent',
        ]);
        $contract->load('customer', 'account');
        $this->sendEnvelopeForSignature($contract);

        return response()->json([
            'message' => 'Contract successfully sent.',
            'contract' => $contract,
        ], 200);
    }

    public function sendEnvelopeForSignature($contract)
    {

        $apiClient = new ApiClient();
        $apiClient->getOAuth()->setOAuthBasePath(env('DS_AUTH_SERVER'));
        try {
            $accessToken = $this->getToken($apiClient);
        } catch (\Throwable $th) {
            dd($th->getMessage());

        }

        $userInfo = $apiClient->getUserInfo($accessToken);
        $accountInfo = $userInfo[0]->getAccounts();
        $apiClient->getConfig()->setHost($accountInfo[0]->getBaseUri() . env('DS_ESIGN_URI_SUFFIX'));
        $envelopeDefenition = $this->buildEnvelope($contract);
        try {
            $envelopeApi = new EnvelopesApi($apiClient);
            $result = $envelopeApi->createEnvelope($accountInfo[0]->getAccountId(), $envelopeDefenition);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            // return back()->withError($th->getMessage())->withInput();
        }
    }

    public function getToken(ApiClient $apiClient)
    {
        try {
            $privateKey = file_get_contents(storage_path(env('DOCUSIGN_PRIVATE_KEY_FILE')), true);
            $response = $apiClient->requestJWTUserToken(
                $ikey = env('DOCUSIGN_CLIENT_ID'),
                $userId = env('DOCUSIGN_IMPERSONATED_USER_GUID'),
                $key = $privateKey,
                $scope = 'signature impersonation'
            );
            $token = $response[0];
            $accessToken = $token->getAccessToken();
        } catch (\Throwable $th) {
            throw $th;
        }

        return $accessToken;
    }

    private function buildEnvelope($contract): EnvelopeDefinition
    {

        $contractPdf = asset('storage/contracts/' . $contract->id . '-contract.pdf');

        $arrContextOptions = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
            ],
        ];

        $content_bytes = file_get_contents($contractPdf, false, stream_context_create($arrContextOptions));
        // dd($content_bytes);
        $base64_file_content = base64_encode($content_bytes);
        // Create the document model
        $document = new \DocuSign\eSign\Model\Document([ // create the DocuSign document object
            'document_base64' => $base64_file_content,
            'name' => 'Contract',
            // can be different from actual file name
            'file_extension' => 'pdf',
            // many different document types are accepted
            'document_id' => 1, // a label used to reference the doc
        ]);

        $sign_here_tab = new SignHere([
            'anchor_string' => '**Customer Signature**',
            'anchor_units' => 'pixels',
            'anchor_x_offset' => '100',
            'anchor_y_offset' => '0',
        ]);
        $sign_here_tabs = [$sign_here_tab];
        $tabs1 = new Tabs([
            'sign_here_tabs' => $sign_here_tabs,
        ]);
        $signer = new Signer([
            'email' => $contract->customer->email,
            'name' => $contract->customer->name,
            'recipient_id' => '1',
            'tabs' => $tabs1,
        ]);
        $signers = [$signer];
        $recipients = new Recipients([
            'signers' => $signers,
        ]);
        $inline_template = new InlineTemplate([
            'recipients' => $recipients,
            'sequence' => '1',
        ]);
        $inline_templates = [$inline_template];
        $composite_template = new CompositeTemplate([
            'composite_template_id' => '1',
            'document' => $document,
            'inline_templates' => $inline_templates,
        ]);
        $composite_templates = [$composite_template];
        $envelope_definition = new EnvelopeDefinition([
            'composite_templates' => $composite_templates,
            'email_subject' => 'Please sign',
            'status' => 'sent',
        ]);

        return $envelope_definition;

    }

    // contractDownload
    public function generateDownload($contractId)
    {

        $contract = Contract::with('customer','account')->find($contractId);
        $pdf = \App::make('dompdf.wrapper');
        // $pdf->loadView('welcome');
        $pdf->setOption('fontDir', public_path('/fonts'));

        $pdf = $pdf->loadView('pdf.energy_harbor_contract', compact('contract'));

        if (!file_exists(storage_path('app/public/contracts'))) {
            mkdir(storage_path('app/public/contracts'), 0777, true);
        }

        // store pdf file
        $pdf->save(storage_path('app/public/contracts/' . $contract->id . '-contract.pdf'));

        // return $pdf->download($contract->id . '-contract.pdf');

    }

    // contractDownload
    public function contractDownload(Request $request, $contractId)
    {

        // download pdf from storage
        return response()->download(storage_path('app/public/contracts/' . $contractId . '-contract.pdf'));

    }
}
