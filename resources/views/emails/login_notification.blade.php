<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Notification</title>
    <style>
        /* CSS Styles */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.5;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo {
            max-width: 345px;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        p {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
            font-size: 13px;
        }

        th {
            background-color: #f5f5f5;
        }

        .verification-code {
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
        <div class="header">
            <img class="logo" src="{{ $message->embed(public_path('images/logo_mail.png')) }}"
                alt="{{ env('APP_NAME') }} Logo">
        </div>

        <h2>Login Notification</h2>

        <p>Dear {{ $user->first_name . ' ' . $user->last_name }},</p>

        <p>This is to notify you that a new login attempt has been successful on your {{ env('APP_NAME') }} account.
            Details of this action is shownbelow:</p>

        <table>
            <tbody>
                <tr>
                    <th>Device</th>
                    <td>{{ $deviceInfo['device'] }}</td>
                </tr>
                <tr>
                    <th>Browser</th>
                    <td>{{ $deviceInfo['browser'] }}</td>
                </tr>
                <tr>
                    <th>IP Address</th>
                    <td>{{ $deviceInfo['ip_address'] }}</td>
                </tr>
                <tr>
                    <th>Location</th>
                    <td>{{ $deviceInfo["location"] }}</td>
                </tr>
            </tbody>
        </table>

        <p>If you didn't initiate this authentication attempt into your {{ env('APP_NAME') }} account, it means someone
            else has access to your account login credentials and has successfully accessed your account. Please take
            necessary steps to secure your account.</p>

        <p>If you have any questions or need further assistance, please feel free to contact our support team.</p>

        <div class="">
            <p>Best regards,<br>{{ env('APP_NAME') }} Team</p>
        </div>


    </div>
</body>

</html>
