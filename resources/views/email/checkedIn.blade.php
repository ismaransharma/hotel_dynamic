<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Your Room Booking Has Been Checked-In!</title>

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins&display=swap");

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #fff;
            min-width: 100vw;
        }

        .card {
            background-color: #fff;
            padding: 20px;
            box-shadow: 0px 0px 8px 8px #ccc;
            width: 600px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .card .logo {
            text-align: center;
        }

        .card .logo img {
            height: 50px;
        }

        .card .name {
            margin: 20px 0;
        }

        .card .name h3 {
            font-weight: 600;
        }

        .card .heading {
            margin-bottom: 20px;
        }

        .card .heading p {
            font-weight: 100;
        }

        .card .credentials {
            margin-bottom: 20px;
        }

        .card .credentials span {
            color: blue;
            font-weight: bold;
        }

        .card ol {
            margin: 5px 0px 20px 30px;
        }

        .card .link {
            margin-bottom: 20px;
        }

        .card .link a {
            color: blue;
        }

        .card .button {
            text-align: center;
            margin-bottom: 20px;
        }

        .card .button a {
            background-color: #0e82fd;
            padding: 10px 20px;
            border-radius: 10px;
            color: white;
            text-decoration: none;
            font-weight: bold;
            text-transform: capitalize;
        }

        .card .thanks {
            margin-bottom: 20px;
        }

        .card .thanks span {
            font-weight: bold;
            color: #0e82fd;
        }

        .card .copyright {
            text-align: center;
        }

        .card .copyright a {
            text-decoration: none;
            font-weight: bold;
        }

        /* Add responsive styling for mobile devices */
        @media only screen and (max-width: 600px) {
            .card {
                width: 100%;
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="logo">
            <img src="" alt="Siddhartha Park Regency" title="Siddhartha Park Regency" />
        </div>
        <div class="name">
            <h3>Hello, {{ $name }}</h3>
        </div>
        <div class="heading">
            <p>
                Your room booking has been successfully checked in.
                Please keep this email as it contains all the details of your booking.
            </p>
        </div>
        <div class="credentials">
            <h2>Here are the details of your booking:</h2>
            <br />
            <b>Booking ID: </b> <span>{{ $booking_id }}</span> <br />
            <b>Arrival Date: </b> <span>{{ $arrival_date }}</span> <br />
            <b>Departure Date: </b> <span>{{ $departure_date }}</span> <br />
            <br />
            <b>Members: </b> <br> 
            <span>Adults: {{ $adult }}</span> <br> 
            <span>Children: {{ $children }}</span>
            <br>
            <span>Total: Rs. {{ $total_price }}</span>
        </div>

        <div class="button">
            <a href="">Visit Our Website</a>
        </div>

        <div class="thanks">
            <p>
                Thank you,<br />
                <span>Siddhartha Park Regency</span>
            </p>
        </div>

        <div class="copyright">
            <p>&copy; 2025 Siddhartha Park Regency. All Rights Reserved.</p>
        </div>
    </div>
</body>
</html>
