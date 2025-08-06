<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to {{ env('APP_NAME') }}</title>
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
            <img src="{{ $message->embed(public_path('images/logo_green.png')) }}" alt="BPP Logo">
        </div>
        <h2>Welcome to {{ env('APP_NAME') }}!</h2>
        <p>Dear {{ $user->last_name . ', ' . $user->other_names }}</p>

        <p>We are delighted to welcome you to the {{ env('APP_NAME') }}. This platform is designed to make
            procurement-related processes seamless, transparent, and efficient. Here’s what you can now do on the
            portal:</p>

        <ul>
            <li><b>Apply for Company Registration:</b> Begin your journey as a registered contractor with the Benue
                State Government.</li>
            <li><b>Renew Existing Registrations:</b> Seamlessly renew your company’s registration and maintain your
                eligibility for government contracts.</li>
            <li><b>Submit Power of Attorney Applications:</b> Upload and manage legal documentation required for
                procurement representation.</li>
            <li><b>Request for Award Letters:</b> Apply for and retrieve official procurement award letters issued by
                the Bureau.</li>
            <li><b>Make Processing Fee Payments:</b> Pay all associated procurement fees securely through the portal.
            </li>
        </ul>

        <p>Our goal is to ensure accountability, transparency, and ease of access for all users. Should you need any
            assistance, feel free to contact our support team via the helpdesk section of the portal.</p>

        <div class="">
            <p>Best regards,<br>{{ env('APP_NAME') }} Team</p>
        </div>

    </div>
</body>

</html>
