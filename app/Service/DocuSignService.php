<?php

namespace App\Service;

use DocuSign\eSign\Client\ApiClient;
use DocuSign\eSign\Client\Auth\OAuth;
use DocuSign\eSign\Configuration;
use Throwable;

class DocuSignService
{

    // docu sign api calls

    public function getFolders()
    {

        // $host = "https://demo.docusign.net/restapi";
        // $auth_server = "account-d.docusign.com";

        // $client = new Client([
        //     // 'impersonated_user_id' => $impersonated_user_id,
        //     'integrator_key' => config('docusign.integrator_key'),
        //     'host' => config('docusign.host'),
        //     'private_key' => config('docusign.private_key'),
        //     'auth_server' => $auth_server,
        // ]);

        $config = (new Configuration())->setHost(config('docusign.host'));
        $oAuth = (new OAuth())->setOAuthBasePath(config('docusign.oauth_base_path'));

        $apiClient = new ApiClient($config, $oAuth);

        try {
            $response = $apiClient->requestJWTUserToken(
                config('docusign.integrator_key'),
                // config('docusign.user_id'),
                // config('docusign.private_key'),
                'signature impersonation',
                60
            );

            if ($response) {
                $accessToken = $response[0]['access_token'];

                $accuntInfo = $apiClient->getUserInfo($accessToken);
                $accountId = $accuntInfo[0]['accounts'][0]['account_id'];

                $config->addDefaultHeader('Authorization', 'Bearer ' . $accessToken);

                $apiClient = new ApiClient($config);

                return $apiClient->envelopes->getFormData('1234');
            }
        } catch (Throwable $th) {
            dd($th);
            $authorizationUrl = config('docusign.oauth_base_path') . '/oauth/auth?' . http_build_query([
                'scope' => 'signature impersonation',
                'redirect_uri' => config('docusign.redirect_url'),
                'client_id' => config('docusign.integrator_key'),
                'response_type' => 'code',
            ]);

            dd($authorizationUrl);
        }

        return $apiClient;
    }

    // $client = DocuSign::create();

    // $lists = DocuSign::get('folders')->callList();

    // dd($lists);

    // $username = "gufukofap@mailinator.com";
    // $password = "shoaib123";
    // $integrator_key = "2594a7bf-df85-4d7b-9d97-a0dca62ababd";

    // // change to production before going live
    // $host = "https://demo.docusign.net/restapi";

    // // create configuration object and configure custom auth header
    // $config = new Configuration();
    // $config->setHost($host);
    // $config->addDefaultHeader("X-DocuSign-Authentication", "{\"Username\":\"" . $username . "\",\"Password\":\"" . $password . "\",\"IntegratorKey\":\"" . $integrator_key . "\"}");

    // // instantiate a new docusign api client
    // $apiClient = new ApiClient($config);
    // $accountId = null;

    // try
    // {
    //     //*** STEP 1 - Login API
    //     $authenticationApi = new AuthenticationApi($apiClient);
    //     $options = new \DocuSign\eSign\Api\AuthenticationApi\LoginOptions ();
    //     $loginInformation = $authenticationApi->login($options);
    //     // dd($loginInformation);
    //     if (isset($loginInformation)) {
    //         $loginAccount = $loginInformation->getLoginAccounts()[0];
    //         if (isset($loginInformation)) {
    //             $accountId = $loginAccount->getAccountId();
    //             if (!empty($accountId)) {
    //                 //*** STEP 2 - Signature Request from a Template
    //                 // create envelope call is available in the EnvelopesApi
    //                 $envelopeApi = new EnvelopesApi($apiClient);
    //                 // assign recipient to template role by setting name, email, and role name.  Note that the
    //                 // template role name must match the placeholder role name saved in your account template.
    //                 $templateRole = new TemplateRole();
    //                 $templateRole->setEmail("gufukofap@mailinator.com");
    //                 $templateRole->setName("Asad ali");
    //                 $templateRole->setRoleName("Customer");

    //                 // instantiate a new envelope object and configure settings
    //                 $envelop_definition = new EnvelopeDefinition();
    //                 $envelop_definition->setEmailSubject("[DocuSign PHP SDK] - Signature Request Sample");
    //                 $envelop_definition->setTemplateId("91b5a0c1-38c4-42da-b8dd-cad3f4c3076a");
    //                 $envelop_definition->setTemplateRoles(array($templateRole));

    //                 // set envelope status to "sent" to immediately send the signature request
    //                 $envelop_definition->setStatus("sent");

    //                 // $templateRoleope parameters
    //                 $options = new \DocuSign\eSign\Api\EnvelopesApi\CreateEnvelopeOptions ();
    //                 $options->setCdseMode(null);
    //                 $options->setMergeRolesOnDraft(null);

    //                 // create and send the envelope (aka signature request)
    //                 $envelop_summary = $envelopeApi->createEnvelope($accountId, $envelop_definition, $options);
    //                 dd($envelop_summary);
    //                 if (!empty($envelop_summary)) {
    //                     echo "$envelop_summary";
    //                 }
    //             }
    //         }
    //     }
    // } catch (ApiException $ex) {
    //     echo "Exception: " . $ex->getMessage() . "\n";
    // }

}
