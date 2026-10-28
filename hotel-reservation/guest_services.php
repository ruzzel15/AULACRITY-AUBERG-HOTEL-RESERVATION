<?php session_start(); ?>
<?php include 'navbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guest Services & Facilities</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="navbar.css">
    <style>
        body {
            background: #f8f8f8;
            font-family: 'Segoe UI', Arial, sans-serif;
        }
        .facilities-header {
            text-align: center;
            margin-top: 48px;
            margin-bottom: 24px;
        }
        .facilities-header h1 {
            font-size: 2.5rem;
            font-weight: 600;
            letter-spacing: 2px;
            margin-bottom: 12px;
        }
        .facilities-divider {
            width: 60px;
            height: 3px;
            background: #e0c36e;
            margin: 0 auto 32px auto;
            border-radius: 2px;
        }
        .facilities-section {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 2px 16px rgba(0,0,0,0.06);
            max-width: 1300px;
            margin: 0 auto 48px auto;
            padding: 48px 32px 32px 32px;
        }
        .facilities-cols {
            display: flex;
            gap: 0;
            justify-content: center;
        }
        .facilities-col {
            flex: 1 1 0;
            padding: 0 36px;
            min-width: 260px;
        }
        .facilities-col:not(:last-child) {
            border-right: 1px solid #eee;
        }
        .facilities-col h2 {
            font-size: 1.5rem;
            font-family: 'Georgia', serif;
            font-weight: 500;
            letter-spacing: 1px;
            margin-bottom: 18px;
            text-align: center;
        }
        .facilities-col ul {
            list-style: disc inside;
            font-size: 1.08rem;
            color: #222;
            padding-left: 0;
        }
        @media (max-width: 991px) {
            .facilities-cols {
                flex-direction: column;
            }
            .facilities-col:not(:last-child) {
                border-right: none;
                border-bottom: 1px solid #eee;
                margin-bottom: 32px;
            }
            .facilities-col {
                padding: 0 0 24px 0;
            }
        }
    </style>
</head>
<body>
    <div class="facilities-header">
        <h1>Guest Services & Facilities</h1>
        <div class="facilities-divider"></div>
    </div>
    <div class="facilities-section">
        <div class="facilities-cols">
            <div class="facilities-col">
                <h2>Guest Services</h2>
                <ul>
                    <li>Room Service</li>
                    <li>Express Check-in/Check-out</li>
                    <li>Early Check-in (upon request)</li>
                    <li>Free WiFi</li>
                    <li>Free Parking at Hotel Proximity</li>
                    <li>Car Hire</li>
                    <li>24-Hour Front Desk</li>
                    <li>Laundry/Dry cleaning</li>
                    <li>Business Center</li>
                    <li>Fax/Photocopying</li>
                    <li>Wake-Up Service</li>
                </ul>
            </div>
            <div class="facilities-col">
                <h2>HOTEL FACILITIES</h2>
                <ul>
                    <li>Bar</li>
                    <li>Restaurant</li>
                    <li>Meeting Room</li>
                    <li>Luggage Storage Room</li>
                    <li>Outside Sitting Smoking Area</li>
                    <li>Elevator</li>
                    <li>Lobby</li>
                </ul>
            </div>
            <div class="facilities-col">
                <h2>ROOM FACILITIES</h2>
                <ul>
                    <li>Laptop Size Safety Box</li>
                    <li>Double or Twin Beds</li>
                    <li>Non-smoking rooms</li>
                    <li>Soundproof rooms</li>
                    <li>Balcony</li>
                    <li>International Telephone</li>
                    <li>Flat Satellite TV</li>
                    <li>Air conditioning & Heating</li>
                    <li>MiniBar</li>
                    <li>Tea & Coffee Facilities</li>
                    <li>Shower</li>
                    <li>Room Amenities (Shampoo, Shower Gel, Bath Soap, ToothBrush & ToothPaste, Slippers)</li>
                    <li>Magnifying Mirror</li>
                    <li>Free Wine, Water & Fruit upon arrival</li>
                </ul>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
</body>
</html> 