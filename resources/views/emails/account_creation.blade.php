<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Creation Notification</title>
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
            max-width: 150px;
        }

        h1 {
            color: #333333;
            font-size: 24px;
            margin-top: 0;
        }

        p {
            color: #555555;
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
            <img src="{{ $message->embed(public_path('images/logo.png')) }}" alt="BPP Logo">
        </div>
        <h1>Account Creation</h1>
        <p>Dear {{ $name }},</p>
        <p>An administrative account with the following role <b>{{ $role }}</b> has been created for you. Your
            temporary password is: <b>{{ $password }}</b></p>
        <p>Please use the button below to verify your email address and get started.</p>
        <div class="code"><a href="{{ env('APP_URL') }}/verify/{{ $token }}"><button
                    class="btn btn-primary btn-md"
                    style="background: #030E37; border: #030E37; color:white; padding:15px; border-radius: 5px ">Verify
                    My Email</button></a></div>
        <p>&nbsp;</p>
        <p>Thank you,<br>Arete Support Team</p>
    </div>
</body>

</html>
