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
            /* padding-left: 5px; */
            /* padding-right: 5px; */
        }

        input[type=checkbox],
        input[type=radio] {
            width: 18px;
            height: 18px;
        }

        table {
            width: 100%;
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
                                <img src="images/logo1.jpg" width="100">
                            </td>
                            <td style="text-align: center;">
                                <p style="color: #004270">SFE Energy Ohio, Inc.<br> P.O. Box 967, Buffalo, NY
                                    14240-0967<br> Customer Service:
                                    1-866-255-3844 cs@sfeenergy.com<br> PUCO Gas Certificate # 16-498G(3) | PUCO
                                    Electric
                                    Certificate # 16-1047E(3)<br>
                                </p>
                                <h4 style="font-size: 14px; color: #004270; margin-bottom: 20px">Large Commercial
                                    Natural Gas &
                                    Electricity Supply Agreements</h4>
                            </td>
                            <td style="width: 150px">
                            </td>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table style="width: 100%; border-collapse: collapse">
                        <tbody>
                            <tr>
                                <th style="padding: 5px 10px; background: #C9D1E1; color: #004270; text-align: left">
                                    CUSTOMER INFORMATION
                                </th>
                                <th style="padding: 5px 10px; background: #C9D1E1; color: #004270; text-align: right">
                                    COH012, COV002
                                </th>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <span style="white-space: normal; display: block;">
                        These Agreements are for competitive retail natural gas service
                        (“Natural Gas”) and/or competitive retail electric service (“Electricity”) between SFE Energy
                        Ohio, Inc. (“SFE”) and the Business Legal Name (“Applicant”) as outlined below.
                    </span>
                    <table style="width: 100%;">
                        <tbody>
                            <tr>
                                <td style="width: 1px; white-space: nowrap;">
                                    Business Legal Name (“Applicant”):
                                </td>
                                <td>
                                    <input type="text" value="{{ $contract->customer->business_name }}">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table style="width: 100%;">
                        <tbody>
                            <tr>
                                <td style="width: 1px; white-space: nowrap;">
                                    <span>
                                        <input type="checkbox">
                                        <span style="vertical-align: top; line-height: 1;">Mr.</span>
                                    </span>
                                    <span>
                                        <input type="checkbox">
                                        <span style="vertical-align: top; line-height: 1;">Ms.</span>
                                    </span>
                                    <span>
                                        <input type="checkbox">
                                        <span style="vertical-align: top; line-height: 1;">Mrs.</span>
                                    </span>
                                </td>
                                <td>
                                    <table style="width: 100%;">
                                        <tbody>
                                            <tr>
                                                <td style="width: 1px; white-space: nowrap;">
                                                    Contact First Name:
                                                </td>
                                                <td>
                                                    <input type="text" value="{{ $contract->customer->first_name }}">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td>
                                    <table style="width: 100%;">
                                        <tbody>
                                            <tr>
                                                <td style="width: 1px; white-space: nowrap;">
                                                    Contact Last Name:
                                                </td>
                                                <td>
                                                    <input type="text" value="{{ $contract->customer->last_name }}">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table style="width: 100%">
                        <tr>
                            @foreach ($contract->customer->phone as $contact)
                                
                            <td style="width: 18%; vertical-align: top">
                                <table style="width: 100%;">
                                    <tbody>
                                        <tr>
                                            <td style="width: 1px; white-space: nowrap;">
                                                {{ $contact['type'] }}:
                                            </td>
                                            <td>
                                                <input type="text" value="{{ $contact['value'] }}">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                            @endforeach
                            <td style="width: 30%; vertical-align: top">
                                <table style="width: 100%;">
                                    <tbody>
                                        <tr>
                                            <td style="width: 1px; white-space: nowrap;">
                                                Email:
                                            </td>
                                            <td>
                                                <input type="email" value="{{ $contract->customer->email }}">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <table style="width: 100%">
                        <tr>
                            <td><span style="color: #004270;font-size: 10px; line-height: 11px;">
                                    By providing my email address above, I agree to receive notifications and
                                    information from SFE Energy and its affiliates.</span></td>
                        </tr>
                    </table>
                    <table style="width: 100%;">
                        <tr>
                            <td>
                                <table style="width: 100%;">
                                    <tbody>
                                        <tr>
                                            <td style="width: 1px; white-space: nowrap;">
                                                Service Address:
                                            </td>
                                            <td>
                                                <input type="text">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                            <td>
                                <table style="width: 100%;">
                                    <tbody>
                                        <tr>
                                            <td style="width: 1px; white-space: nowrap;">
                                                Street Address
                                            </td>
                                            <td>
                                                <input type="text" value="{{ $contract->customer->address1 }}">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <table style="width: 100%;">
                        <tr>
                            <td>
                                <table style="width: 100%;">
                                    <tbody>
                                        <tr>
                                            <td style="width: 1px; white-space: nowrap;">
                                                City:
                                            </td>
                                            <td>
                                                <input type="text" value="{{ $contract->customer->city }}">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                            <td>
                                <table style="width: 100%;">
                                    <tbody>
                                        <tr>
                                            <td style="width: 1px; white-space: nowrap;">
                                                States:
                                            </td>
                                            <td>
                                                <input type="text" value="{{ $contract->customer->address1 }}">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <table style="width: 100%;">
                        <tr>
                            <td>
                                <table style="width: 100%;">
                                    <tbody>
                                        <tr>
                                            <td style="width: 1px; white-space: nowrap;">
                                                Billing Address (if different from Service Address):
                                            </td>
                                            <td>
                                                <input type="text">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                            <td>
                                <table style="width: 100%;">
                                    <tbody>
                                        <tr>
                                            <td style="width: 1px; white-space: nowrap;">
                                                Street Address:
                                            </td>
                                            <td>
                                                <input type="text" value="{{ $contract->customer->billing_address }}">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <table style="width: 100%;">
                        <tr>
                            <td>
                                <table style="width: 100%;">
                                    <tbody>
                                        <tr>
                                            <td style="width: 1px; white-space: nowrap;">
                                                City:
                                            </td>
                                            <td>
                                                <input type="text" value="{{ $contract->customer->billing_city }}">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                            <td>
                                <table style="width: 100%;">
                                    <tbody>
                                        <tr>
                                            <td style="width: 1px; white-space: nowrap;">
                                                States:
                                            </td>
                                            <td>
                                                <input type="text" value="{{ $contract->customer->billing_state }}">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                            <td>
                                <table style="width: 100%;">
                                    <tbody>
                                        <tr>
                                            <td style="width: 1px; white-space: nowrap;">
                                                Zip:
                                            </td>
                                            <td>
                                                <input type="text" value="{{ $contract->customer->billing_zip }}">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="padding-top: 10px; padding-bottom: 10px;">
                    <table style="font-size: 8px; border-collapse: collapse;">
                        <tr>
                            <td style="width: 50%; vertical-align: top; padding-right: 10px;">
                                <table style="border: 1px solid #004270;">
                                    <tbody>
                                        <tr>
                                            <th
                                                style="background: #004270; text-align: center; color: #FFF; text-transform: uppercase; padding: 5px;">
                                                Electricity
                                            </th>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table>
                                                    <tr>
                                                        <td>
                                                            <input type="radio">
                                                            <span style="font-size: 8px">American Electric Power
                                                                (AEP)</span>
                                                        </td>
                                                        <td>
                                                            <input type="radio">
                                                            <span style="font-size: 8px">Dayton Power & Light</span>
                                                        </td>
                                                        <td>
                                                            <input type="radio">
                                                            <span style="font-size: 8px">Duke Energy</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <input type="radio">
                                                            <span style="font-size: 8px">The Illuminating
                                                                Company</span>
                                                        </td>
                                                        <td>
                                                            <input type="radio">
                                                            <span style="font-size: 8px">Ohio Edison</span>
                                                        </td>
                                                        <td>
                                                            <input type="radio">
                                                            <span style="font-size: 8px">Toledo Edison</span>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table>
                                                    <tr>
                                                        <td style="width: 1px; white-space: nowrap;">
                                                            <span>
                                                                <input type="checkbox">
                                                                <span style="vertical-align: top; line-height: 1;">Fixed
                                                                    Price:</span>
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <input type="text" value="{{ $contract->commodity == 'electricity' ? $contract->current_rate : '' }}">
                                                        </td>
                                                        <td style="width: 1px; white-space: nowrap;">month(s) at $</td>
                                                        <td>
                                                            <input type="text">
                                                        </td>
                                                        <td style="width: 1px; white-space: nowrap;">
                                                            /kWh
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table>
                                                    <tr>
                                                        <td>
                                                            <span>
                                                                <input type="checkbox" value="Yes">
                                                                <span style="vertical-align: top; line-height: 1;">Tax
                                                                    Exempt
                                                                    Form Attached?</span>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table>
                                                    <tr>
                                                        <td>
                                                            <span>
                                                                <input type="checkbox">
                                                                <span
                                                                    style="vertical-align: top; line-height: 1;">Variable
                                                                    Month to Month Price per kWh (price will vary
                                                                    monthly)</span>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table>
                                                    <tr>
                                                        <td style="width: 1px; white-space: nowrap;">
                                                            <span>
                                                                <span>Offer is valid until</span>
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <input type="text" value="{{  $contract->commodity == 'electricity' ? date('m', strtotime($contract->account->contract_end_date)) : '' }}">
                                                            <span>MONTH</span>
                                                        </td>
                                                        <td style="width: 1px; white-space: nowrap;">,</td>
                                                        <td>
                                                            <input type="text" value="{{ $contract->commodity == 'electricity' ? date('d', strtotime($contract->account->contract_end_date)) : '' }}">
                                                            <span>DAY</span>
                                                        </td>
                                                        <td style="width: 1px; white-space: nowrap;">,</td>
                                                        <td>
                                                            <input type="text" value="{{ $contract->commodity == 'electricity' ? date('Y', strtotime($contract->account->contract_end_date)) : '' }}">
                                                            <span>YEAR</span>
                                                        </td>
                                                        <td style="width: 1px; white-space: nowrap;">; Time</td>
                                                        <td style="width: 20%;">
                                                            <input type=" text">
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table style="width: 100%;">
                                                    <tbody>
                                                        <tr>
                                                            <td style="padding-right: 20px;">
                                                                <input type="text" value="{{ $contract->commodity == 'electricity' ? $contract->volume : '' }}">
                                                                <div>Estimated Annual Usage</div>
                                                            </td>
                                                            <td style="padding-right: 20px;">
                                                                <input type="text">
                                                                <div>Requested Supply Date</div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text">
                                                <div style="margin-bottom: 10px;">Electricity Account # / Service
                                                    Delivery Identifier / Customer
                                                    Number / Choice Service ID</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table>
                                                    <tr>
                                                        <td style="width: 50%">
                                                            <span>
                                                                <input type="checkbox">
                                                                <span
                                                                    style="vertical-align: top; line-height: 1;">Schedule
                                                                    A Attached</span>
                                                            </span>
                                                        </td>
                                                        <td style="width: 1px; white-space: nowrap;">Number of
                                                            Locations:</td>
                                                        <td>
                                                            <input type="text">
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                            <td style="width: 50%; vertical-align: top; padding-left: 10px;">
                                <table style="border: 1px solid #004270;">
                                    <tr>
                                        <th
                                            style="background: #004270; text-align: center; color: #FFF; text-transform: uppercase; padding: 5px;">
                                            NATURAL GAS
                                        </th>
                                    </tr>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <table>
                                                    <tr>
                                                        <td>
                                                            <input type="radio">
                                                            <span style="font-size: 8px">Columbia Gas</span>
                                                        </td>
                                                        <td>
                                                            <input type="radio">
                                                            <span style="font-size: 8px">Dominion Energy Ohio</span>
                                                        </td>
                                                        <td>
                                                            <input type="radio">
                                                            <span style="font-size: 8px">Duke Energy</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <input type="radio">
                                                            <span style="font-size: 8px">Vectren</span>
                                                        </td>
                                                        <td>
                                                        </td>
                                                        <td>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table>
                                                    <tr>
                                                        <td style="width: 1px; white-space: nowrap;">
                                                            <span>
                                                                <input type="checkbox">
                                                                <span style="vertical-align: top; line-height: 1;">Fixed
                                                                    Price:</span>
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <input type="text" {{ $contract->commodity == 'gas' ? $contract->current_rate : '' }}>
                                                        </td>
                                                        <td style="width: 1px; white-space: nowrap;">month(s) at $</td>
                                                        <td>
                                                            <input type="text" value="">
                                                        </td>
                                                        <td style="width: 1px; white-space: nowrap;">
                                                            /kWh
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table>
                                                    <tr>
                                                        <td>
                                                            <span>
                                                                <input type="checkbox">
                                                                <span
                                                                    style="vertical-align: top; line-height: 1;">Variable
                                                                    Month to Month Price per kWh (price will vary
                                                                    monthly)</span>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div style="height: 22px"></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table>
                                                    <tr>
                                                        <td style="width: 1px; white-space: nowrap;">
                                                            <span>
                                                                <span>Offer is valid until </span>
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <input type="text" value="{{  $contract->commodity == 'gas' ? date('m', strtotime($contract->account->contract_end_date)) : '' }}">
                                                            <span>MONTH</span>
                                                        </td>
                                                        <td style="width: 1px; white-space: nowrap;">,</td>
                                                        <td>
                                                            <input type="text" value="{{ $contract->commodity == 'gas' ? date('d', strtotime($contract->account->contract_end_date)) : '' }}">
                                                            <span>DAY</span>
                                                        </td>
                                                        <td style="width: 1px; white-space: nowrap;">,</td>
                                                        <td>
                                                            <input type="text" value="{{ $contract->commodity == 'gas' ? date('Y', strtotime($contract->account->contract_end_date)) : '' }}">
                                                            <span>YEAR</span>
                                                        </td>
                                                        <td style="width: 1px; white-space: nowrap;">; Time</td>
                                                        <td style="width: 20%;">
                                                            <input type="text" >
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table style="width: 100%;">
                                                    <tbody>
                                                        <tr>
                                                            <td style="padding-right: 20px;">
                                                                <input type="text" value="{{ $contract->commodity == 'gas' ? $contract->volume : '' }}">
                                                                <div>Estimated Annual Usage</div>
                                                            </td>
                                                            <td style="padding-right: 20px;">
                                                                <input type="text">
                                                                <div>Requested Supply Date</div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text">
                                                <div style="margin-bottom: 10px;">Electricity Account # / Service
                                                    Delivery Identifier / Customer
                                                    Number / Choice Service ID</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table>
                                                    <tr>
                                                        <td style="width: 50%">
                                                            <span>
                                                                <input type="checkbox">
                                                                <span
                                                                    style="vertical-align: top; line-height: 1;">Schedule
                                                                    A Attached</span>
                                                            </span>
                                                        </td>
                                                        <td style="width: 1px; white-space: nowrap;">Number of
                                                            Locations:</td>
                                                        <td>
                                                            <input type="text">
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="width: 100%;">
                    <p style="margin-bottom: 15px;"><strong>AGREEMENT(s) DETAILS:</strong> SFE sets the prices (“Price”)
                        that the Applicant
                        pays for the Natural Gas and/or Electricity
                        program (“Program”) (see Terms and Conditions for
                        further details). The Applicant will buy their Natural Gas and/or
                        Electricity for the above Service Address and/or the
                        Service Address(es) as outlined in the Schedule A from
                        SFE beginning on a date set by the Applicant's Natural Gas
                        Company/Electric Distribution Utility (“NGC/EDU”) and will
                        continue for the term selected above (“Term”).
                        SFE may renew (includes automatic renewal) one or both of the
                        Agreement(s) at the end of the Term. Please refer to
                        Section 9 of the Terms and Conditions for details.</p>
                    <p style="margin-bottom: 15px;"><strong>APPLICANT AWARENESS:</strong> The Applicant is the account
                        holder and/or the
                        Contact
                        and is authorized to make account decisions.
                        By choosing SFE as their natural gas
                        and/or electricity supplier, retail natural gas supplier and/or certified electric
                        services
                        company, the NGC/EDU will
                        continue to deliver the Applicant's Natural Gas
                        and/or Electricity supply, read the Applicant's meter, bill the Applicant, and respond
                        to
                        any emergencies. Applicant
                        acknowledges that it is a mercantile customer
                        and consumes more than 700,000 kilowatt hours of aggregated Electricity per year or
                        consumes
                        more than 500,000 cubic
                        feet of aggregated Natural Gas per year
                        (“Mercantile Customer”).</p>
                    <p style="margin-bottom: 15px;">(By signing below, the Applicant agrees to purchase Natural Gas
                        and/or Electricity supply
                        service from SFE and
                        acknowledges that they have read the Agreement(s)
                        and understands and agrees to the Terms and Conditions of the Agreement(s)).</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p style="margin-bottom: 15px;">To: SFE Energy Ohio, Inc. (“SFE”) and the local Natural Gas Company
                        and Electric
                        Distribution Utility (“NGC/EDU”) for
                        the Service Address on the Natural Gas and/
                        or Electricity Agreements (“Agreement(s)”).</p>
                </td>
            </tr>
        </tbody>
    </table>
    <h4 style="text-align: center; text-transform: uppercase; margin-bottom: 10px; page-break-before:always">Terms &
        Conditions</h4>
    <ol style="font-size: 8px; padding-left: 15px;">
        <li><strong>Agency.</strong> The Applicant hereby appoints SFE as agent for the purposes
            of acquiring the
            supplies necessary to meet the
            Applicant's Natural Gas and/or Electricity
            supply needs, and arranging, contracting for and administering transportation and
            transmission facilities and related
            services over transportation/transmission
            facilities and those facilities of the NGC/EDU needed to deliver Natural Gas and/or
            Electricity to the Applicant's
            Service Address. The Agreement(s) is/are for the
            sale and purchase of Natural Gas and/or Electricity and is/are between SFE and the
            Applicant under which the Applicant
            shall initiate Natural Gas and/or Electricity
            supply and begin enrollment with SFE (the “Agreement(s)”). Subject to the Terms and
            Conditions of the Agreement(s), SFE
            agrees to sell and deliver, and the
            Applicant agrees to purchase and accept the quantity of Natural Gas and/or
            Electricity
            supply, as estimated by SFE,
            necessary to meet the requirements based upon
            consumption data obtained by SFE or the delivery schedule of the Applicant's
            NGC/EDU.
            The amount of Natural Gas and/or
            Electricity supply delivered under the
            Agreement(s) is/are subject to change based upon data reflecting the Applicant's
            consumption obtained by SFE or the
            NGC/EDU delivery schedule. The Applicant
            acknowledges that it is a Mercantile Customer. SFE reserves the right to cancel this
            Agreement if it is determined that
            the customer consumes less than 700,000 kilowatt
            hours of aggregated Electricity per year or consumes less than 500,000 cubic feet of
            aggregated Natural Gas per year.</li>
        <li><strong>Length of Agreement(s).</strong> The Applicant acknowledges that the
            commencement of the Agreement(s) begins on the date on which
            the Applicant has signed the
            Agreement(s) (“Start Date”) and SFE Energy has determined that the Applicant's
            credit standing is satisfactory (see
            Section 8). The Applicant also acknowledges that
            the service under the Agreement(s) depends upon the date on which the Applicant's
            NGC/EDU completes all applicable
            switching and enrollment processes (“Supply
            Date”) and shall begin with the next available meter reading after processing of the
            request by the NGC/EDU and SFE. If
            a specific Supply Date is requested on the
            first page of this Agreement, SFE will use reasonable commercial efforts to begin
            supply on or near the date requested.
            If no Supply Date is requested, SFE shall use
            reasonable commercial efforts to attempt to flow on the next available date. The
            Applicant further acknowledges that the
            timing for the NGC/EDU's completion of
            the switching and enrollment processes is beyond SFE's control, and SFE makes no
            warranties as to the Applicant's Supply
            Date. The end date of the Agreement(s)
            is/are the meter reading date after the entire Term of the Agreement(s) (“End Date”)
            (as selected by the Applicant on
            the first page of the Agreement(s)) from the
            Supply Date, plus any time required to obtain a final meter read. The Term of the
            Applicant's Agreement(s) is/are the
            period from the Supply Date to the End Date.</li>
        <li><strong>Natural Gas and/or Electricity Billing.</strong> The Applicant acknowledges
            that their NGC/EDU will bill them for the Natural Gas
            and/or Electricity delivered to the Service
            Address(es) and for certain distribution access charges, and any other fees, charges
            or taxes relating to the delivery
            of Natural Gas and/or Electricity delivered to the
            Service Address(es) and that the type and frequency of such billing will be in
            accordance with the Applicant's NGC/EDU
            billing practice and the Applicant's NGC/EDU
            usual billing cycle. The Applicant further acknowledges that, at some point during
            the Term of the Agreement, SFE may
            choose to bill the Applicant directly for all costs
            associated with the supply and delivery of Natural Gas and/or Electricity to the
            Service Address(es), provided that the
            Applicant will not have to pay any additional
            fees or costs as a result of SFE billing the Applicant directly above and beyond the
            fees and costs mentioned herein. In
            the event that SFE bills the Applicant directly,
            SFE's billing terms will be as follows: SFE shall invoice the Applicant monthly for
            all amounts due to SFE pursuant to
            the Agreement for the applicable billing period.
            The Applicant shall pay to SFE in full any amounts owing by the due date indicated
            on the invoice. If the Applicant
            fails to pay on time, the Applicant shall pay 1%
            interest per month (12% per annum) on the unpaid amount, from the due date of
            payment until payment is received. SFE or
            the Applicant's NGC/EDU is entitled to
            revise any bill if necessary to account for any reassessment by the Applicant's
            NGC/EDU. The Applicant's NGC/EDU will
            determine the amount of Natural Gas and/
            or Electricity that is delivered to the Service Address(es) and may do so by
            periodic meter reading, estimation, or
            allocation and SFE will be entitled to charge based
            on this information. The Applicant shall be responsible for all costs that relate to
            any failure to pay, including
            charges for dishonored checks, and any legal and collection costs. SFE shall be
            entitled to revise any bill after it is
            rendered, regardless of payment by the Applicant, to account for any reassessment
            made by SFE or by the
            Applicant's NGC/EDU resulting from an actual meter read or consumption adjustment.
            If the Applicant's NGC/EDU bills the
            Applicant directly and the Applicant fails
            to meet any payments for the Applicant's Natural Gas and/or Electricity service(s),
            the Applicant's service may be
            terminated in accordance with the NGC/EDU tariffs.
            If SFE chooses to bill the Applicant directly and the Applicant fails to pay or meet
            any payments for the Applicant's
            Natural Gas and/or Electricity, SFE may terminate
            this Agreement with at least fourteen (14) days' written notice. The Applicant may
            request from SFE, twice within a
            twelve-month period, up to twenty-four months
            of the Applicant's payment history without charge.</li>
        <li><strong>Pricing.</strong> The Price that the Applicant will pay for Natural Gas
            and/or Electricity from SFE, is as selected on the first
            page of the Agreement(s). In addition, SFE may
            pass through or allocate, as the case may be, any increase or decrease in our costs,
            or cost components related to the
            Natural Gas and/or Electricity and related
            products and services that result from implementation of a new, or changes to
            (including changes to rate calculation)
            any law, rule, regulation, ordinance, statute,
            judicial decision, administrative order, ISO business practice or protocol, NGC/EDU
            or ISO tariff, rule of any
            regulatory commission or agency with jurisdiction in the
            state where the accounts are located. The Price that SFE charges does not include
            applicable taxes and charges related
            to NGU/EDU distribution, delivery, service and
            other related NGC/EDU service. If, due to a change in market conditions, SFE wishes
            to lower the price per kWh/ccf/Mcf
            charged to the Applicant under an existing
            Agreement(s), it may do so without consent provided there are no other changes to
            the Terms and Conditions to the
            Agreement(s).
            Fixed Price for Electricity: If the Applicant selected the Fixed Price, the Price
            per kWh includes applicable costs for
            delivery to the applicable Load Bus, excluding
            applicable state and local tax. In addition to the Price for the SFE program
            selected, You will pay NGC/ EDU charges.
            Fixed Price for Natural Gas: If the Applicant selected a Fixed Price, the Price per
            therm includes applicable costs for
            transmission and delivery for Natural Gas delivered to Your NGC/EDU's city gate
            excluding applicable state and local
            tax. In addition to the Price for the SFE program selected, You will pay NGC/ EDU
            charges.
            Variable Price for Electricity: If the Applicant selected the Variable Price, the
            Price per kWh will be established
            prior to the month of flow and may vary each month
            based upon the costs incurred by SFE to provide the service through procurement in
            RTO-administered and/or other short
            term markets, as well as the cost for
            supply and associated products that SFE requires to meet the Applicant's Electricity
            supply. These associated products
            may include, but not limited to, energy, imbalance energy, losses, capacity,
            transmission, ancillary services, alternate
            and renewable energy requirements, other RTO charges, a margin and applicable taxes.
            The
            Variable Price will be set at SFE's discretion.<br>Variable Price for Natural Gas:
            If the Applicant selected the Variable Price, the Price per Ccf/Mcf/therm/Dth will
            be
            established prior to the month of flow and may
            vary each month based upon Natural Gas market pricing, transportation costs, storage
            costs, utility charges, balancing
            costs, loss factors, pooling charges, credit
            costs, a margin, other market price related factors and applicable taxes. The
            Variable Price will be set at SFE's
            discretion.</li>
        <li><strong>Title.</strong> All Natural Gas and/or Electricity sold under the
            Agreement(s) shall be delivered to a location considered the
            “Point of Delivery”, which shall be at the
            NGC City Gate (located outside of the municipality of the Service Address) or EDU
            load bus, and shall constitute the
            point at which title transfers and the sale occurs.
            SFE will indemnify and hold the Applicant harmless from all taxes, royalties, fees
            or other charges incurred before
            title passes with respect to the Natural Gas and/
            or Electricity provided in these Agreement(s).</li>
        <li><strong>Cancellation Provision.</strong> Regardless of the Price the Applicant
            selected, the Applicant is liable for all SFE charges
            until the Applicant returns to the NGC/EDU default
            service or the Applicant switches to another supplier. The Applicant may be
            responsible for a switching fee. Upon
            cancellation of the Agreement(s), a final bill will
            be rendered within twenty (20) days after the final scheduled meter reading;
            however, if a final meter reading is
            unavailable, an estimate of consumption will be
            used in the final bill, which will be trued-up subsequent to the final meter
            reading. Any cancellation will become
            effective on a date determined by the Applicant's
            NGC/EDU. If a new provider is not selected upon cancellation of the Agreement(s),
            the Applicant shall be returned to its
            NGC/EDU utility supply service. To
            cancel/rescind the Agreement(s), the Applicant should contact SFE by telephone or in
            writing at the contact information
            provided (see Section 14). If the Applicant
            plans to move to another location, the Applicant may transfer the Agreement(s) by
            notifying SFE (see Section 14), of the
            Applicant's new Service Address at least
            forty-five (45) days in advance of the anticipated relocation date. Upon receipt of
            such notice, SFE will use reasonable
            commercial efforts to continue the program
            contemplated by the Agreement(s) for the remaining Term of the Agreement(s) at the
            new Service Address. If the
            Applicant's utility provides SFE with a notification of
            a change of address within the Applicant's NGC/EDU utility supply service and when
            SFE receives such notice, it will use
            reasonable commercial efforts to continue
            the program contemplated by the Agreement(s) for the remaining Term of the
            Agreement(s) at the new Service Address.
            Otherwise, the Agreement(s) shall be
            automatically cancelled, and if the Applicant selected a Fixed Price, exit fees of
            $0.18/ccf ($1.80/Mcf) and $0.015 per
            kWh for the estimated usage of the Natural
            Gas and/or Electricity supply for the remainder of each Agreement shall apply. If
            the Applicant switches back to the
            Applicant's EDU service, there is no guarantee
            that the Applicant may or may not be served under the same rates, terms, and
            conditions that apply to other customers
            served by the EDU. The Applicant also
            agrees to notify SFE in writing of any other change of information (including a
            change of account number, contact
            information or mailing address) at least sixty (60)
            days prior to such change taking effect or immediately if the change is to take
            effect in less than sixty (60) days. The
            Applicant agrees that SFE may terminate the
            Agreement(s) at any time by providing forty-five (45) days' written notice if SFE is
            unable or is prevented from
            complying with any of the obligations it owes to the
            NGU/EDU or if the NGU/EDU is unable or is prevented from complying with any of the
            obligations it owes to SFE. If SFE
            terminates the Fixed Price Agreement(s),
            unless for a reason out of the Applicant's control, early termination fees of
            $0.18/ccf ($1.80/Mcf) and $0.015 per kWh
            for the estimated usage of the Natural Gas
            and/or Electricity supply for the remainder of each Agreement shall apply.</li>
        <li><strong>Assignment.</strong> The Applicant may not assign the Applicant's interests
            in, and/or delegate the Applicant's obligations under
            the Agreement(s) without the express
            written consent of SFE. SFE may sell, transfer, pledge, or assign the accounts
            receivable, revenues, or proceeds hereof,
            in connection with any financing agreement,
            purchase of accounts receivables program or billing services agreement, and may
            assign the Agreement(s) and the rights
            and obligations thereunder, to another
            energy supplier, energy services company or other entity as authorized by the PUCO,
            by providing the Applicant with at
            least forty-five (45) days' notice.</li>
        <li><strong>Information Release Authorization.</strong> The Applicant acknowledges and
            authorizes SFE to obtain and review information
            regarding the Applicant's credit history
            from credit reporting agencies and the following information from the NGC/EDU:
            consumption history; billing
            determinants; NGC/EDU account number; credit
            information; and public assistance status. This information will not be disclosed to
            a third party unless required by
            law. The Applicant's social security number and/or
            account number(s) shall not be released without the Applicant's affirmative written
            consent except where such release is
            required by court order or by PUCO order
            or rule. The Applicant's execution of the Agreement(s) shall constitute
            authorization for the release of this
            information to SFE. The Applicant consents to provide
            SFE with a copy of the Applicant's NGC/EDU bill(s) in order to process the
            Agreement(s) with the NGC/EDU. SFE does not
            guarantee to provide or return the bill
            or a copy of the bill to the Applicant. This authorization will remain in effect
            during the initial Term and any renewal
            Term of the Agreement(s). The Applicant may
            rescind this authorization at any time by providing written notice to SFE or by
            calling SFE at 1-866-255-3844. SFE
            reserves the right to cancel the Agreement(s) in
            the event the Applicant rescinds the authorization.</li>
        <li><strong>Agreement(s) Expiration/Renewal Provisions/Change in Terms:</strong> Fixed
            Price Agreement(s): If the Applicant selected a Fixed
            Price, at the end of the initial Term of
            the Agreement(s), SFE will automatically renew this Agreement(s). If SFE does not
            receive notice, either written or
            verbal, from the Applicant at least forty-five (45)
            days prior to the end of the initial Term of the Agreement(s), the Agreement(s) will
            continue on a month to month basis
            at a monthly Variable price per kWh/ccf/
            Mcf, which is established prior to the month of flow and remains unchanged for the
            duration of each month.<br>
            Variable Price Agreement(s): If the Applicant selected a Variable Price and the
            Applicant wishes to terminate the
            Agreement(s) at any time, they can do so without
            penalty by providing SFE with written notice. Once the Applicant has provided SFE
            with their notice, SFE will return the
            Applicant to their NGU/EDU supply service
            at the next available service period.</li>
        <li><strong>Material Change.</strong> In the event that additional charges, fees, or
            other costs are incurred or applied by any regulatory
            body, ISO, NGC/EDU or other entity, as a result
            of a material change to Applicant's consumption, capacity/transmission obligation,
            or other components required to serve
            the Applicant, and SFE incurs material
            incremental costs required to maintain the same quantity, location or level of
            services contemplated in this Agreement,
            SFE may charge the Applicant for the purchase/
            liquidation of energy or related services bought or sold as a result of said
            Material Change. SFE shall pass incremental
            costs along to Applicant at no markup.</li>
        <li><strong>Warranty.</strong> The Agreement(s) for Natural Gas and/or Electricity,
            including applicable attachments, constitutes the entire
            Agreement(s) for the supply of Natural
            Gas and/or Electricity between the Applicant and SFE. SFE makes no representations
            or warranties other than those
            expressly set forth in the Agreement(s), and SFE
            expressly disclaims all other warranties, express or implied, including
            merchantability and fitness for a particular
            use.</li>
        <li><strong>Force Majeure.</strong> SFE will make commercially reasonable efforts to
            provide Natural Gas and/or Electricity hereunder but SFE
            does not guarantee a continuous
            supply of Natural Gas and/or Electricity to the Applicant. Certain causes and events
            out of the control of SFE (“Force
            Majeure Events”) may result in interruptions in
            service. SFE will not be liable for any such interruptions caused by a Force Majeure
            Event, and SFE is not and shall not
            be liable for damages caused by Force Majeure
            Events. Force Majeure Events shall include but are not limited to acts of God, fire,
            flood, storm, terrorism, war, civil
            disturbance, acts of any governmental authority,
            accidents, strikes, labor disputes or problems, required maintenance work, inability
            to access the necessary
            distribution or transmission system, non-performance by the
            NGC/EDU (including, but not limited to, a facility outage on its Natural Gas and/or
            Electricity supply distribution
            lines), changes in laws, rules, or regulations of any
            governmental authority or any other cause beyond SFE's control.</li>
        <li><strong>Liability.</strong> The remedy in any claim or suit by the Applicant will be
            solely limited to direct actual damages. By entering
            into the Agreement(s), the Applicant waives
            any right to any other remedy in law or equity. In no event will either SFE or the
            Applicant be liable for
            consequential, incidental, indirect, special or punitive
            damages. These limitations apply without regard to the cause of any liability or
            damages. There are no third-party
            beneficiaries to the Agreement(s).</li>
        <li><strong>Contact Information.</strong> The Applicant may contact SFE's Customer Care
            at 1-866-255-3844 Monday through Friday 9:00 a.m. -
            9:00 p.m. and Saturday 12:00 p.m. - 6:00
            p.m. EST (Customer Care hours subject to change). The Applicant may write to SFE at:
            P.O. BOX 967, Buffalo, NY,
            14240-0967 or via email at cs@sfeenergy.com. SFE's
            fax number is 1-877-425-7010. The Applicant may contact the Applicant's NGC/EDU at:
            American Electric Power
            (AEP)-[Columbus Southern Power at Ohio Power] at
            1-800-672-2231 or at www.aepohio.com; Columbia Gas at 1-800-344-4077 or at
            www.columbiagasohio.com; Dayton Power & Light
            at 1-800-433-8500 or at www.
            dpandl.com; Dominion Energy Ohio at 1-800-362-7557 or at www.dominionenergy.com;
            Duke Energy at 1-800-544-6900 or at
            www.duke-energy.com; Ohio Edison
            at 1-800-633-4766; The Illuminating Company at 1-800-589-3101; Toledo Edison at
            1-800-447-3333; Vectren at
            1-800-227-1376 or at www.vectren.com.</li>
        <li><strong>Dispute Resolution</strong>. In the event of a question or concern, please
            contact SFE. The Applicant should contact SFE by
            telephone or in writing at the contact
            information provided above in Section 14. The parties agree to use their best
            efforts to resolve any dispute. If the
            Applicant's complaint is not resolved after the Applicant
            has called SFE, or for general utility information, business customers may contact
            the Public Utilities Commission of
            Ohio (PUCO) for assistance at 1-800-686-7826
            (toll free) from 8 a.m. to 5 p.m. weekdays, or at www.puco.ohio.gov. Hearing or
            speech impaired customers may contact
            the PUCO via 7-1-1 (Ohio relay service).
        </li>
        <li><strong>Taxes and Laws.</strong> Except as otherwise provided in the Agreement(s) or
            provided by law, all taxes of whatsoever kind,
            nature, and description due and payable
            with respect to service provided under the Agreement(s), shall be paid by the
            Applicant, and the Applicant agrees to
            indemnify SFE and hold SFE harmless from and
            against any and all such taxes. The Agreement(s) are subject to present and future
            legislation, orders, rules,
            regulations, or decisions of a duly constituted governmental
            authority having jurisdiction over the Agreement(s) or the services to be provided
            hereunder. If the Applicant is exempt
            of any taxes it is the Applicant's responsibility
            to contact SFE Customer Care (see Section 14) to provide such written notification,
            including written notification of
            renewed tax exemption. Otherwise, until the
            Applicant provides such proof, SFE is not required to recognize any exemption or
            refund/credit previously paid taxes.
            Tax exemption will only occur on the next meter
            read bill after such notice is received and acknowledged. The Agreement(s) shall be
            construed under and shall be
            governed by the laws of Ohio without regard to
            the application of its conflicts of law principles.</li>
        <li><strong>ARBITRATION.</strong> THE PARTIES AGREE THAT, AT THE REQUEST OF EITHER
            PARTY, ANY DISPUTE, CLAIM, OR CONTROVERSY ARISING OUT OF
            OR
            RELATING TO THIS AGREEMENT(S), INCLUDING ITS EXISTENCE, PERFORMANCE, INTERPRETATION,
            BREACH, VALIDITY, OR TERMINATION,
            AND
            WHICH ARE NOT OTHERWISE RESOLVED BY THE PARTIES SHALL BE SUBJECT TO AND FINALLY
            RESOLVED BY INDIVIDUAL ARBITRATION ONLY,
            EXCEPT THAT ANY DISPUTE OR CLAIM THAT MAY BE BROUGHT IN SMALL CLAIMS COURT OR ANY
            CLAIM THAT CANNOT BE ARBITRATED UNDER
            APPLICABLE LAW SHALL NOT BE SUBJECT TO ARBITRATION. ANY SUCH ARBITRATION SHALL BE
            THE PARTIES' SOLE AND EXCLUSIVE
            REMEDY. BY
            AGREEING TO ARBITRATION, YOU UNDERSTAND THAT ANY SUCH DISPUTE WILL BE DECIDED BY A
            NEUTRAL THIRD PARTY OUTSIDE OF COURT
            AND THAT YOU AND SFE ARE WAIVING YOUR RIGHTS TO SUE IN A COURT OF LAW AND TO HAVE A
            JURYTRIAL REGARDING SUCH DISPUTE.
            YOU AGREE THAT SUCH ARBITRATION PROVIDES YOU WITH A MEANINGFUL AND AFFORDABLE WAY TO
            HANDLE DISPUTES RELATED TO THIS
            AGREEMENT. The arbitration will be administered in accordance with the Rules of
            Arbitration of the state where the
            Service Address is located.
            The arbitrator(s) shall not have authority to join or combine the claims of more
            than one person or to hear or decide
            any class, collective or
            representative action of any kind against You or SFE. The award of the arbitrator
            shall be final and binding and
            judgment on it may be entered
            in any court of competent jurisdiction. The arbitration shall take place in the
            county seat of the county in which You
            reside. You and SFE shall
            each pay their own filing and legal fees and other expenses, unless provided
            otherwise by law or this Agreement. The
            interpretation and
            enforcement of this arbitration provision shall be governed by the Federal
            Arbitration Act. The arbitrator(s) selected
            according to the terms set
            forth herein shall determine the arbitrability of any matter brought to them, and
            their decision shall be final and
            binding on the Parties in all
            respects. This provision shall survive termination of this Agreement.</li>
        <li><strong>CLASS ACTION WAIVER AND OTHER RESTRICTIONS.</strong> ARBITRATION SHALL
            PROCEED SOLELY ON AN INDIVIDUAL BASIS WITHOUT THE RIGHT
            FOR ANY CLAIMS TO BE ARBITRATED ON A CLASS ACTION BASIS OR ON BASES INVOLVING CLAIMS
            BROUGHT IN A PURPORTED
            REPRESENTATIVE
            CAPACITY ON BEHALF OF OTHERS. YOU AND SFE EXPRESSLY WAIVE THE RIGHT TO COMMENCE, BE
            A PARTY TO, JOIN IN OR BE AN ACTUAL
            OR
            PUTATIVE CLASS MEMBER OF ANY CLASS, COLLECTIVE, GROUP, JOINT, OR RE PRESENTATIVE
            ACTION OF ANY KIND IN ANY FORUM,
            INCLUDING
            IN COURT AND ARBITRATION, ARISING FROM OR RELATED TO THIS AGREEMENT. The
            arbitrator's authority to resolve and make
            written awards
            is limited to claims between You and SFE alone. Claims may not be joined or
            consolidated unless agreed to in writing by
            all Parties. No arbitration award or decision will have any preclusive effect as to
            issues or claims in any dispute with
            anyone who is not a named Party to the arbitration. Notwithstanding any other
            provision in these Terms and Conditions,
            and without waiving either Party's right of appeal, if any portion
            of this “Class Action Waiver and Other Restrictions” provision is deemed invalid or
            unenforceable, then the entire
            Arbitration Provision (other
            than this sentence) shall not apply. This provision shall survive termination of
            this Agreement.</li>
        <li><strong>WAIVER OF JURY TRIAL.</strong> SUBJECT TO ANY AGREEMENT TO ARBITRATE BETWEEN
            YOU AND SFE YOU AND SEF WAIVE THE RIGHT TO A JURY
            TRIAL IN ANY CLAIM OR DISPUTE ARISING BETWEEN THE PARTIES ARISING FROM OR RELATED TO
            THIS AGREEMENT THAT PROCEEDS IN
            COURT,
            AND AGREE THAT THE CLAIM OR DISPUTE WILL BE HEARD AND DECIDED ONLY BY A JUDGE. This
            provision shall survive termination
            of this
            Agreement.</li>
        <li><strong>Delay or Failure to Exercise Rights.</strong> No partial performance, delay,
            or failure on the part of SFE in exercising any
            rights under the Agreement(s), and no partial
            or single exercise thereof, shall constitute a waiver of such rights or of any other
            rights hereunder.</li>
        <li><strong>Parties Bound.</strong> The Agreement(s) is/are binding upon the parties
            hereto and their respective successors and legal
            assigns.</li>
    </ol>
    <table style="width: 100%; border-collapse: collapse; page-break-before:always">
        <tr>
            <td style="text-align: center; border: 1px solid #2F557C;">
                <h4 style="margin-bottom: 0px;">Environmental Disclosure Information-Quarterly
                    Comparisons</h4>
            </td>
        </tr>
        <tr>
            <td style="text-align: center; border: 1px solid #2F557C;">SFE Energy Ohio, Inc.</td>
        </tr>
        <tr>
            <td style="text-align: center; border: 1px solid #2F557C;">Projected Data for the 2022
                Calendar Year</td>
        </tr>
        <tr>
            <td style="text-align: center; border: 1px solid #2F557C;">Actual Data for the Period
                01/01/22 to 03/31/22</td>
        </tr>
    </table>
    <table style="width: 100%;border-collapse: collapse;">
        <tbody>
            <tr>
                <td style="width: 20%; padding: 10px; vertical-align: top;border: 1px solid #2F557C">
                    <strong>Generation
                        Resource Mix</strong><br><br>
                    A comparison
                    between the sources
                    of generation
                    projected to be used
                    to generate this
                    product and the actual
                    resources used during
                    this period.
                </td>
                <td style="border: 1px solid #2F557C; padding: 5px">
                    <img src="images/7362332.jpg" style="width: 100%;">
                </td>
                <td style="border: 1px solid #2F557C; padding: 5px">
                    <img src="images/424343543.jpg" style="width: 100%;">
                </td>
            </tr>
            <tr>
                <td style="width: 20%; padding: 10px; vertical-align: top;border: 1px solid #2F557C">
                    <strong>Generation
                        Environmental
                        Characteristics</strong><br><br>
                    A description of
                    the characteristics
                    associated with
                    each possible
                    generation resource.
                </td>
                <td colspan="2" style="border: 1px solid #2F557C; padding: 20px">
                    <table style="width: 100%;border-collapse: collapse;">
                        <tbody>
                            <tr>
                                <td style="border: 1px solid #2F557C; padding: 2px 4px; font-size: 9px">
                                    Biomass Power
                                </td>
                                <td style="border: 1px solid #2F557C; padding: 2px 4px; font-size: 9px">Air Emissions
                                    and
                                    Solid Waste</td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #2F557C; padding: 2px 4px; font-size: 9px">
                                    Coal Power
                                </td>
                                <td style="border: 1px solid #2F557C; padding: 2px 4px; font-size: 9px">Air Emissions
                                    and
                                    Solid Waste</td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #2F557C; padding: 2px 4px; font-size: 9px">
                                    Hydro Power
                                </td>
                                <td style="border: 1px solid #2F557C; padding: 2px 4px; font-size: 9px">Wildlife Impacts
                                </td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #2F557C; padding: 2px 4px; font-size: 9px">
                                    Natural Gas Power
                                </td>
                                <td style="border: 1px solid #2F557C; padding: 2px 4px; font-size: 9px">Air Emissions
                                    and
                                    Solid Waste</td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #2F557C; padding: 2px 4px; font-size: 9px">
                                    Nuclear Power
                                </td>
                                <td style="border: 1px solid #2F557C; padding: 2px 4px; font-size: 9px">Radioactive
                                    Waste</td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #2F557C; padding: 2px 4px; font-size: 9px">
                                    Oil Power
                                </td>
                                <td style="border: 1px solid #2F557C; padding: 2px 4px; font-size: 9px">Air Emissions
                                    and
                                    Solid Waste</td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #2F557C; padding: 2px 4px; font-size: 9px">
                                    Other Sources
                                </td>
                                <td style="border: 1px solid #2F557C; padding: 2px 4px; font-size: 9px">Unknown Impacts
                                </td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #2F557C; padding: 2px 4px; font-size: 9px">
                                    Solar Power
                                </td>
                                <td style="border: 1px solid #2F557C; padding: 2px 4px; font-size: 9px">No Significant
                                    Impacts
                                </td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #2F557C; padding: 2px 4px; font-size: 9px">
                                    Unknown Purchased Resources
                                </td>
                                <td style="border: 1px solid #2F557C; padding: 2px 4px; font-size: 9px">Unknown Impacts
                                </td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #2F557C; padding: 2px 4px; font-size: 9px">
                                    Wind Power
                                </td>
                                <td style="border: 1px solid #2F557C; padding: 2px 4px; font-size: 9px">Wildlife Impacts
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="width: 20%; padding: 10px; vertical-align: top; border: 1px solid #2F557C">
                    <strong>Air
                        Emissions</strong><br><br>
                    Product-specific
                    projected and actual
                    air emissions for this
                    period compared to
                    the regional average
                    air emissions.
                </td>
                <td colspan="2" style="border: 1px solid #2F557C; padding: 5px">
                    <img src="images/5234653.jpg" style="width: 100%;">
                </td>
            </tr>
            <tr>
                <td style="width: 20%; padding: 10px; vertical-align: top;border: 1px solid #2F557C">
                    <strong>Radioactive
                        Waste</strong><br><br>
                    Radioactive waste
                    associated with the
                    product.
                </td>
                <td colspan="2" style="border: 1px solid #2F557C; padding: 10px">
                    <table style="width: 100%; border-collapse: collapse;">
                        <tr>
                            <td style="text-align: center;border: 1px solid #2F557C; padding: 2px 4px;"">Type:</td>
                            <td style=" text-align: center;border: 1px solid #2F557C; padding: 2px 4px;"" colspan="2">
                                Quantity:</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #2F557C; padding: 2px 4px;">High-Level Radioactive
                                Waste</td>
                            <td style="border: 1px solid #2F557C; padding: 2px 4px;">Unknown</td>
                            <td style="border: 1px solid #2F557C; padding: 2px 4px;">Lbs./1,000 kWh</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #2F557C; padding: 2px 4px;">Low-Level Radioactive
                                Waste</td>
                            <td style="border: 1px solid #2F557C; padding: 2px 4px;">Unknown</td>
                            <td style="border: 1px solid #2F557C; padding: 2px 4px;">Ft5/1,000 kWh</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="3" style="border: 1px solid #2F557C; padding: 10px">
                    With in-depth analysis, the environmental characteristics of any form of
                    electric
                    generation will reveal benefits as
                    well
                    as costs. For further information, contact SFE Energy Ohio, Inc. via
                    email at
                    cs@sfeenergy.com or by phone at
                    1-866-255-3844
                </td>
            </tr>
        </tbody>
    </table>
    <table>
        <tbody>
            <tr>
                <td>
                    <h5 style="text-align: center; margin-bottom: 30px;">Schedule A - Account Listings</h5>
                    <table style="width: 100%; border-collapse:collapse">
                        <tbody>
                            <tr>
                                <th style="border: 1px solid #333; font-size: 8px">Business Name On Bill</th>
                                <th style="border: 1px solid #333; font-size: 8px">Street Address</th>
                                <th style="border: 1px solid #333; font-size: 8px">City</th>
                                <th style="border: 1px solid #333; font-size: 8px">Zipcode</th>
                                <th style="border: 1px solid #333; font-size: 8px">Service Type</th>
                                <th style="border: 1px solid #333; font-size: 8px">Account Type</th>
                                <th style="border: 1px solid #333; font-size: 8px">Utility</th>
                                <th style="border: 1px solid #333; font-size: 8px">Requested Flow Date</th>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                                <td style="border: 1px solid #333; height: 20px; width: 12%;"></td>
                            </tr>
                        </tbody>
                    </table>
                    <table style="width: 100%; margin-top: 30px">
                        <tr>
                            <td>
                                <table style="width: 100%;">
                                    <tr>
                                        <td style="width: 1px; white-space: nowrap">
                                            <label>Representative Name:</label>
                                        </td>
                                        <td>
                                            <input type="text">
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table style="width: 100%;">
                                    <tr>
                                        <td style="width: 1px; white-space: nowrap">
                                            <label>Representative Signature:</label>
                                        </td>
                                        <td>
                                            <input type="text">
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table style="width: 100%;">
                                    <tr>
                                        <td style="width: 1px; white-space: nowrap">
                                            <label>Customer Signature:</label>
                                        </td>
                                        <td>
                                           <div style="border-bottom: 1px solid #333; width:100%; height:20px;" id="signature"></div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table style="width: 100%;">
                                    <tr>
                                        <td style="width: 1px; white-space: nowrap">
                                            <label>Date Signed:</label>
                                        </td>
                                        <td>
                                            <input type="text">
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table style="width: 100%;">
                                    <tr>
                                        <td style="width: 1px; white-space: nowrap">
                                            <label>Print Name:</label>
                                        </td>
                                        <td>
                                            <input type="text">
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table style="width: 100%;">
                                    <tr>
                                        <td style="width: 1px; white-space: nowrap">
                                            <label>Print Title:</label>
                                        </td>
                                        <td>
                                            <input type="text">
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>
