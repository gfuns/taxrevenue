<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Download Certificate</title>
    <style>
        body {
            font-family: 'Arial', serif;
            background: #fff;
            margin: 0;
            padding: 0;
        }

        .certificate-container {
            width: 900px;
            height: 1275px;
            margin: 0 auto;
            padding: 50px;
            border: 40px solid #c00;
            box-sizing: border-box;
            position: relative;
        }

        .header {
            text-align: center;
            margin-top: 20px;
        }

        .logo {
            width: 100px;
            position: absolute;
            top: 50px;
            left: 50px;
        }

        .decor-top-right {
            position: absolute;
            top: 40px;
            right: 40px;
            width: 80px;
            height: 80px;
        }

        .certificate-title {
            font-size: 18px;
            font-weight: bold;
            margin-top: 20px;
        }

        .sub-title {
            font-size: 16px;
            margin-top: 10px;
        }

        .certify-text {
            margin-top: 60px;
            text-align: center;
            font-size: 18px;
        }

        .company-name {
            font-weight: bold;
            font-size: 22px;
            background: #f5f5f5;
            display: inline-block;
            padding: 8px 20px;
            margin-top: 20px;
        }

        .details {
            margin-top: 50px;
            font-size: 16px;
            background: #f9f9f9;
            padding: 20px;
        }

        .details p {
            margin: 8px 0;
        }

        .signature-section {
            margin-top: 80px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .signature {
            font-family: 'Brush Script MT', cursive;
            font-size: 24px;
        }

        .signature-label {
            font-size: 14px;
            margin-top: 5px;
        }

        .qr-code {
            width: 100px;
        }

        .decor-bottom {
            position: absolute;
            bottom: 40px;
            left: 40px;
            width: 80px;
        }

        .decor-bottom-right {
            position: absolute;
            bottom: 40px;
            right: 40px;
            width: 80px;
        }
    </style>
</head>

<body>
    <div class="certificate-container">
        <img src="{{ asset('website/assets/images/benue-logo.png') }}" alt="BSPPC Logo" class="logo">
        <img src="decor-top-right.png" alt="Decoration" class="decor-top-right">

        <div class="header">
            <div class="certificate-title">
                BENUE STATE PUBLIC PROCUREMENT COMMISSION
            </div>
            <div class="sub-title">CERTIFICATION OF WORKS REGISTRATION</div>
        </div>

        <div class="certify-text">
            This is to certify that <br>
            <div class="company-name" style="margin-top: 50px;">{{ strtoupper($company->company_name) }}</div>
        </div>
        <p style="margin-top: 40px;">
            Whose director's photograph appears above was duly registered as a contractor with the Benue State Public
            Procurement Commission with following details:
        </p>

        <div class="details">
            <table>
                <tr>
                    <td width="25%"><strong>ADDRESS:</strong></td>
                    <td>{{ strtoupper($company->company_address) }}</td>
                </tr>
                <tr>
                    <td><strong>CLASS:</strong></td>
                    <td>{{ $company->classification }}</td>
                </tr>
                <tr>
                    <td><strong>LGA:</strong></td>
                    <td>{{ $company->lga ?? 'MAKURDI' }}</td>
                </tr>
                <tr>
                    <td><strong>VALID TILL:</strong></td>
                    <td>{{ date_format($expiryDate, 'Y-m-d') }}</td>
                </tr>
            </table>
        </div>

        <div class="signature-section">
            <div>
                <div class="signature"><img src="{{ asset('images/signature.png') }}" style="width: 150px" /></div>
                <div class="signature-label">Authorised Signature</div>
            </div>
            <img src="qrcode.png" alt="QR Code" class="qr-code">
        </div>

        <img src="decor-bottom.png" alt="Decoration" class="decor-bottom">
        <img src="decor-bottom-right.png" alt="Decoration" class="decor-bottom-right">
    </div>
</body>

</html>
