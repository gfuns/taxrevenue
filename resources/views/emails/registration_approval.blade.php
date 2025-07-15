<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@if($company->application_type == "revalidation") Revalidation @else Registration @endif Application Approved</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .logo {
            /* text-align: center; */
            margin-bottom: 20px;
        }

        .logo img {
            max-width: 345px;
        }

        h1 {
            /* color: #333333; */
            font-size: 24px;
            margin-top: 0;
        }

        p {
            /* color: #555555; */
            font-size: 16px;
            line-height: 1.5;
        }

        .code {
            margin-top: 30px;
            padding: 15px;
            background-color: #f9f9f9;
            border-radius: 8px;
            font-size: 20px;
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="logo">
            <img src="{{ $message->embed(public_path('images/logo_mail.png')) }}" alt="BPP Logo">
        </div>
       <!-- Title -->
        <h1>@if($company->application_type == "revalidation") Revalidation @else Registration @endif Application Approved</h1>

        <!-- Greeting -->
        <p>Dear {{ $user->last_name . ', ' . $user->other_names }}</p>

        <!-- Message -->
        <p>
            We are pleased to inform you that your application for <strong>contractor @if($company->application_type == "revalidation") revalidation  @else registration @endif </strong> has been
            successfully reviewed and approved.
        </p>
        <p>
            You can now download your official certificate by logging into your dashboard. This certificate confirms your
            eligibility to participate in procurement activities with the commission.
        </p>

        <!-- Footer -->
        <p style="margin-top: 30px;">
            If you encounter any issues or have questions, feel free to contact our support team.
        </p>

        <p>Warm regards,<br>{{ env('APP_NAME') }} Team</p>
    </div>
</body>

</html>
