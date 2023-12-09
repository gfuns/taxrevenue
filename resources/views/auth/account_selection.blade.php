<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Selection</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .account-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 100px;
            max-width: 600px;
            text-align: center;
        }

        .account-type {
            background-color: #f5f5f5;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border: 1px solid #667085;
        }

        .account-type img {
            max-width: 100px;
            max-height: 100px;
            margin-bottom: 10px;
        }

        @media (max-width: 600px) {
            .account-grid {
                grid-template-columns: 1fr;
                width: 100%;
                padding: 25px;
                gap: 50px;
            }

            .account-type {
                display: flex;
                flex-direction: row;
                align-items: center;
                text-align: center;
                padding: 0px;
                margin: 0px;
            }

            .account-type img {
                max-width: 70px;
                max-height: 70px;
                margin-bottom: 5px;
                padding-right: 30px
                /* Adjust spacing between image and text */
            }
        }
    </style>
</head>

<body>
    <div class="account-grid">
        <div class="account-type">
            <img src="{{ asset('auth/images/business.png') }}" alt="Business Icon">
            <p style="font-size: 22px; color: #403E3E; font-weight:bolder; font-family:Arial, Helvetica, sans-serif">
                <strong>Business</strong></p>
        </div>
        <div class="account-type">
            <img src="{{ asset('auth/images/artisan.png') }}" alt="Artisan Icon">
            <p style="font-size: 22px; color: #403E3E; font-weight:bolder; font-family:Arial, Helvetica, sans-serif">
                <strong>Artisan</strong></p>
        </div>
    </div>
</body>

</html>
