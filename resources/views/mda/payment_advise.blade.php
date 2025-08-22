<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - PayOutlet</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            background: #fff;
            margin: 20px;
            color: #222;
            font-size: 12px
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .header img {
            height: 30px;
        }

        .info-boxes {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            margin-bottom: 40px;
        }

        .box {
            border: 1px solid #d9e6f7;
            border-radius: 6px;
            text-align: center;
        }


        .boxOne {
            width: 200px;
        }

        .boxTwo {
            width: 300px;
        }

        .box span {
            display: block;
            font-weight: normal;
            color: #222;
            margin-bottom: 5px;
        }

        .section {
            margin-top: 25px;
            border: 1px solid #d9e6f7;
            border-radius: 6px;
        }

        .section-header {
            background: #d9e6f7;
            padding: 8px 15px;
            font-weight: bold !important;
        }

        .section-body {
            padding: 10px;
            font-size: 14px !important;
            font-weight: bold !important;
        }

        .section table {
            width: 100%;
            border-collapse: collapse;
        }

        .section table td {
            border-top: 1px solid #d9e6f7;
            padding: 8px 15px;
        }

        .banks {
            margin-top: 30px;
            text-align: center;
        }

        .banks p {
            margin-bottom: 30px;
        }

        .banks img {
            height: 20px;
            margin: 8px;
        }

        .footer {
            margin-top: 50px;
            text-align: center;

        }

        .footer img {
            width: 200px;
        }

        .heading {
            background: #f2f7ff;
            width: 30%
        }
    </style>
</head>

<body>

    <!-- Header -->
    <div class="header">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/banks/payoutlet.jpeg'))) }}"
            alt="PayOutlet Logo">
        <!-- Replace with actual PayOutlet logo -->
    </div>

    <!-- Amount and CRN -->
    <table style="width: 100%;">
        <tr>
            <td>
                <div class="box boxOne">
                    <span class="section-header">Invoice Amount</span>
                    <span class="section-body">&#8358;{{ number_format($trx->total, 2) }} </span>
                </div>
            </td>
            <td style="text-align: right;">
                <div class="box boxTwo" style="float: right;">
                    <span class="section-header">Credo Reference Number (CRN)</span>
                    <span class="section-body"> 000008516523 </span>
                </div>
                </div>
            </td>
        </tr>
    </table>

    <!-- Biller Information -->
    <div class="section">
        <div class="section-header">Biller Information</div>
        <table>
            <tr>
                <td class="heading">Biller Name</td>
                <td>Payoutlet / Credo Checkout</td>
            </tr>
            <tr>
                <td class="heading">Reference Number</td>
                <td>000008516523</td>
            </tr>
            <tr>
                <td class="heading">Transaction ID</td>
                <td>o318O0Gfc034mS80c66e</td>
            </tr>
        </table>
    </div>

    <!-- Payer Information -->
    <div class="section">
        <div class="section-header">Payer Information</div>
        <table>
            <tr>
                <td class="heading">Name</td>
                <td>{{ $trx->tax_payer }}</td>
            </tr>
            <tr>
                <td class="heading">Phone Number</td>
                <td>{{ isset($trx->user_id) ? $trx->user->phone_number : 'NIL' }}</td>
            </tr>
            <tr>
                <td class="heading">Email</td>
                <td>{{ isset($trx->user_id) ? $trx->user->email : 'NIL' }}</td>
            </tr>
        </table>
    </div>

    <!-- Payment Details -->
    <div class="section">
        <div class="section-header">Payment Details</div>
        <table>
            <tr>
                <td class="heading">Amount</td>
                <td>&#8358;{{ number_format($trx->total, 2) }}</td>
            </tr>
            <tr>
                <td class="heading">Amount in Words</td>
                <td>{{ $trx->amountInWords() }} Naira</td>
            </tr>
            <tr>
                <td class="heading">Merchant Ref.</td>
                <td>{{ $trx->reference }}</td>
            </tr>
            <tr>
                <td class="heading">Merchant Name</td>
                <td>Benue State Internal Revenue Services (BIRS)</td>
            </tr>
        </table>
    </div>

    <!-- Banks -->
    <div class="banks">
        <p>Available Banks to pay using eTranzact PayOutlet</p>
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/banks/globus.jpeg'))) }}"
            alt="Globus Bank">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/banks/keystone.jpeg'))) }}"
            alt="Keystone Bank">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/banks/polaris.jpeg'))) }}"
            alt="Polaris Bank">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/banks/stanbic.jpeg'))) }}"
            alt="Stanbic IBTC Bank">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/banks/signature.jpeg'))) }}"
            alt="Signature Bank">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/banks/unity.jpeg'))) }}"
            alt="Unity Bank">
        <br>
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/banks/uba.jpeg'))) }}"
            alt="UBA">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/banks/access.jpeg'))) }}"
            alt="Access Bank">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/banks/premium.jpeg'))) }}"
            alt="Premium Trust Bank">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/banks/zenith.jpeg'))) }}"
            alt="Zenith Bank">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/banks/suntrust.jpeg'))) }}"
            alt="SunTrust Bank">
    </div>

    <!-- Footer -->
    <div class="footer">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/banks/etranzact.jpeg'))) }}"
            alt="eTranzact">
    </div>

</body>

</html>
