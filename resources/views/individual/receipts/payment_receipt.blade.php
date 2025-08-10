<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Receipt - Benue State Internal Revenue Service</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        .receipt-container {
            /* max-width: 800px; */
            margin: 0 auto;
            background-color: white;
            padding: 40px;
            position: relative;
            overflow: hidden;
        }

        .watermark {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            pointer-events: none;
            z-index: 1;
        }

        .watermark-text {
            position: absolute;
            font-size: 24px;
            font-weight: bold;
            color: rgba(200, 200, 200, 0.3);
            transform: rotate(-90deg);
            white-space: nowrap;
            user-select: none;
        }

        .content {
            position: relative;
            z-index: 2;
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
        }

        .header h1 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            letter-spacing: 1px;
        }

        .header-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }

        .receipt-info {
            text-align: right;
        }

        .receipt-title {
            font-size: 20px;
            font-weight: bold;
            color: #ff6b35;
            margin-bottom: 5px;
        }

        .generated-date {
            font-size: 12px;
            color: #666;
        }

        .qr-rrr-section {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 40px;
        }

        .qr-code {
            /* width: 120px;
            height: 120px; */
            border: 2px solid #000;
            background-color: white;
            /* padding: 4px; */
        }

        .qr-pixel {
            background-color: #000;
        }

        .qr-pixel:nth-child(2n) {
            background-color: white;
        }

        .qr-pixel:nth-child(3n) {
            background-color: #000;
        }

        .qr-pixel:nth-child(5n) {
            background-color: white;
        }

        .rrr-section {
            text-align: right;
            /* padding: 8px 16px; */
            background-color: #EFF7EE;
        }

        .rrr-label {
            width: 100% !important;
            background-color: #D3E8CF;
            padding: 8px;
            /* border-radius: 4px; */
            margin-bottom: 10px;
            font-size: 12px;
            font-weight: 500;
            display: inline-block;
            text-align: center;
        }

        .rrr-number {
            font-size: 28px;
            font-weight: bold;
            color: #333;
            padding: 8px 16px;
        }

        .section-header {
            background-color: #f0e6d2;
            padding: 10px 16px;
            border-radius: 4px 4px 0 0;
            font-weight: bold;
            font-size: 12px;
            text-transform: uppercase;
        }

        .info-table {
            width: 100%;
            border: 1px solid #fff;
            border-collapse: collapse;
            margin-bottom: 30px;
            font-size: 12px;
        }

        .info-table td {
            padding: 10px 16px;
            border: 1px solid #fff;
            background-color: #EFF7EE;
        }

        .info-table .label-cell {
            background-color: #D3E8CF;
            font-weight: 500;
            width: 25%;
        }

        .payment-table {
            width: 100%;
            border: 1px solid #fff;
            border-collapse: collapse;
            margin-bottom: 30px;
            font-size: 11px;
        }

        .payment-table th {
            background-color: #D3E8CF;
            padding: 8px 12px;
            text-align: left;
            font-weight: 500;
            border: 1px solid #fff;
            font-size: 10px;
            text-transform: uppercase;
        }

        .payment-table td {
            padding: 8px 12px;
            border: none;
            background-color: #EFF7EE;
        }

        .payment-table .total-row {
            font-weight: bold;
        }

        .balance-due {
            color: #ff0000;
            font-weight: bold;
        }

        .channel-table {
            width: 100%;
            border: 1px solid #fff;
            border-collapse: collapse;
            margin-bottom: 30px;
            font-size: 12px;
        }

        .channel-table th {
            background-color: #e8f5e8;
            padding: 10px 16px;
            text-align: left;
            font-weight: 500;
            border: 1px solid #fff;
            font-size: 10px;
            text-transform: uppercase;
        }

        .channel-table td {
            padding: 10px 16px;
            border: 1px solid #fff;
        }

        .footer {
            text-align: center;
            font-size: 11px;
            color: #666;
            margin-top: 30px;
        }

        .empty-section {
            background-color: #f0e6d2;
            padding: 10px 16px;
            border-radius: 4px;
            font-weight: bold;
            font-size: 12px;
            text-transform: uppercase;
            margin-bottom: 30px;
        }

         /* Hide print button when printing */
        @media print {
            #print-btn {
                display: none !important;
            }

            .logo {
                max-width: 200px;
            }
        }

    </style>
</head>

<body onload="window.print()">
    <div class="receipt-container">
        <!-- Watermarks -->
        <div class="watermark">
            <!-- Left side remita watermarks -->
            <div class="watermark-text" style="top: 5%; left: -0.5%; font-size: 20px;">remita</div>
            <div class="watermark-text" style="top: 15%; left: -0.5%; font-size: 20px;">remita</div>
            <div class="watermark-text" style="top: 25%; left: -0.5%; font-size: 20px;">remita</div>
            <div class="watermark-text" style="top: 35%; left: -0.5%; font-size: 20px;">remita</div>
            <div class="watermark-text" style="top: 45%; left: -0.5%; font-size: 20px;">remita</div>
            <div class="watermark-text" style="top: 55%; left: -0.5%; font-size: 20px;">remita</div>
            <div class="watermark-text" style="top: 65%; left: -0.5%; font-size: 20px;">remita</div>
            <div class="watermark-text" style="top: 75%; left: -0.5%; font-size: 20px;">remita</div>
            <div class="watermark-text" style="top: 85%; left: -0.5%; font-size: 20px;">remita</div>

            <!-- Right side BENUE STATE watermarks -->
            <div class="watermark-text" style="top: 55%; right: -19.5%; font-size: 20px;">BENUE STATE INTERNAL REVENUE
                SERVICE</div>
        </div>

        <div class="content">
            <!-- Header -->
            <div class="header">
                <h1>BENUE STATE INTERNAL REVENUE SERVICE</h1>
                <div class="header-row">
                    <div style="width: 120px;"></div>
                    <div class="receipt-info">
                        <div class="receipt-title">Payment Receipt</div>
                        <div class="generated-date">Generated On {{ date_format($trx->created_at, 'd/m/Y') }}</div>
                    </div>
                </div>
            </div>

            <!-- QR Code and RRR Section -->
            <div class="qr-rrr-section">
                <div class="qr-code">
                    {!! $QRImage !!}
                </div>

                <div class="rrr-section">
                    <div class="rrr-label">Transaction Reference Number</div>
                    @php
                        $input = preg_replace('/BSPPC-/', '', $trx->reference);
                        $firstTwelve = substr($input, 0, 12);

                        // Split into chunks of 4 and join with dashes
                        $formatted = implode('-', str_split($firstTwelve, 4));
                    @endphp
                    <div class="rrr-number">{{ $formatted }}</div>
                </div>
            </div>

            <!-- Payer Information -->
            <div>
                <div class="section-header">PAYER INFORMATION</div>
                <table class="info-table">
                    <tr>
                        <td class="label-cell">NAME</td>
                        <td colspan="2">
                            {{ strtoupper($trx->taxpayer->tax_payer) }}
                        </td>
                    </tr>
                    <tr>
                        <td class="label-cell">EMAIL</td>
                        <td colspan="2">{{ strtoupper($trx->user->email) }}</td>
                    </tr>
                    <tr>
                        <td class="label-cell">PHONE NUMBER</td>
                        <td colspan="2">{{ $trx->user->phone_number }}</td>
                    </tr>
                </table>
            </div>

            <!-- Payment Details -->
            <div>
                <div class="section-header">PAYMENT DETAILS</div>
                <table class="payment-table">
                    <thead>
                        <tr>
                            <th>PAYMENT DATE</th>
                            <th>PAYMENT REF</th>
                            <th>SERVICE DESCRIPTION</th>
                            <th>AMOUNT (NGN)</th>
                            <th>CHARGES (NGN)</th>
                            <th>VAT ON CHARGES (NGN)</th>
                            <th>TOTAL (NGN)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ date_format($trx->created_at, 'd/m/Y') }}</td>
                            <td>{{ $trx->reference }}</td>
                            <td>{{ strtoupper($trx->narration) }}</td>
                            <td>{{ number_format($trx->amount, 2) }}</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>{{ number_format($trx->amount, 2) }}</td>
                        </tr>
                        <tr class="total-row">
                            <td></td>
                            <td></td>
                            <td>TOTAL PAID</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>{{ number_format($trx->amount, 2) }}</td>
                        </tr>
                        <tr class="total-row">
                            <td></td>
                            <td></td>
                            <td>TOTAL AMOUNT</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>{{ number_format($trx->amount, 2) }}</td>
                        </tr>
                        <tr class="total-row balance-due">
                            <td></td>
                            <td></td>
                            <td>BALANCE DUE</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>0.00</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Biller Required Information -->
            <div class="empty-section">
                BILLER REQUIRED INFORMATION
            </div>

            <!-- Payment Channel Information -->
            <div>
                <div class="section-header">PAYMENT CHANNEL INFORMATION</div>
                <table class="channel-table">
                    <thead>
                        <tr>
                            <th>PAYMENT CHANNEL</th>
                            <th>MASKED CARD PAN</th>
                            <th>AUTHORIZATION REF</th>
                            <th>CARD SCHEME</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $trx->payment_channel }}</td>
                            <td></td>
                            <td>{{ $trx->authorization_ref }}</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Footer -->
            <div class="footer">
                You can contact BIRS Support at birs@benuestate.gov.ng or on +234 806 591 7504, 0704 884 5572
            </div>
        </div>
    </div>

    <!-- Centered Print Button -->
    <center><button id="print-btn" onclick="window.print()" style="padding: 7px 12px; cursor:pointer">Print Receipt</button></center>
</body>

</html>
