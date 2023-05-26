<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <style>
        * {
            margin: 0px;
            padding: 0px;
        }

        @page {
            margin: 20px;
        }

        @font-face {
            font-family: 'Inter';
            font-weight: normal;
            font-style: normal;
            font-variant: normal;
            src: url('fonts/Inter-Regular.ttf') format('truetype');
        }

        @font-face {
            font-family: 'Inter';
            font-weight: 600;
            font-style: normal;
            font-variant: normal;
            src: url('fonts/Inter-Semibold.ttf') format('truetype');
        }

        @font-face {
            font-family: 'Inter';
            font-weight: 700;
            font-style: normal;
            font-variant: normal;
            src: url('fonts/Inter-Bold.ttf') format('truetype');
        }

        body {
            margin: 20px;
            font-family: 'Inter'
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Inter';
            font-weight: 600;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"] {
            border: none;
            border-bottom: 1px solid #000;
            width: 100%;
            height: 15px;
        }

        input[type=checkbox],
        input[type=radio] {
            width: 18px;
            height: 18px;
        }

        table {
            width: 100%;
        }

        table th,
        table td {
            padding: 4px 6px;
        }

        ul li,
        ol li {
            margin-bottom: 5px;
        }
    </style>
</head>


<body style="font-size: 10px;">
    <table style="width: 100%;">
        <tbody>
            <tr>
                <td>
                    <table style="width: 100%">
                        <tbody>
                            <td style="width: 150px">
                                <img src="images/energy_harbor.jpg" width="100">
                            </td>
                            <td style="text-align: center;">
                                <h4 style="font-size: 14px; margin-bottom: 0px; color: #004270;">Energy Harbor LLC</h4>
                                <p style="margin-bottom: 10px;color: #004270">Pennsylvania Electric Supply Agreement
                                    Pricing Attachment -
                                    Small Commercial<br>
                                </p>
                            </td>
                            <td style="width: 150px">
                            </td>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="font-size: 9px;">
                    By executing this completed Pricing Attachment, Customer acknowledges agreement with the terms and
                    conditions as set
                    forth
                    in the Disclosure Statement that accompanies this Pricing Attachment (together the “Agreement”).
                </td>
            </tr>
        </tbody>
    </table>
    <table style="margin-top: 10px; border-collapse: collapse;">
        <tr>
            <th style="padding: 5px 10px; background: #C9D1E1; color: #004270; text-align: left">
                CUSTOMER INFORMATION
            </th>
        </tr>
    </table>
    <table style="border-collapse: collapse">
        <tr>
            <th style="width: 1px; white-space: nowrap; text-align: left;border: 1px solid #444;">Company:</th>
            <td colspan="2" style="text-align: left; border: 1px solid #444;"></td>
        </tr>
        <tr>
            <th style="width: 1px; white-space: nowrap; text-align: left; border: 1px solid #444;">Billing Address:</th>
            <td colspan="2" style="text-align: left; border: 1px solid #444;">{{ $contract->customer->billing_address }}</td>
        </tr>
        <tr>
            <th style="width: 1px; white-space: nowrap; text-align: left; border: 1px solid #444; width: 50%;">City:
            </th>
            <td style="width: 40%;text-align: left; border: 1px solid #444;">{{ $contract->customer->city }}</td>
            <td style="text-align: left; border: 1px solid #444; padding: 0px;">
                <table style="border-collapse: collapse">
                    <tr>
                        <th style="width: 1px; white-space: nowrap; text-align: left; border-right: 1px solid #444;">
                            State:</th>
                        <td style="text-align: left; border-right: 1px solid #444;">{{ $contract->customer->state }}</td>
                        <th style="width: 1px; white-space: nowrap; text-align: left; border-right: 1px solid #444;">
                            Zip:</th>
                        <td style="text-align: left;">{{ $contract->customer->zip }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <th style="width: 1px; white-space: nowrap; text-align: left; border: 1px solid #444;">Contact Phone:</th>
            <td style="text-align: left; border: 1px solid #444;"></td>
            <td style="text-align: left; border: 1px solid #444; padding: 0px;">
                <table style="border-collapse: collapse">
                    <tr>
                        <th style="width: 1px; white-space: nowrap; text-align: left; border-right: 1px solid #444;">
                            Email:
                        </th>
                        <td style="text-align: left;">{{ $contract->customer->email }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <th style="width: 1px; white-space: nowrap; text-align: left; border: 1px solid #444;">Federal Tax ID:</th>
            <td style="text-align: left; border: 1px solid #444;"></td>
            <td style="text-align: left; border: 1px solid #444;">
                <div>Tax Exempt (If “yes” please submit copy of certificate with contract):</div>
                <input type="checkbox"><span>Yes</span>
                <input type="checkbox"><span>No</span>
            </td>
        </tr>
    </table>
    <table style="margin-top: 10px; border-collapse: collapse;">
        <tr>
            <th style="padding: 5px 10px; background: #C9D1E1; color: #004270; text-align: left">
                ACCOUNT INFORMATION <small>(if more than 1 account, please complete page 2):</small>
            </th>
        </tr>
    </table>
    <table style="border-collapse: collapse">
        <tr>
            <th style="width: 1px; white-space: nowrap; text-align: left;border: 1px solid #444;">Account #:</th>
            <td colspan="2" style="text-align: left; border: 1px solid #444;">{{ $contract->account->account_number }}</td>
        </tr>
        <tr>
            <th style="width: 1px; white-space: nowrap; text-align: left; border: 1px solid #444;">Service Address:</th>
            <td colspan="2" style="text-align: left; border: 1px solid #444;"></td>
        </tr>
        <tr>
            <th style="width: 1px; white-space: nowrap; text-align: left; border: 1px solid #444; width: 50%;">City:
            </th>
            <td style="width: 40%;text-align: left; border: 1px solid #444;">{{ $contract->customer->city }}</td>
            <td style="text-align: left; border: 1px solid #444; padding: 0px;">
                <table style="border-collapse: collapse">
                    <tr>
                        <th style="width: 1px; white-space: nowrap; text-align: left; border-right: 1px solid #444;">
                            State:</th>
                        <td style="text-align: left; border-right: 1px solid #444;">{{ $contract->customer->state }}</td>
                        <th style="width: 1px; white-space: nowrap; text-align: left; border-right: 1px solid #444;">
                            Zip:</th>
                        <td style="text-align: left;">{{ $contract->customer->zip }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <th style="width: 1px; white-space: nowrap; text-align: left; border: 1px solid #444;">Mailing
                Address:</th>
            <td colspan="2" style="text-align: left; border: 1px solid #444;"></td>
        </tr>
    </table>
    <table style="margin-top: 10px; border-collapse: collapse;">
        <tr>
            <th style="padding: 5px 10px; background: #C9D1E1; color: #004270; text-align: left">
                EDC/ELECTRIC UTILITY (CHECK ONE): <small>Pennsylvania Power (Penn Power)</small>
            </th>
        </tr>
    </table>
    <table style="border-collapse: collapse">
        <tr>
            <td colspan="2" style="text-align: left; border: 1px solid #444;">
                <table>
                    <tr>
                        <td><input type="checkbox">Duquesne Light Co</td>
                        <td><input type="checkbox">Metropolitan Edison</td>
                        <td><input type="checkbox">PECO Energy</td>
                        <td><input type="checkbox">Penelec</td>
                    </tr>
                    <tr>
                        <td><input type="checkbox">Penn Power</td>
                        <td><input type="checkbox">PPL Electric</td>
                        <td><input type="checkbox">West Penn Power</td>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table style="margin-top: 10px; border-collapse: collapse;">
        <tr>
            <th style="padding: 5px 10px; background: #C9D1E1; color: #004270; text-align: left">
                CONTRACT END TERM: {{ $contract->contract_end_date }}
            </th>
        </tr>
    </table>
    <table style="border-collapse: collapse">
        <tr>
            <td colspan="2" style="text-align: left; border: 1px solid #444;">
                <table style="width: auto;">
                    <tr>
                        <td>
                            <input type="text" style="min-width: 100px;">
                        </td>
                        <td style="width: 1px; white-space: nowrap;">Months</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table style="margin-top: 10px;border-collapse: collapse">
        <tr>
            <th style="padding: 5px 10px; background: #C9D1E1; color: #004270; text-align: left">
                PRICE STRUCTURE: FIXED
            </th>
        </tr>
    </table>
    <table style="border-collapse: collapse">
        <tr>
            <th style="border: 1px solid #444;">
                Generation/Supply Price (kWh)* {{ $contract->current_rate }}
            </th>
            <th style="border: 1px solid #444;">
                Contract Start Date (MM/YY)* {{ $contract->contract_start_date }}
            </th>
        </tr>
        <tr>
            <td style="border: 1px solid #444;">
                <table style="margin: auto; width: 200px;">
                    <tr>
                        <td>
                            <input type="text">
                        </td>
                        <td style="width: 1px; white-space: nowrap;">$/kWh</td>
                    </tr>
                </table>
            </td>
            <td style="border: 1px solid #444;">
                <table style="margin: auto; width: 200px;">
                    <tr>
                        <td>
                            <input type="text">
                        </td>
                        <td style="width: 1px; white-space: nowrap;">/</td>
                        <td>
                            <input type="text">
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <p style="margin: 10px 0;font-style: italic;">
        *The Contract Start Date is an estimate only and shall be determined by your local electric utility in
        accordance with
        its
        rules and practices regarding the switching of customers to suppliers. Energy Harbor has no liability related to
        the
        date
        on which your electric utility switches your service to Energy Harbor. Your service from Energy Harbor will be
        provided for the contract term indicated above, once your service has been switched to Energy Harbor.</p>
    <p style="margin: 10px 0;">
        I hereby agree to purchase electricity from Energy Harbor under the terms and conditions as set forth in the
        Disclosure
        Statement that
        were included and presented with this offer (hereinafter “Terms and Conditions”). I understand and agree to
        those Terms
        and
        Conditions. I affirm that I am an authorized representative of the company listed below and that I have the
        authority to
        make decisions
        on behalf of the company regarding its choice of Energy Harbor for its electric generation supplier. Energy
        Harbor has
        my permission
        to obtain the past and current electric usage data of the company for the accounts listed below.</p>
    <table>
        <tr>
            <td colspan="2">
                <p style="margin-bottom: 5px;">
                    <strong>Accepted and Agreed to:</strong>
                </p>
            </td>
        </tr>
        <tr>
            <td style="width: 50%;">
                <strong>Customer:</strong>
                <table>
                    <tr>
                        <td style="padding: 0px;width: 1px; white-space: nowrap">Sign:</td>
                        <td style="vertical-align: bottom; padding: 0px;">
                            <span style="width: 100%; border-bottom: 1px solid #444; display:block;"></span>
                        </td>
                    </tr>
                </table>
                <table style="margin-bottom: 5px;">

                    <tr>
                        <td style="padding: 0px;width: 1px; white-space: nowrap">Print Name:</td>
                        <td style="vertical-align: bottom; padding: 0px;">
                            <span style="width: 100%; border-bottom: 1px solid #444; display:block;"></span>
                        </td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <td style="padding: 0px;width: 1px; white-space: nowrap">Title:</td>
                        <td style="vertical-align: bottom; padding: 0px;">
                            <span style="width: 100%; border-bottom: 1px solid #444; display:block;"></span>
                        </td>
                    </tr>
                </table>
                <table>

                    <tr>
                        <td style="padding: 0px;width: 1px; white-space: nowrap">Date:</td>
                        <td style="vertical-align: bottom; padding: 0px;">
                            <span style="width: 100%; border-bottom: 1px solid #444; display:block;"></span>
                        </td>
                    </tr>
                </table>
            </td>
            <td>
                <strong>Energy Harbor LLC:</strong>
                <table>
                    <tr>
                        <td style="padding: 0px;width: 1px; white-space: nowrap">Sign:</td>
                        <td style="vertical-align: bottom; padding: 0px;">
                            <span style="width: 100%; border-bottom: 1px solid #444; display:block;"></span>
                        </td>
                    </tr>
                </table>
                <table style="margin-bottom: 5px;">
                    <tr>
                        <td style="padding: 0px;width: 1px; white-space: nowrap">Print Name:</td>
                        <td style="vertical-align: bottom; padding: 0px;">
                            <span style="width: 100%; border-bottom: 1px solid #444; display:block;"></span>
                        </td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <td style="padding: 0px;width: 1px; white-space: nowrap">Title:</td>
                        <td style="vertical-align: bottom; padding: 0px;">
                            <span style="width: 100%; border-bottom: 1px solid #444; display:block;"></span>
                        </td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <td style="padding: 0px;width: 1px; white-space: nowrap">Date:</td>
                        <td style="vertical-align: bottom; padding: 0px;">
                            <span style="width: 100%; border-bottom: 1px solid #444; display:block;"></span>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table style="width: 100%;page-break-before:always">
        <tbody>
            <tr>
                <td>
                    <table style="width: 100%">
                        <tbody>
                            <td style="width: 150px">
                                <img src="images/energy_harbor.jpg" width="100">
                            </td>
                            <td style="text-align: center;">
                                <h4 style="font-size: 14px; margin-bottom: 0px; color: #004270;">Energy Harbor LLC</h4>
                                <p style="margin-bottom: 10px;color: #004270">Supply Agreement Pricing Attachment –
                                    Additional Accounts<br>
                                </p>
                            </td>
                            <td style="width: 150px">
                            </td>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <table style="margin-top: 10px;border-collapse: collapse;">
        <tr>
            <th style="padding: 5px 10px; background: #C9D1E1; color: #004270; text-align: left">
                ACCOUNT INFORMATION <small>(Only to be used if more than 1 account from Page 1. Please attach as many
                    additional pages as
                    necessary.)</small>:
            </th>
        </tr>
    </table>
    <table style="border-collapse: collapse; margin-bottom: 5px; page-break-inside: avoid;">
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                Account #:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
            <th style="width: 15%; text-align: left; white-space: nowrap; border: 1px solid #444;">
                Service Address:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
        </tr>
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                City:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
            <td style="width: 35%; border: 1px solid #444; padding: 0px;">
                <table style="border-collapse: collapse">
                    <tr>
                        <th
                            style="width: 1px; white-space: nowrap; text-align: left; white-space: nowrap; border-right: 1px solid #444;">
                            State:
                        </th>
                        <td></td>
                    </tr>
                </table>
            </td>
            <td style="width: 35%; border: 1px solid #444; padding: 0px;">
                <table style="border-collapse: collapse">
                    <tr>
                        <th
                            style="width: 1px; white-space: nowrap;text-align: left; white-space: nowrap; border-right: 1px solid #444;">
                            Zip:
                        </th>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                Mailing
                Address:
            </th>
            <td colspan="3" style="width: 35%; border: 1px solid #444;"></td>
        </tr>
    </table>
    <table style="border-collapse: collapse; margin-bottom: 5px; page-break-inside: avoid;">
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                Account #:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
            <th style="width: 15%; text-align: left; white-space: nowrap; border: 1px solid #444;">
                Service Address:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
        </tr>
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                City:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
            <td style="width: 35%; border: 1px solid #444; padding: 0px;">
                <table style="border-collapse: collapse">
                    <tr>
                        <th
                            style="width: 1px; white-space: nowrap; text-align: left; white-space: nowrap; border-right: 1px solid #444;">
                            State:
                        </th>
                        <td></td>
                    </tr>
                </table>
            </td>
            <td style="width: 35%; border: 1px solid #444; padding: 0px;">
                <table style="border-collapse: collapse">
                    <tr>
                        <th
                            style="width: 1px; white-space: nowrap;text-align: left; white-space: nowrap; border-right: 1px solid #444;">
                            Zip:
                        </th>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                Mailing
                Address:
            </th>
            <td colspan="3" style="width: 35%; border: 1px solid #444;"></td>
        </tr>
    </table>
    <table style="border-collapse: collapse; margin-bottom: 5px; page-break-inside: avoid;">
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                Account #:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
            <th style="width: 15%; text-align: left; white-space: nowrap; border: 1px solid #444;">
                Service Address:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
        </tr>
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                City:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
            <td style="width: 35%; border: 1px solid #444; padding: 0px;">
                <table style="border-collapse: collapse">
                    <tr>
                        <th
                            style="width: 1px; white-space: nowrap; text-align: left; white-space: nowrap; border-right: 1px solid #444;">
                            State:
                        </th>
                        <td></td>
                    </tr>
                </table>
            </td>
            <td style="width: 35%; border: 1px solid #444; padding: 0px;">
                <table style="border-collapse: collapse">
                    <tr>
                        <th
                            style="width: 1px; white-space: nowrap;text-align: left; white-space: nowrap; border-right: 1px solid #444;">
                            Zip:
                        </th>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                Mailing
                Address:
            </th>
            <td colspan="3" style="width: 35%; border: 1px solid #444;"></td>
        </tr>
    </table>
    <table style="border-collapse: collapse; margin-bottom: 5px; page-break-inside: avoid;">
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                Account #:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
            <th style="width: 15%; text-align: left; white-space: nowrap; border: 1px solid #444;">
                Service Address:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
        </tr>
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                City:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
            <td style="width: 35%; border: 1px solid #444; padding: 0px;">
                <table style="border-collapse: collapse">
                    <tr>
                        <th
                            style="width: 1px; white-space: nowrap; text-align: left; white-space: nowrap; border-right: 1px solid #444;">
                            State:
                        </th>
                        <td></td>
                    </tr>
                </table>
            </td>
            <td style="width: 35%; border: 1px solid #444; padding: 0px;">
                <table style="border-collapse: collapse">
                    <tr>
                        <th
                            style="width: 1px; white-space: nowrap;text-align: left; white-space: nowrap; border-right: 1px solid #444;">
                            Zip:
                        </th>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                Mailing
                Address:
            </th>
            <td colspan="3" style="width: 35%; border: 1px solid #444;"></td>
        </tr>
    </table>
    <table style="border-collapse: collapse; margin-bottom: 5px; page-break-inside: avoid;">
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                Account #:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
            <th style="width: 15%; text-align: left; white-space: nowrap; border: 1px solid #444;">
                Service Address:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
        </tr>
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                City:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
            <td style="width: 35%; border: 1px solid #444; padding: 0px;">
                <table style="border-collapse: collapse">
                    <tr>
                        <th
                            style="width: 1px; white-space: nowrap; text-align: left; white-space: nowrap; border-right: 1px solid #444;">
                            State:
                        </th>
                        <td></td>
                    </tr>
                </table>
            </td>
            <td style="width: 35%; border: 1px solid #444; padding: 0px;">
                <table style="border-collapse: collapse">
                    <tr>
                        <th
                            style="width: 1px; white-space: nowrap;text-align: left; white-space: nowrap; border-right: 1px solid #444;">
                            Zip:
                        </th>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                Mailing
                Address:
            </th>
            <td colspan="3" style="width: 35%; border: 1px solid #444;"></td>
        </tr>
    </table>
    <table style="border-collapse: collapse; margin-bottom: 5px; page-break-inside: avoid;">
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                Account #:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
            <th style="width: 15%; text-align: left; white-space: nowrap; border: 1px solid #444;">
                Service Address:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
        </tr>
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                City:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
            <td style="width: 35%; border: 1px solid #444; padding: 0px;">
                <table style="border-collapse: collapse">
                    <tr>
                        <th
                            style="width: 1px; white-space: nowrap; text-align: left; white-space: nowrap; border-right: 1px solid #444;">
                            State:
                        </th>
                        <td></td>
                    </tr>
                </table>
            </td>
            <td style="width: 35%; border: 1px solid #444; padding: 0px;">
                <table style="border-collapse: collapse">
                    <tr>
                        <th
                            style="width: 1px; white-space: nowrap;text-align: left; white-space: nowrap; border-right: 1px solid #444;">
                            Zip:
                        </th>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                Mailing
                Address:
            </th>
            <td colspan="3" style="width: 35%; border: 1px solid #444;"></td>
        </tr>
    </table>
    <table style="border-collapse: collapse; margin-bottom: 5px; page-break-inside: avoid;">
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                Account #:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
            <th style="width: 15%; text-align: left; white-space: nowrap; border: 1px solid #444;">
                Service Address:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
        </tr>
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                City:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
            <td style="width: 35%; border: 1px solid #444; padding: 0px;">
                <table style="border-collapse: collapse">
                    <tr>
                        <th
                            style="width: 1px; white-space: nowrap; text-align: left; white-space: nowrap; border-right: 1px solid #444;">
                            State:
                        </th>
                        <td></td>
                    </tr>
                </table>
            </td>
            <td style="width: 35%; border: 1px solid #444; padding: 0px;">
                <table style="border-collapse: collapse">
                    <tr>
                        <th
                            style="width: 1px; white-space: nowrap;text-align: left; white-space: nowrap; border-right: 1px solid #444;">
                            Zip:
                        </th>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                Mailing
                Address:
            </th>
            <td colspan="3" style="width: 35%; border: 1px solid #444;"></td>
        </tr>
    </table>
    <table style="border-collapse: collapse; margin-bottom: 5px; page-break-inside: avoid;">
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                Account #:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
            <th style="width: 15%; text-align: left; white-space: nowrap; border: 1px solid #444;">
                Service Address:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
        </tr>
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                City:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
            <td style="width: 35%; border: 1px solid #444; padding: 0px;">
                <table style="border-collapse: collapse">
                    <tr>
                        <th
                            style="width: 1px; white-space: nowrap; text-align: left; white-space: nowrap; border-right: 1px solid #444;">
                            State:
                        </th>
                        <td></td>
                    </tr>
                </table>
            </td>
            <td style="width: 35%; border: 1px solid #444; padding: 0px;">
                <table style="border-collapse: collapse">
                    <tr>
                        <th
                            style="width: 1px; white-space: nowrap;text-align: left; white-space: nowrap; border-right: 1px solid #444;">
                            Zip:
                        </th>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                Mailing
                Address:
            </th>
            <td colspan="3" style="width: 35%; border: 1px solid #444;"></td>
        </tr>
    </table>
    <table style="border-collapse: collapse; margin-bottom: 5px; page-break-inside: avoid;">
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                Account #:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
            <th style="width: 15%; text-align: left; white-space: nowrap; border: 1px solid #444;">
                Service Address:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
        </tr>
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                City:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
            <td style="width: 35%; border: 1px solid #444; padding: 0px;">
                <table style="border-collapse: collapse">
                    <tr>
                        <th
                            style="width: 1px; white-space: nowrap; text-align: left; white-space: nowrap; border-right: 1px solid #444;">
                            State:
                        </th>
                        <td></td>
                    </tr>
                </table>
            </td>
            <td style="width: 35%; border: 1px solid #444; padding: 0px;">
                <table style="border-collapse: collapse">
                    <tr>
                        <th
                            style="width: 1px; white-space: nowrap;text-align: left; white-space: nowrap; border-right: 1px solid #444;">
                            Zip:
                        </th>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                Mailing
                Address:
            </th>
            <td colspan="3" style="width: 35%; border: 1px solid #444;"></td>
        </tr>
    </table>
    <table style="border-collapse: collapse; margin-bottom: 5px; page-break-inside: avoid;">
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                Account #:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
            <th style="width: 15%; text-align: left; white-space: nowrap; border: 1px solid #444;">
                Service Address:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
        </tr>
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                City:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
            <td style="width: 35%; border: 1px solid #444; padding: 0px;">
                <table style="border-collapse: collapse">
                    <tr>
                        <th
                            style="width: 1px; white-space: nowrap; text-align: left; white-space: nowrap; border-right: 1px solid #444;">
                            State:
                        </th>
                        <td></td>
                    </tr>
                </table>
            </td>
            <td style="width: 35%; border: 1px solid #444; padding: 0px;">
                <table style="border-collapse: collapse">
                    <tr>
                        <th
                            style="width: 1px; white-space: nowrap;text-align: left; white-space: nowrap; border-right: 1px solid #444;">
                            Zip:
                        </th>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                Mailing
                Address:
            </th>
            <td colspan="3" style="width: 35%; border: 1px solid #444;"></td>
        </tr>
    </table>
    <table style="border-collapse: collapse; margin-bottom: 5px; page-break-inside: avoid;">
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                Account #:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
            <th style="width: 15%; text-align: left; white-space: nowrap; border: 1px solid #444;">
                Service Address:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
        </tr>
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                City:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
            <td style="width: 35%; border: 1px solid #444; padding: 0px;">
                <table style="border-collapse: collapse">
                    <tr>
                        <th
                            style="width: 1px; white-space: nowrap; text-align: left; white-space: nowrap; border-right: 1px solid #444;">
                            State:
                        </th>
                        <td></td>
                    </tr>
                </table>
            </td>
            <td style="width: 35%; border: 1px solid #444; padding: 0px;">
                <table style="border-collapse: collapse">
                    <tr>
                        <th
                            style="width: 1px; white-space: nowrap;text-align: left; white-space: nowrap; border-right: 1px solid #444;">
                            Zip:
                        </th>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                Mailing
                Address:
            </th>
            <td colspan="3" style="width: 35%; border: 1px solid #444;"></td>
        </tr>
    </table>
    <table style="border-collapse: collapse; margin-bottom: 5px; page-break-inside: avoid;">
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                Account #:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
            <th style="width: 15%; text-align: left; white-space: nowrap; border: 1px solid #444;">
                Service Address:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
        </tr>
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                City:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
            <td style="width: 35%; border: 1px solid #444; padding: 0px;">
                <table style="border-collapse: collapse">
                    <tr>
                        <th
                            style="width: 1px; white-space: nowrap; text-align: left; white-space: nowrap; border-right: 1px solid #444;">
                            State:
                        </th>
                        <td></td>
                    </tr>
                </table>
            </td>
            <td style="width: 35%; border: 1px solid #444; padding: 0px;">
                <table style="border-collapse: collapse">
                    <tr>
                        <th
                            style="width: 1px; white-space: nowrap;text-align: left; white-space: nowrap; border-right: 1px solid #444;">
                            Zip:
                        </th>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                Mailing
                Address:
            </th>
            <td colspan="3" style="width: 35%; border: 1px solid #444;"></td>
        </tr>
    </table>
    <table style="width: 100%;page-break-before:always">
        <tbody>
            <tr>
                <td>
                    <table style="width: 100%">
                        <tbody>
                            <td style="width: 150px">
                                <img src="images/energy_harbor.jpg" width="100">
                            </td>
                            <td style="text-align: center;">
                                <h4 style="font-size: 14px; margin-bottom: 0px; color: #004270;">Energy Harbor LLC</h4>
                                <p style="margin-bottom: 10px;color: #004270">Supply Agreement Pricing Attachment –
                                    Additional Accounts<br>
                                </p>
                            </td>
                            <td style="width: 150px">
                            </td>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <table style="margin-top: 10px;border-collapse: collapse;">
        <tr>
            <th style="padding: 5px 10px; background: #C9D1E1; color: #004270; text-align: left">
                ACCOUNT INFORMATION <small>(Only to be used if more than 1 account from Page 1. Please attach as many
                    additional pages as
                    necessary.)</small>:
            </th>
        </tr>
    </table>
    <table style="border-collapse: collapse; margin-bottom: 5px; page-break-inside: avoid;">
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                Account #:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
            <th style="width: 15%; text-align: left; white-space: nowrap; border: 1px solid #444;">
                Service Address:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
        </tr>
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                City:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
            <td style="width: 35%; border: 1px solid #444; padding: 0px;">
                <table style="border-collapse: collapse">
                    <tr>
                        <th
                            style="width: 1px; white-space: nowrap; text-align: left; white-space: nowrap; border-right: 1px solid #444;">
                            State:
                        </th>
                        <td></td>
                    </tr>
                </table>
            </td>
            <td style="width: 35%; border: 1px solid #444; padding: 0px;">
                <table style="border-collapse: collapse">
                    <tr>
                        <th
                            style="width: 1px; white-space: nowrap;text-align: left; white-space: nowrap; border-right: 1px solid #444;">
                            Zip:
                        </th>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                Mailing
                Address:
            </th>
            <td colspan="3" style="width: 35%; border: 1px solid #444;"></td>
        </tr>
    </table>
    <table style="border-collapse: collapse; margin-bottom: 5px; page-break-inside: avoid;">
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                Account #:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
            <th style="width: 15%; text-align: left; white-space: nowrap; border: 1px solid #444;">
                Service Address:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
        </tr>
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                City:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
            <td style="width: 35%; border: 1px solid #444; padding: 0px;">
                <table style="border-collapse: collapse">
                    <tr>
                        <th
                            style="width: 1px; white-space: nowrap; text-align: left; white-space: nowrap; border-right: 1px solid #444;">
                            State:
                        </th>
                        <td></td>
                    </tr>
                </table>
            </td>
            <td style="width: 35%; border: 1px solid #444; padding: 0px;">
                <table style="border-collapse: collapse">
                    <tr>
                        <th
                            style="width: 1px; white-space: nowrap;text-align: left; white-space: nowrap; border-right: 1px solid #444;">
                            Zip:
                        </th>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                Mailing
                Address:
            </th>
            <td colspan="3" style="width: 35%; border: 1px solid #444;"></td>
        </tr>
    </table>
    <table style="border-collapse: collapse; margin-bottom: 5px; page-break-inside: avoid;">
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                Account #:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
            <th style="width: 15%; text-align: left; white-space: nowrap; border: 1px solid #444;">
                Service Address:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
        </tr>
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                City:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
            <td style="width: 35%; border: 1px solid #444; padding: 0px;">
                <table style="border-collapse: collapse">
                    <tr>
                        <th
                            style="width: 1px; white-space: nowrap; text-align: left; white-space: nowrap; border-right: 1px solid #444;">
                            State:
                        </th>
                        <td></td>
                    </tr>
                </table>
            </td>
            <td style="width: 35%; border: 1px solid #444; padding: 0px;">
                <table style="border-collapse: collapse">
                    <tr>
                        <th
                            style="width: 1px; white-space: nowrap;text-align: left; white-space: nowrap; border-right: 1px solid #444;">
                            Zip:
                        </th>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                Mailing
                Address:
            </th>
            <td colspan="3" style="width: 35%; border: 1px solid #444;"></td>
        </tr>
    </table>
    <table style="border-collapse: collapse; margin-bottom: 5px; page-break-inside: avoid;">
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                Account #:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
            <th style="width: 15%; text-align: left; white-space: nowrap; border: 1px solid #444;">
                Service Address:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
        </tr>
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                City:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
            <td style="width: 35%; border: 1px solid #444; padding: 0px;">
                <table style="border-collapse: collapse">
                    <tr>
                        <th
                            style="width: 1px; white-space: nowrap; text-align: left; white-space: nowrap; border-right: 1px solid #444;">
                            State:
                        </th>
                        <td></td>
                    </tr>
                </table>
            </td>
            <td style="width: 35%; border: 1px solid #444; padding: 0px;">
                <table style="border-collapse: collapse">
                    <tr>
                        <th
                            style="width: 1px; white-space: nowrap;text-align: left; white-space: nowrap; border-right: 1px solid #444;">
                            Zip:
                        </th>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                Mailing
                Address:
            </th>
            <td colspan="3" style="width: 35%; border: 1px solid #444;"></td>
        </tr>
    </table>
    <table style="border-collapse: collapse; margin-bottom: 5px; page-break-inside: avoid;">
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                Account #:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
            <th style="width: 15%; text-align: left; white-space: nowrap; border: 1px solid #444;">
                Service Address:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
        </tr>
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                City:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
            <td style="width: 35%; border: 1px solid #444; padding: 0px;">
                <table style="border-collapse: collapse">
                    <tr>
                        <th
                            style="width: 1px; white-space: nowrap; text-align: left; white-space: nowrap; border-right: 1px solid #444;">
                            State:
                        </th>
                        <td></td>
                    </tr>
                </table>
            </td>
            <td style="width: 35%; border: 1px solid #444; padding: 0px;">
                <table style="border-collapse: collapse">
                    <tr>
                        <th
                            style="width: 1px; white-space: nowrap;text-align: left; white-space: nowrap; border-right: 1px solid #444;">
                            Zip:
                        </th>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                Mailing
                Address:
            </th>
            <td colspan="3" style="width: 35%; border: 1px solid #444;"></td>
        </tr>
    </table>
    <table style="border-collapse: collapse; margin-bottom: 5px; page-break-inside: avoid;">
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                Account #:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
            <th style="width: 15%; text-align: left; white-space: nowrap; border: 1px solid #444;">
                Service Address:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
        </tr>
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                City:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
            <td style="width: 35%; border: 1px solid #444; padding: 0px;">
                <table style="border-collapse: collapse">
                    <tr>
                        <th
                            style="width: 1px; white-space: nowrap; text-align: left; white-space: nowrap; border-right: 1px solid #444;">
                            State:
                        </th>
                        <td></td>
                    </tr>
                </table>
            </td>
            <td style="width: 35%; border: 1px solid #444; padding: 0px;">
                <table style="border-collapse: collapse">
                    <tr>
                        <th
                            style="width: 1px; white-space: nowrap;text-align: left; white-space: nowrap; border-right: 1px solid #444;">
                            Zip:
                        </th>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                Mailing
                Address:
            </th>
            <td colspan="3" style="width: 35%; border: 1px solid #444;"></td>
        </tr>
    </table>
    <table style="border-collapse: collapse; margin-bottom: 5px; page-break-inside: avoid;">
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                Account #:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
            <th style="width: 15%; text-align: left; white-space: nowrap; border: 1px solid #444;">
                Service Address:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
        </tr>
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                City:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
            <td style="width: 35%; border: 1px solid #444; padding: 0px;">
                <table style="border-collapse: collapse">
                    <tr>
                        <th
                            style="width: 1px; white-space: nowrap; text-align: left; white-space: nowrap; border-right: 1px solid #444;">
                            State:
                        </th>
                        <td></td>
                    </tr>
                </table>
            </td>
            <td style="width: 35%; border: 1px solid #444; padding: 0px;">
                <table style="border-collapse: collapse">
                    <tr>
                        <th
                            style="width: 1px; white-space: nowrap;text-align: left; white-space: nowrap; border-right: 1px solid #444;">
                            Zip:
                        </th>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                Mailing
                Address:
            </th>
            <td colspan="3" style="width: 35%; border: 1px solid #444;"></td>
        </tr>
    </table>
    <table style="border-collapse: collapse; margin-bottom: 5px; page-break-inside: avoid;">
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                Account #:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
            <th style="width: 15%; text-align: left; white-space: nowrap; border: 1px solid #444;">
                Service Address:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
        </tr>
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                City:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
            <td style="width: 35%; border: 1px solid #444; padding: 0px;">
                <table style="border-collapse: collapse">
                    <tr>
                        <th
                            style="width: 1px; white-space: nowrap; text-align: left; white-space: nowrap; border-right: 1px solid #444;">
                            State:
                        </th>
                        <td></td>
                    </tr>
                </table>
            </td>
            <td style="width: 35%; border: 1px solid #444; padding: 0px;">
                <table style="border-collapse: collapse">
                    <tr>
                        <th
                            style="width: 1px; white-space: nowrap;text-align: left; white-space: nowrap; border-right: 1px solid #444;">
                            Zip:
                        </th>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                Mailing
                Address:
            </th>
            <td colspan="3" style="width: 35%; border: 1px solid #444;"></td>
        </tr>
    </table>
    <table style="border-collapse: collapse; margin-bottom: 5px; page-break-inside: avoid;">
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                Account #:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
            <th style="width: 15%; text-align: left; white-space: nowrap; border: 1px solid #444;">
                Service Address:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
        </tr>
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                City:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
            <td style="width: 35%; border: 1px solid #444; padding: 0px;">
                <table style="border-collapse: collapse">
                    <tr>
                        <th
                            style="width: 1px; white-space: nowrap; text-align: left; white-space: nowrap; border-right: 1px solid #444;">
                            State:
                        </th>
                        <td></td>
                    </tr>
                </table>
            </td>
            <td style="width: 35%; border: 1px solid #444; padding: 0px;">
                <table style="border-collapse: collapse">
                    <tr>
                        <th
                            style="width: 1px; white-space: nowrap;text-align: left; white-space: nowrap; border-right: 1px solid #444;">
                            Zip:
                        </th>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                Mailing
                Address:
            </th>
            <td colspan="3" style="width: 35%; border: 1px solid #444;"></td>
        </tr>
    </table>
    <table style="border-collapse: collapse; margin-bottom: 5px; page-break-inside: avoid;">
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                Account #:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
            <th style="width: 15%; text-align: left; white-space: nowrap; border: 1px solid #444;">
                Service Address:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
        </tr>
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                City:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
            <td style="width: 35%; border: 1px solid #444; padding: 0px;">
                <table style="border-collapse: collapse">
                    <tr>
                        <th
                            style="width: 1px; white-space: nowrap; text-align: left; white-space: nowrap; border-right: 1px solid #444;">
                            State:
                        </th>
                        <td></td>
                    </tr>
                </table>
            </td>
            <td style="width: 35%; border: 1px solid #444; padding: 0px;">
                <table style="border-collapse: collapse">
                    <tr>
                        <th
                            style="width: 1px; white-space: nowrap;text-align: left; white-space: nowrap; border-right: 1px solid #444;">
                            Zip:
                        </th>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                Mailing
                Address:
            </th>
            <td colspan="3" style="width: 35%; border: 1px solid #444;"></td>
        </tr>
    </table>
    <table style="border-collapse: collapse; margin-bottom: 5px; page-break-inside: avoid;">
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                Account #:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
            <th style="width: 15%; text-align: left; white-space: nowrap; border: 1px solid #444;">
                Service Address:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
        </tr>
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                City:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
            <td style="width: 35%; border: 1px solid #444; padding: 0px;">
                <table style="border-collapse: collapse">
                    <tr>
                        <th
                            style="width: 1px; white-space: nowrap; text-align: left; white-space: nowrap; border-right: 1px solid #444;">
                            State:
                        </th>
                        <td></td>
                    </tr>
                </table>
            </td>
            <td style="width: 35%; border: 1px solid #444; padding: 0px;">
                <table style="border-collapse: collapse">
                    <tr>
                        <th
                            style="width: 1px; white-space: nowrap;text-align: left; white-space: nowrap; border-right: 1px solid #444;">
                            Zip:
                        </th>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                Mailing
                Address:
            </th>
            <td colspan="3" style="width: 35%; border: 1px solid #444;"></td>
        </tr>
    </table>
    <table style="border-collapse: collapse; margin-bottom: 5px; page-break-inside: avoid;">
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                Account #:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
            <th style="width: 15%; text-align: left; white-space: nowrap; border: 1px solid #444;">
                Service Address:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
        </tr>
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                City:
            </th>
            <td style="width: 35%; border: 1px solid #444;"></td>
            <td style="width: 35%; border: 1px solid #444; padding: 0px;">
                <table style="border-collapse: collapse">
                    <tr>
                        <th
                            style="width: 1px; white-space: nowrap; text-align: left; white-space: nowrap; border-right: 1px solid #444;">
                            State:
                        </th>
                        <td></td>
                    </tr>
                </table>
            </td>
            <td style="width: 35%; border: 1px solid #444; padding: 0px;">
                <table style="border-collapse: collapse">
                    <tr>
                        <th
                            style="width: 1px; white-space: nowrap;text-align: left; white-space: nowrap; border-right: 1px solid #444;">
                            Zip:
                        </th>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <th style="width: 15%; text-align: left; white-space: nowrap;border: 1px solid #444;">
                Mailing
                Address:
            </th>
            <td colspan="3" style="width: 35%; border: 1px solid #444;"></td>
        </tr>
    </table>

    <table style="width: 100%;page-break-before:always">
        <tbody>
            <tr>
                <td>
                    <table style="width: 100%">
                        <tbody>
                            <td style="width: 150px">
                                <img src="images/energy_harbor.jpg" width="100">
                            </td>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <table style="margin-top: 10px;border-collapse: collapse;">
        <tr>
            <th style="padding: 5px 10px; background: #C9D1E1; color: #004270; text-align: center">
                Energy Harbor LLC Electric Generation Supplier Contract Summary
            </th>
        </tr>
    </table>
    <table>
        <tr>
            <td style="background: #D9D9D9">Electric Generation Supplier (“EGS”) Information</td>
            <td>Energy Harbor LLC, 168 East Market Street, Akron, OH 44308<br>1-888-254-6359<br>PA License
                #A-110078<br>www.energyharbor.com</td>
        </tr>
        <tr>
            <td style="background: #D9D9D9"></td>
            <td>Energy Harbor LLC supplies the electric generation service portion of your electric bill.</td>
        </tr>
        <tr>
            <td style="background: #D9D9D9">Price Structure</td>
            <td><strong>Fixed Price</strong></td>
        </tr>
        <tr>
            <td style="background: #D9D9D9">Generation/Supply Price</td>
            <td>0.12691 $/kWh</td>
        </tr>
        <tr>
            <td style="background: #D9D9D9">Statement Regarding Savings</td>
            <td>The above price per kWh may not provide savings throughout the entire period this Agreement is in
                effect.</td>
        </tr>
        <tr>
            <td style="background: #D9D9D9">Deposit Requirements</td>
            <td>None</td>
        </tr>
        <tr>
            <td style="background: #D9D9D9">Incentives</td>
            <td>None at this time</td>
        </tr>
        <tr>
            <td style="background: #D9D9D9">Contract Start Date</td>
            <td>Next available start date as determined by your EDC.</td>
        </tr>
        <tr>
            <td style="background: #D9D9D9">Contract Duration / Length</td>
            <td>This contract will continue for an initial period of ___ months after service commences (“Initial
                Duration”) and then will automatically renew unless cancelled consistent with the terms and conditions
                set forth in the Disclosure Statement.</td>
        </tr>
        <tr>
            <td style="background: #D9D9D9">Cancellation / Early Termination Fees (“ETF”)</td>
            <td>If you terminate this Agreement for any reason other than as expressly provided for herein, or if you
                fail to make payment as required by this Agreement and the Agreement is cancelled, you will be
                charged an Early Termination Fee (“ETF”), which will consist of any outstanding accounts payable,
                costs, and any applicable fees plus the positive difference, if any, of the Generation/Supply Price at
                the time of execution of the Pricing Attachment, less the market value of your electricity supply,
                including such difference for the months remaining in the term as determined at the time of
                termination using standard industry practices. However, if you are a Small Business Customer, you
                will not be subject to an ETF if you terminate this Agreement during the Rescission Period or within
                thirty (30) days of the date on which this Agreement is scheduled to expire.
                End of Contract / Renewal Terms
                <u>FOR SMALL BUSINESS CUSTOMERS ONLY</u>: If you have a fixed duration contract that will be
                ending, or whenever Energy Harbor wants to change the contract, you will receive two separate
                notices before the contract ends or the changes happen. You will receive the first notice 45-60 days
                before, and the second notice 30 days before the expiration date or the date the change becomes
                effective. These notices will explain your options going forward, including any automatic renewal
                terms that may apply.
            </td>
        </tr>
        <tr>
            <td style="background: #D9D9D9">End of Contract / Renewal Terms - Right of Rescission</td>
            <td>FOR ALL OTHER CUSTOMERS: See the attached Disclosure Statement.
                Right of Rescission
                FOR SMALL BUSINESS CUSTOMERS ONLY: If you are a new or returning customer, you may
                cancel this Agreement without any fees or charges at any time before midnight of the third Business
                Day after receiving this Disclosure Statement (“Rescission Period”) by contacting Energy Harbor at 1-
                888-254-6359.</td>
        </tr>
    </table>
    <table style="width: 100%;page-break-before:always">
        <tbody>
            <tr>
                <td>
                    <table style="width: 100%">
                        <tbody>
                            <td style="width: 150px">
                                <img src="images/energy_harbor.jpg" width="100">
                            </td>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <table style="margin-top: 10px;border-collapse: collapse;">
        <tr>
            <th style="padding: 5px 10px; background: #C9D1E1; color: #004270; text-align: center">
                Small Commercial – Electric - Disclosure Statement
            </th>
        </tr>
    </table>
    <p><strong>ENERGY HARBOR LLC</strong> (“Energy Harbor”) agrees to sell, and you agree to buy, your full requirements
        for electric generation
        service for your business at
        the price and on the terms and conditions as specified in the Contract Summary, Pricing Attachment, and in this
        Disclosure Statement (collectively,
        “Agreement”). Price and other terms of this Agreement are subject to change as provided below. Energy Harbor
        reserves
        the right to revoke its electric
        generation offer for any reason at any time prior to this Agreement becoming effective. You acknowledge that the
        contract start date shall be determined
        by your EDC in accordance with its rules and practices regarding the switching of customers to suppliers. Energy
        Harbor
        has no liability related to the date
        on which your EDC switches your account. Throughout this Agreement, the words “customer”, “you” and “your” refer
        to the
        account(s) for which electric
        generation service is being requested. The words “we”, “us” and “our” refer to Energy Harbor. <u>Please keep a
            copy of this
            Agreement for your records.</u></p>
    <p><strong>Right of Rescission: FOR SMALL BUSINESS CUSTOMERS ONLY (as defined below):</strong> You may cancel this
        Agreement without any
        fees or charges at
        any time before midnight of the third Business Day after receiving this Disclosure Statement (“Rescission
        Period”) by
        contacting Energy Harbor at 1-888-
        254-6359.</p>
    <p><strong>Competitive Electric Service:</strong> Energy Harbor (PA License #A-110078) is licensed by the
        Pennsylvania Public Utility
        Commission (“PUC”) to offer and
        supply electric generation services in Pennsylvania. As an Electric Generation Supplier (“EGS”), Energy Harbor
        will
        supply the electric generation to your
        local electric utility (referred to as your electric distribution company (“EDC”)) based on your usage. This
        electricity
        is delivered over high voltage transmission
        lines to your EDC which then distributes or delivers the electricity to you over distribution lines. Generation
        prices
        and charges are set by the EGS you have
        chosen (Energy Harbor). The PUC regulates distribution prices and services. The Federal Energy Regulatory
        Commission
        (“FERC”) regulates transmission
        prices and services. Energy Harbor is not the same company as your EDC; the prices of Energy Harbor are not
        regulated by
        the PUC and you are not
        required to buy electricity or other products from Energy Harbor to receive the same quality of service from
        your local
        EDC.</p>
    <p><strong>Definitions:</strong> <u>Business Days</u> - Monday through Friday (8:00 AM – 5:00 PM Eastern Standard
        Time (“EST”)), excluding
        holidays. <u>Contract Summary</u> - The
        separate, one-page document that summarizes the key terms and conditions of this Disclosure Statement.
        <u>Distribution
            Service</u> - The delivery of electricity
        to your home or business. This includes local wires, transformers, substations and other equipment used to
        deliver
        electricity to end-use consumers from
        the high-voltage transmission lines. <u>Electric Distribution Company (“EDC”)</u> - The public utility that
        provides facilities
        for the transmission and distribution of
        electricity to retail customers. Electric distribution companies are regulated by the PUC. Exceptions include
        building
        or facility owners or operators that
        manage their internal distribution system and supply electric power and electric services to occupants of the
        building
        or facility. <u>Generation Charges</u> - Part
        of the basic service charges on every customer’s bill for producing electricity. Generation service is
        competitively
        priced and is not regulated by the Public
        Utility Commission. This charge depends on the contract between the customer and the supplier. <u>NERC</u> – The
        North American
        Reliability Corporation.
        <u>RTO</u> - Regional Transmission Organization. <u>Small Business Customer</u> - Customer that receives
        electric service under a
        small commercial, small industrial
        or small business rate classification, and whose maximum registered peak load was less than 25 kilowatts (“kW”)
        within
        the last twelve months. <u>Transmission
            Charges</u> - Part of the basic service charges on every customer’s bill for transporting electricity from
        the source of
        supply to the electric distribution company.
        The Federal Energy Regulatory Commission regulates retail transmission prices and services. This charge will
        vary with
        your source of supply. Definitions
        for “generation charges” and “transmission charges” are defined in accordance with the glossary posted on
        www.papowerswitch.com or another successor
        media platform as determined by the PUC. These and other industry terms can be found on this website.
    </p>
    <p><strong>Eligibility:</strong> Any small commercial customer accounts with annual usage that does not exceed one
        (1) million annual
        kilowatt hours (“kWh”) per account and
        does not exceed two (2) million annual kWh in aggregate for multiple accounts are eligible for this offer from
        Energy
        Harbor. Energy Harbor reserves the
        right to refuse enrollment to any customer with an outstanding balance for past electric service or if your
        credit
        standing is otherwise unsatisfactory, as
        determined solely by Energy Harbor. Energy Harbor also reserves the right to determine if the indicative pricing
        as
        provided by Energy Harbor on the
        Electric Program Enrollment Form is appropriate based on the information Energy Harbor receives from the EDC. If
        the
        indicative pricing quote is not
        appropriate you will be notified that Energy Harbor has not accepted your enrollment request. If Energy Harbor
        accepts
        the enrollment request, Energy
        Harbor will send you a countersigned Pricing Attachment, at which time this Agreement shall become binding on
        Energy
        Harbor. You agree that Energy
        Harbor shall not be liable for any damages that may be caused by its decision to reject an enrollment request.
    </p>
    <p><strong>Basic Service Prices and Other Charges:</strong> Throughout the period this Agreement is in effect, you
        agree to pay Energy
        Harbor the fixed price indicated in
        the Contract Summary and in the Pricing Attachment as the “Generation/Supply Price,” which represents the total
        cost of
        your electric generation service
        during the Initial Duration (“Retail Electric Service”). That Generation/Supply Price includes Gross Receipts
        Tax (GRT),
        but does not include state and local
        sales taxes or other taxes which may be assessed by your EDC. In addition to Energy Harbor's charges, you will
        be
        charged by your EDC for distribution
        and various other services.</p>
    <p><strong>Changes Due to Unforeseen Events:</strong> In the event of any change in any statute, rule, regulation,
        order, law, or tariff
        promulgated by any court,
        governmental authority, utility, Independent System Operator (“ISO”), Regional Transmission Organization (“RTO”)
        or
        other service provider, or any change
        in operating procedure, which alters to the detriment of Energy Harbor its costs to perform under this
        Agreement, you
        may receive a notification from Energy Harbor that explains one or more of the situations described above. In
        such an event, Energy Harbor may offer you
        modified terms and conditions, including
        without limitation a change in price, in said notices. <strong>You must indicate your affirmative consent to the
            modified terms
            and conditions as specified in
            the notices.</strong> If you do not contact Energy Harbor to accept the modified terms, this Agreement will
        terminate on the date
        specified in the notices, and you
        will be returned to your EDC for Retail Electric Service, unless you have selected another EGS. Alternatively,
        Energy
        Harbor may decide to terminate this
        Agreement, and you will receive prior written notice of the termination, after which you will be returned to
        your EDC
        for Retail Electric Service, unless you
        have selected another EGS. Whether Energy Harbor offers you new terms or terminates this Agreement under this
        provision,
        you will not be responsible
        for any early termination fees. You must still pay all Energy Harbor charges through the date you are returned
        to your
        EDC or switched to another EGS for
        service.</p>
    <p><strong>Price to Compare:</strong> Your local EDC’s price to compare may change from time to time. Energy Harbor
        cannot guarantee savings
        over the EDC’s rates for
        the entire period this Agreement is in effect. Any potential savings are limited to a comparison against the
        EDC’s price
        to compare applicable at the time
        you enter into this Agreement.</p>
    <p><strong>Length and Renewal of Your Agreement:</strong> Except as otherwise provided for herein, your Retail
        Electric Service from Energy
        Harbor will commence on
        the next available meter reading, following the three (3) business day Rescission Period (if applicable), the
        acceptance
        of the enrollment request by Energy
        Harbor (at its discretion and consistent with the terms set forth herein), and the processing of the enrollment
        by your
        EDC. Except as otherwise provided
        for herein, your Retail Electric Service will continue for the number of months indicated in the Contract
        Summary
        (“Initial Duration”). Prior to the expiration
        of the Initial Duration, you will receive notices as outlined in the “Customer Notification of Changes or End of
        Agreement” Section below. <strong>IF YOU DO NOT
            AFFIRMATIVELY CANCEL THIS AGREEMENT AS OUTLINED IN ANY RENEWAL NOTIFICATIONS, YOUR RETAIL ELECTRIC SERVICE
            FROM ENERGY
            HARBOR WILL
            AUTOMATICALLY RENEW AS OUTLINED IN SAID NOTICE; HOWEVER, IF YOU ARE A SMALL BUSINESS CUSTOMER, YOU MAY
            CANCEL YOUR
            RENEWED AGREEMENT AT ANY
            TIME WITHOUT PENALTIES OR FEES.</strong></p>
    <p><strong>Billing:</strong> You will receive a consolidated bill monthly from your EDC for both your Energy Harbor
        and EDC charges. Energy
        Harbor does not offer budget
        billing. If you do not pay your bill by the due date, Energy Harbor may cancel this Agreement as outlined in the
        “Cancellation / Termination” Section below.
        Energy Harbor reserves the right to convert you from consolidated billing to dual billing if such a conversion
        will
        facilitate more timely billing, collections,
        and/or payment. Furthermore, your failure to pay EDC charges may result in your electric service being
        disconnected in
        accordance with the EDC tariff.</p>
    <p><strong>Early Termination Fees:</strong> If you terminate this Agreement for any reason other than as expressly
        provided for herein, or
        if you fail
        to make payment as required by this Agreement and the Agreement is cancelled, you will be charged an Early
        Termination
        Fee
        (“ETF”), which will consist of any outstanding accounts payable, costs, and any applicable fees plus the
        positive
        difference, if any,
        of the Generation/Supply Price at the time of execution of the Pricing Attachment, less the market value of your
        electricity supply,
        including such difference for the months remaining in the term as determined at the time of termination using
        standard
        industry
        practices. However, if you are a Small Business Customer, you will not be subject to an ETF if you terminate
        this
        Agreement
        during the Rescission Period or within thirty (30) days of the date on which this Agreement is scheduled to
        expire.</p>
    <p><strong>Customer Consent and Information Release Authorization:</strong> By entering into this Agreement for
        Retail Electric Service from
        Energy Harbor, you
        understand and agree to the terms and conditions herein. In order to process your enrollment, you authorize
        Energy
        Harbor to obtain certain information
        from your EDC that includes, but is not limited to: account number, billing address and history, payment
        history,
        historical and future electricity usage, meter
        readings, and characteristics of electricity service (referred to herein as “Confidential Information”). Energy
        Harbor
        will maintain the confidentiality of
        Confidential Information, as well as your personal information, such as your name, address and telephone number
        (referred to herein as “Personal
        Information”) as required by applicable Commission regulations and Federal and State laws. You authorize Energy
        Harbor
        to release Confidential and
        Personal Information in connection with your Retail Electric Service to Energy Harbor’s employees, affiliates,
        lenders,
        counsel, accountants, contractors or
        advisors on a need to know basis, provided said individuals agree to ensure its confidentiality in accordance
        with the
        aforementioned laws and regulations.
        Your authorization to release both Confidential and Personal Information shall remain in effect throughout the
        period
        this Agreement is in effect, unless
        revoked in part or in its entirety in writing by you.</p>
    <p><strong>Customer Consent to Communications:</strong> By signing this Agreement, you agree to receive
        pre-recorded/artificial voice
        messages calls and/or use of an
        automatic dialing device, text messages and/or emails from Energy Harbor or its agents/assigns at any phone
        number or
        email address. You agree to be
        responsible for any charges you may receive on that number, including standard telephone, SMS or text message
        fees. You
        may revoke this express
        consent at any time by calling us at 1-888-254-6359. Such revocation has no bearing on your ability to contract
        with
        Energy Harbor.</p>
    <p><strong>Customer Notification of Changes or End of Agreement:</strong></p>
    <ul style="padding-left: 20px;">
        <li><strong>FOR SMALL BUSINESS CUSTOMERS ONLY:</strong> If you have a fixed duration contract that will be
            ending, or whenever Energy Harbor
            wants to
            change the contract, you will receive two separate notices before the contract ends or the changes happen.
            You will
            receive the first notice 45-60
            days before, and the second notice 30 days before the expiration date or the date the change becomes
            effective. These
            notices will explain your
            options going forward, including any automatic renewal terms that may apply.</li>
        <li><strong>FOR ALL OTHER CUSTOMERS:</strong> You will receive a notice of expiration at least forty-five (45)
            days before your contract is
            scheduled to expire. At
            the end of the Initial Duration, and unless otherwise stated in the notice that you receive, this Agreement
            will
            automatically renew on a month-tomonth basis (“Renewal Term”) without additional notification, unless you or
            Energy
            Harbor affirmatively cancel the Agreement prior to the expiration
            date set forth in the notice. During the Renewal Term, and unless otherwise stated in the notice that you
            receive, the
            Terms
            and Conditions set forth in this Disclosure Statement shall remain the same except that the
            Generation/Supply Price
            shall
            be a variable price that may be higher or lower each month and will be determined in Energy Harbor’s sole
            discretion,
            based
            upon generally prevailing market and business conditions for electricity in the PJM market (including but
            not limited to
            Energy Harbor’s cost to provide service and supply, margin, losses, capacity, ancillary services and other
            RTO charges)
            at
            the applicable EDC load zone or equivalent for the applicable period. Weather fluctuations may impact the
            variable price
            during the Renewal Term. During the Renewal Term, you understand there is no limit on how much the variable
            price may
            change from one billing month to the next. You are responsible for arranging your Retail Electric Service
            upon the
            expiration of this
            Agreement, or any extension thereof.</li>
    </ul>
    <p><strong>If You Move Your Business:</strong> If you move your business to a new service address within your
        existing EDC’s service
        territory, and the EDC is able and
        willing to transfer Energy Harbor’s service, Energy Harbor shall have the sole discretion either to allow this
        Agreement
        to continue, or to cancel this
        Agreement as of the date of your move without prior notice. If you move your business to a new service address
        that is
        outside of your existing EDC’s
        service territory, this Agreement shall be cancelled as of the date of your move without prior notice. You will
        remain
        responsible to pay Energy Harbor for
        any Retail Electric Service used before this Agreement is cancelled.</p>
    <p><strong>Cancellation / Termination:</strong> Small Business Customers may rescind this Agreement with Energy
        Harbor during the three (3)
        business day Rescission
        Period by calling Energy Harbor at 1-888-254-6359. For all other customers, or if this Agreement is not
        rescinded during
        the Rescission Period, enrollment
        will be sent to your EDC. A confirmation notice of transfer of service will be sent to you by your EDC at which
        time you
        may also cancel this Agreement
        consistent with the instructions provided by your EDC. If you are a renewing customer, your EDC will not send
        you a
        confirmation notice, unless otherwise
        required by law. Energy Harbor may terminate this Agreement for any nonpayment or any other breach of this
        Agreement
        upon thirty (30) days’ prior written
        notice to you of such termination. If you fail to cure any nonpayment or breach of this Agreement within the
        thirty (30)
        day notice period, we may terminate
        the Agreement, even if you subsequently cure the nonpayment or breach after such period has expired. Energy
        Harbor may
        also terminate this Agreement
        upon thirty (30) days’ prior written notice to you if there is an act beyond our reasonable control or if we are
        no
        longer able to serve you. We also reserve
        the right to reject your enrollment or terminate this Agreement if:</p>
    <ul style="padding-left: 20px;">
        <li>You fail to meet or maintain satisfactory credit standing as determined solely by us;</li>
        <li>You fail to meet minimum or maximum threshold consumption levels as determined by us;</li>
        <li>You fail to be eligible for EDC billing throughout the entire period that this Agreement is in effect;</li>
        <li>You provide any false, inaccurate or misleading information to Energy Harbor or the EDC;</li>
        <li>You fail to remain an EDC distribution customer under the applicable rate class throughout the period this
            Agreement
            is in effect; or</li>
        <li>You revoke your authorization for release of Confidential and Personal Information.</li>
    </ul>
    <p>Upon termination of this Agreement for any reason, you will return to receiving default supply service from your
        local
        EDC, unless you have selected
        another electric generation supplier. The effective date of any termination will be the next applicable meter
        read date
        after expiration of the required notice
        period. Upon any termination, you will remain responsible for all obligations, including without limitation, any
        ETF or
        payment for Retail Electric Service
        charges incurred under this Agreement prior to the effective date of termination.</p>
    <h3 style="text-transform: uppercase;">Limitation of Liability: YOU AGREE THAT NEITHER ENERGY HARBOR NOR ANY OF ITS
        AFFILIATES OR
        SUBCONTRACTORS WILL BE LIABLE FOR ANY DAMAGES OR CLAIMS FOR MATTERS WITHIN THE CONTROL OF THE EDC, WHICH INCLUDE
        MAINTENANCE OF TRANSMISSION AND/OR DISTRIBUTION SYSTEMS, SERVICE
        INTERRUPTIONS, LOSS OR TERMINATION OF SERVICE, DETERIORATION OF RETAIL ELECTRIC SERVICES, METER
        READINGS OR INJURY TO PERSONS OR DAMAGE TO PROPERTY CAUSED BY THE DELIVERY OR SUPPLY OF
        ELECTRIC GENERATION SERVICE. NEITHER ENERGY HARBOR NOR ANY OF ITS AFFILIATES OR
        SUBCONTRACTORS WILL BE RESPONSIBLE FOR ANY FAILURE TO COMMENCE OR TERMINATE RETAIL ELECTRIC
        SERVICE ON THE DATE SPECIFIED HEREIN DUE TO ANY FAILURE OR DELAY IN ENROLLING YOU WITH THE EDC.
        ENERGY HARBOR’S LIABILITY WILL BE LIMITED TO DIRECT ACTUAL DAMAGES ONLY, WHICH WILL NOT EXCEED
        THE AMOUNT OF YOUR SINGLE LARGEST MONTHLY INVOICE DURING THE PRECEDING TWELVE (12) MONTHS. IN
        NO EVENT WILL ENERGY HARBOR OR ANY OF ITS AFFILIATES OR SUBCONTRACTORS BE LIABLE FOR ANY
        PUNITIVE, INCIDENTAL, CONSEQUENTIAL, EXEMPLARY, INDIRECT, THIRD-PARTY CLAIMS OR OTHER DAMAGES
        WHETHER BASED ON AGREEMENT, WARRANTY, TORT, NEGLIGENCE, STRICT LIABILITY OR OTHERWISE, OR FOR
        LOST PROFITS ARISING FROM ANY BREACH OR NONPERFORMANCE OF THIS AGREEMENT.</h3>
    <p><strong>Assignment:</strong> Upon 60 days’ prior written notice to you, Energy Harbor may assign, subcontract or
        delegate all or any part
        of our rights and/or obligations
        under this Agreement, including your payment obligations under this Agreement, without your consent. Your
        assignment
        notice will include a reminder that
        your terms and conditions will not change upon assignment. You may not assign any of your rights or obligations
        under
        this Agreement without our prior
        written consent.</p>
    <p><strong>Dispute Resolution / Class Action and Jury Trial Waiver:</strong> If you have any questions or concerns
        regarding the terms of
        service, you may contact us on
        any Business Day by telephone at 1-888-254-6359 (toll-free) or in writing, any time, at Energy Harbor LLC, Attn:
        Contract Administration, 168 East Market
        Street, Akron, OH 44308. Our web address is www.energyharbor.com. BOTH YOU AND ENERGY HARBOR AGREE IRREVOCABLY
        AND
        UNCONDITIONALLY TO WAIVE ANY RIGHT TO A TRIAL BY JURY OR TO INITIATE OR BECOME A PARTY TO ANY CLASS ACTION
        CLAIMS IN
        RESPECT OF ANY ACTION, SUIT OR PROCEEDING DIRECTLY OR INDIRECTLY ARISING OUT OF OR RELATING TO THIS AGREEMENT.
        Nothing
        in this Agreement shall impair your right to make an informal or a formal complaint to the PUC or to a court
        with
        appropriate authority to hear the complaint.</p>
    <p><strong>Questions and Shopping Information:</strong> Contact Energy Harbor with any questions concerning this
        Agreement. You may also
        contact the PUC or the
        Pennsylvania Office of Consumer Advocate (“OCA”) if you have any questions about shopping for an electric
        generation
        supplier or other matters involving
        the electric industry. The contact information for the PUC is as follows: Telephone: 1-800-692-7380 from 8:00 am
        to 5:00
        pm (EST) weekdays; Mail: PPUC,
        400 North Street, Harrisburg, PA 17120. Website: www.puc.pa.gov for general information or
        www.papowerswitch.com, or
        other successor media platforms
        as determined by the PUC, for information on shopping for generation service. The OCA contact information is as
        follows:
        Telephone: 800-684-6560;
        Website: www.oca.state.pa.us.</p>
    <p><strong>Miscellaneous:</strong> You have the right to request from Energy Harbor, twice within a twelve (12)
        month period, up to
        twenty-four (24) months of payment
        history, without charge and to the extent such information is available. Information on energy generation
        sources,
        energy efficiency, and environmental
        impacts is available upon customer request</p>
    <h3 style="max-width: 80%;margin: auto; text-transform: uppercase;">IN THE EVENT OF AN EMERGENCY OR POWER OUTAGE,
        YOU SHOULD IMMEDIATELY CALL YOUR LOCAL
        ELECTRIC DISTRIBUTION COMPANY.</h3>
</body>

</html>