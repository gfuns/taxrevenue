<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contractor Processing Fee Remittance Pending Approval</title>
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
        <h1>Contractor Processing Fee Remittance</h1>

        <!-- Greeting -->
        <p>Dear {{ $user->last_name . ', ' . $user->other_names }}</p>

        <!-- Message -->
        <p>I hope this message finds you well.</p>
        <p>This is to inform you that a contractor has applied to remit the required 1% Processing Fee on the procurement
            platform. The application is currently awaiting your review and approval.</p>
        <p> You may log in to the administrator dashboard to review the submission and take the appropriate action.</p>

        <p>Please let us know if you require any further information.</p>

        <p>Warm regards, <br/>BSPPC Notification Engine</p>
    </div>
</body>

</html>
