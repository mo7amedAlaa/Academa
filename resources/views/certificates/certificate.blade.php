<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate of Completion</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        .certificate-container {
            width: 80%;
            margin: 0 auto;
            padding: 50px;
            border: 5px solid #000;
            border-radius: 10px;
            background: #f5f5f5;
            position: relative;
        }

        /* Academia Seal Style */
        .academia-seal {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: #2D9CDB;
            /* Blue background for the seal */
            color: white;
            font-size: 1.2em;
            font-weight: bold;
            display: flex;
            justify-content: center;
            align-items: center;
            text-transform: uppercase;
            border: 6px solid #fff;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            position: absolute;
            top: 10%;
            right: 10%;
            z-index: 1;
            padding: 10px;
            transform: rotate(-15deg);
            /* Slightly tilted for a "stamp" effect */
        }

        .academia-seal .symbol {
            font-size: 1.4em;
        }

        .academia-seal .text {
            text-align: center;
            line-height: 1.2;
            display: block;
        }

        .academia-seal .top-part {
            font-size: 0.7em;
            letter-spacing: 2px;
        }

        .academia-seal .bottom-part {
            font-size: 0.9em;
            margin-top: -10px;
        }

        h1 {
            font-size: 3em;
            color: #2D9CDB;
        }

        h2 {
            font-size: 2em;
            margin-top: 20px;
        }

        p {
            font-size: 1.5em;
            margin-top: 20px;
        }

        .footer {
            margin-top: 50px;
            font-size: 1.2em;
            color: #555;
        }

        .qr-image {
            width: 150px;
            /* Set the size of the QR code */
            height: 150px;
            border: 2px solid #2D9CDB;
            /* Add a border around the QR code */
            padding: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            /* Optional shadow effect */
            margin-top: 30px;
            margin-bottom: 30px;
        }
    </style>
</head>

<body>

    <div class="certificate-container">
        <!-- Academia Seal with Symbols -->
        <div class="academia-seal">
            <span class="symbol">&#x1F4D6;</span> <!-- Book symbol -->
            <span class="text">
                <span class="top-part">Academia</span>
                <span class="bottom-part">Seal</span>
            </span>
        </div>
        <div class="qr-code">
            <img src="{{ asset('qr_codes/certificate_qr_308_99.png') }}" class="qr-image">
        </div>
        <h1>Certificate of Completion</h1>
        <h2>{{ $user->name }} has successfully completed the course:</h2>
        <p><strong>{{ $course->title }}</strong></p>
        <p>on {{ now()->format('F j, Y') }}</p>

        <div class="footer">
            <p>Instructor: {{ $course->instructor->user->name }}</p>
            <p>Issued by: Your Platform Name</p>
        </div>

    </div>

</body>

</html>