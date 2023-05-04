<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ContractResource;
use App\Models\Account;
use App\Models\CommercialRate;
use App\Models\Contract;
use App\Models\Customer;
use Illuminate\Http\Request;

class ContractController extends Controller
{
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
}
