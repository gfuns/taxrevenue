<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Receipt</title>
    <style>
        body {
            width: 150mm;
            margin: 30px auto;
            font-family: 'Courier New', monospace;
            font-size: 14px;
            color: #000;
            text-align: left;
        }

        .receipt {
            padding: 10px;
        }

        .center {
            text-align: center;
        }

        .logo {
            max-width: 250px;
            margin: 0 auto 5px;
        }

        .divider {
            border-top: 1px dashed #000;
            margin: 5px 0;
        }

        .bold {
            font-weight: bold;
        }

        .item {
            display: flex;
            justify-content: space-between;
        }

        .qr-code {
            margin-top: 10px;
            text-align: center;
            /* max-height: 50px; */
        }

        .footer {
            text-align: center;
            margin-top: 10px;
        }

        /* Hide print button when printing */
        @media print {
            #print-btn {
                display: none !important;
            }

            body {
                margin: 0;
                width: 100mm;
                font-size: 12px;
            }

            .logo {
                max-width: 200px;
            }
        }

        /* Print Button */
        #print-btn {
            margin: 20px auto;
            display: block;
            padding: 10px 20px;
            font-size: 14px;
            background-color: #14532d;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #print-btn:hover {
            background-color: #0e4023;
        }
    </style>
</head>

<body onload="window.print()">

    <!-- Receipt Content -->
    <div class="receipt">
        <!-- Logo -->
        <div class="center">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
            <p><strong>Benue State Public Procurement Commission</strong><br>
                Payment Receipt</p>
        </div>

        <div class="divider"></div>

        <!-- Receipt Info -->
        <div class="item">
            <span>Reference No:</span> <span>{{ $trx->reference_number }}</span>
        </div>
        <div class="item">
            <span>Date:</span> <span>{{ date_format($trx->created_at, 'd/m/Y H:i:sA') }}</span>
        </div>

        <div class="divider"></div>

        <div class="item">
            <span>Applicant's Name</span><span>{{ $trx->company->company_name }}</span>
        </div>

        <div class="item">
            <span>Applicant's Email</span><span>{{ $trx->company->email }}</span>
        </div>

        <div class="item">
            <span>Applicant's Phone</span><span>{{ $trx->company->phone_number }}</span>
        </div>

        <div class="divider"></div>

        <!-- Items -->
        <div class="item">
            <span>Requested Service</span><span>Power Of Attorney</span>
        </div>

        <div class="item">
            <span>Application Fee</span><span>&#8358;{{ number_format($trx->amount_paid, 2) }}</span>
        </div>

        <div class="divider"></div>

        <!-- Total -->
        <div class="item bold">
            <span>Total</span><span>&#8358;{{ number_format($trx->amount_paid, 2) }}</span>
        </div>

        <div class="divider"></div>

        <p>
            @php
                $amount = 2500;
                $formatter = new \NumberFormatter('en', \NumberFormatter::SPELLOUT);
                $inWords = ucwords($formatter->format($trx->amount_paid));
            @endphp
            <!-- Amount in Words -->
        <p><strong>In Words:</strong> {{ $inWords }} Naira Only</p>

        <!-- Footer -->
        <div class="footer">
            <p>Thank you for your payment!</p>
        </div>

        <!-- QR Code -->
        <div class="qr-code">
             {!! $QRImage !!}
            <p>Scan to verify</p>
        </div>
    </div>

    <!-- Centered Print Button -->
    <button id="print-btn" onclick="window.print()">Print Receipt</button>

</body>

</html>
