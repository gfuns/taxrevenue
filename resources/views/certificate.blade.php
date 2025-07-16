<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <style type="text/css">
        @page {
            margin: 0;
            size: A4 portrait;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            font-family: 'Averta', sans-serif;
            position: relative;
        }

        .certificate-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
        }

        .content {
            position: absolute;
            top: 0;
            left: 0;
            width: 85%;
            height: 100%;
            z-index: 1;
            padding: 50px 60px;
            box-sizing: border-box;
        }

        .logo {
            position: absolute;
            top: 60px;
            left: 70px;
            width: 130px;
        }

        .passport {
            position: absolute;
            top: 60px;
            right: 100px;
            width: 100px;
            /* height: 80px; */
        }

        .certificate-title {
            text-align: center;
            font-size: 22px;
            font-weight: bold;
            margin-top: 150px;
        }

        .sub-title {
            text-align: center;
            font-size: 16px;
            margin-top: 10px;
            font-weight: bold;
        }

        .certify-text {
            /* width: 90%; */
            text-align: center;
            font-size: 20px;
            margin-top: 50px;
        }

        .certify-subtext {
            margin-top: 40px;
            padding: 15px;
            font-size: 18px;
            line-height: 25px;
        }

        .company-name {
            font-size: 20px;
            font-weight: bold;
            background: #f5f5f5;
            display: inline-block;
            padding: 8px 20px;
            margin-top: 10px;
        }

        .details {
            margin: 30px auto;
            width: 90%;
            background: #f9f9f9;
            padding: 20px;
            font-size: 14px;
        }

        .details table {
            width: 100%;
            border-collapse: collapse;
        }

        .details td {
            padding: 6px;
            vertical-align: top;
        }

        .signature-section {
            position: absolute;
            bottom: 130px;
            left: 60px;
            right: 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .signature-label {
            font-size: 14px;
            margin-top: 5px;
            text-align: center;
            font-weight: bold;
        }

        .qr-code {
            width: 100px;
        }
    </style>
</head>

<body>
    <!-- Background Image -->
    <img class="certificate-bg"
        src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/certificate.png'))) }}"
        alt="Certificate Background">

    <div class="content">
        <!-- Logo and Photograph -->
        <div>
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('website/assets/images/benue-logo.png'))) }}" alt="BSPPC Logo" class="logo">
            <img src="{{ $company->user->profile_photo }}" alt="Passport Photograph" class="passport">
        </div>
        <!-- Header -->
        <div class="certificate-title" style="">
            BENUE STATE PUBLIC PROCUREMENT COMMISSION
        </div>
        <div class="sub-title">CERTIFICATION OF WORKS REGISTRATION</div>

        <!-- Company Info -->
        <div class="certify-text">
            This is to certify that <br>
            <div class="company-name">{{ strtoupper($company->company_name) }}</div>
        </div>

        <p class="certify-subtext">
            Whose director's photograph appears above was duly registered as a contractor with the Benue State
            Public Procurement Commission with the following details:
        </p>

        <!-- Details -->
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
                    <td>{{ strtoupper(date_format($expiryDate, 'jS F, Y')) }}</td>
                </tr>
            </table>
        </div>

        <!-- Signature and QR -->
        <div class="signature-section">
            <div>
                <img src="{{ asset('images/signature.png') }}" style="width: 150px" />
                <div class="signature-label">Authorised Signature</div>
            </div>
            <div class="qr-code">
                {!! QrCode::size(100)->generate($qrcodeURL) !!}
            </div>
        </div>
    </div>
</body>

</html>
