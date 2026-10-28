<?php session_start(); ?>
<?php include 'navbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Hotel | San Andres Residences</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="navbar.css">
    <style>
        body {
            background: linear-gradient(135deg, #f8f8f8 60%, #e9e4f0 100%);
            font-family: 'Segoe UI', Arial, sans-serif;
        }
        .hotel-hero {
            position: relative;
            width: 100%;
            min-height: 320px;
            background: url('images/hotel-hero.jpg') center/cover no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 32px;
        }
        .hotel-hero::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(34,34,59,0.45);
            z-index: 1;
        }
        .hotel-hero-content {
            position: relative;
            z-index: 2;
            text-align: center;
            color: #fff;
        }
        .hotel-hero-content h1 {
            font-size: 2.8rem;
            font-weight: 900;
            letter-spacing: 2px;
            margin-bottom: 10px;
        }
        .hotel-hero-content p {
            font-size: 1.25rem;
            font-weight: 400;
            color: #ffe;
        }
        .hotel-section {
            max-width: 1300px;
            margin: 48px auto 32px auto;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 2px 16px rgba(0,0,0,0.06);
            padding: 48px 32px 32px 32px;
        }
        .hotel-section-title {
            text-align: center;
            font-size: 2rem;
            font-weight: 800;
            color: #2c3e50;
            margin-bottom: 0.5rem;
        }
        .hotel-divider {
            width: 60px;
            height: 3px;
            background: #e0c36e;
            margin: 0 auto 32px auto;
            border-radius: 2px;
        }
        .hotel-row {
            display: flex;
            gap: 48px;
            flex-wrap: wrap;
        }
        .hotel-col {
            flex: 2 1 0;
            min-width: 320px;
        }
        .hotel-col-right {
            flex: 1 1 0;
            min-width: 320px;
        }
        .hotel-title {
            font-family: 'Georgia', serif;
            font-size: 1.5rem;
            font-weight: 600;
            letter-spacing: 1px;
            margin-bottom: 18px;
        }
        .hotel-table {
            width: 100%;
            background: #fafafa;
            border-radius: 8px;
            margin-bottom: 24px;
            font-size: 1.08rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }
        .hotel-table th, .hotel-table td {
            padding: 10px 16px;
            text-align: left;
        }
        .hotel-table th {
            font-weight: 700;
            background: #f3e7c3;
            color: #222;
        }
        .hotel-table tr:not(:last-child) {
            border-bottom: 1px solid #eee;
        }
        .certificate {
            text-align: center;
            margin-top: 32px;
        }
        .certificate img {
            width: 120px;
            margin-bottom: 8px;
        }
        .certificate-label {
            font-size: 1.1rem;
            color: #444;
        }
        .why-stay-section {
            max-width: 1100px;
            margin: 0 auto 48px auto;
            background: #fffbe6;
            border-radius: 18px;
            box-shadow: 0 2px 8px rgba(255,196,59,0.08);
            padding: 40px 32px 32px 32px;
        }
        .why-stay-title {
            text-align: center;
            font-size: 1.7rem;
            font-weight: 800;
            color: #2c3e50;
            margin-bottom: 24px;
        }
        .why-stay-list {
            display: flex;
            flex-wrap: wrap;
            gap: 32px;
            justify-content: center;
        }
        .why-stay-item {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            padding: 22px 28px;
            font-size: 1.13rem;
            color: #444;
            display: flex;
            align-items: center;
            gap: 14px;
            min-width: 220px;
        }
        .why-stay-item i {
            color: #ffc43b;
            font-size: 1.7rem;
        }
        .policy-section {
            max-width: 900px;
            margin: 0 auto 32px auto;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            padding: 32px 32px 24px 32px;
        }
        .policy-title {
            font-family: 'Georgia', serif;
            font-size: 1.25rem;
            font-weight: 600;
            letter-spacing: 1px;
            margin-bottom: 12px;
        }
        .policy-section:not(:first-child) {
            margin-top: 0;
        }
        .policy-section hr {
            margin: 18px 0;
        }
        @media (max-width: 991px) {
            .hotel-section, .policy-section, .why-stay-section {
                padding: 24px 8px 16px 8px;
            }
            .hotel-row {
                flex-direction: column;
                gap: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="hotel-hero">
        <div class="hotel-hero-content">
            <h1>Welcome to Alacrity Auberge</h1>
            <p>Modern comfort, exceptional service, and a memorable stay in the heart of the city.</p>
        </div>
    </div>
    <div class="hotel-section">
        <div class="hotel-section-title">About Us</div>
        <div class="hotel-divider"></div>
        <div class="hotel-row">
            <div class="hotel-col">
                <div class="hotel-title">ABOUT US</div>
                <p><b>Alacrity Auberge</b> is conveniently located in the heart of the city, offering easy access to local attractions, restaurants, and shopping centers. Our hotel provides a modern, stylish environment at affordable prices, with a focus on comfort, quality, and guest satisfaction.</p>
                <p>This newly refurbished hotel offers an excellent standard of accommodation in a quiet and fashionable environment. All rooms are equipped with contemporary amenities and facilities, including free WiFi and parking. Guests can enjoy a selection of hot & cold breakfast buffet, business center, and meeting room facilities.</p>
                <p>Whether you are here for business or leisure, our friendly staff is always ready to assist you and make your stay memorable.</p>
                <div class="hotel-divider mx-auto my-4"></div>
                <div class="text-center" style="max-width:700px;margin:0 auto;">
                    <div class="fw-bold mb-2" style="font-size:1.15rem;">Project & Academic Information</div>
                    <div>This website is a <b>final requirement</b> for the course <b>CCS0043L</b> (Application Development).</div>
                    <div>Block: <b>TC23</b></div>
                    <div>School: <b>FEU Institute of Technology</b></div>
                    <div class="mt-2" style="color:#666;">This project was created for educational purposes only. All content, images, and features are part of a student submission and do not represent a real hotel business.</div>
                </div>
            </div>
            <div class="hotel-col-right">
                <div class="hotel-title">HOTEL ACCOMMODATION</div>
                <table class="hotel-table">
                    <thead>
                        <tr>
                            <th>ROOMS</th>
                            <th>NUM. OF ROOMS</th>
                            <th>MAX. ADULTS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Double or Twin Room</td>
                            <td>40</td>
                            <td><i class="fa fa-user"></i> <i class="fa fa-user"></i></td>
                        </tr>
                        <tr>
                            <td>Superior Twin Room</td>
                            <td>4</td>
                            <td><i class="fa fa-user"></i> <i class="fa fa-user"></i></td>
                        </tr>
                        <tr>
                            <td>Grand Superior Room</td>
                            <td>2</td>
                            <td><i class="fa fa-user"></i> <i class="fa fa-user"></i> <i class="fa fa-user"></i></td>
                        </tr>
                    </tbody>
                </table>
                <div class="hotel-title">CERTIFICATE</div>
                <div class="certificate">
                    <img src="images/certificate.png" alt="Certificate">
                    <div class="certificate-label">TripAdvisor Certificate of Excellence</div>
                </div>
            </div>
        </div>
    </div>
    <!-- Unique Hotel Content -->
    <div class="hotel-section mt-5 text-center">
        <div class="hotel-section-title">Our Story</div>
        <div class="hotel-divider mx-auto"></div>
        <div class="mb-4" style="max-width:800px;margin:0 auto;">
            <p>Founded with a passion for hospitality, Alacrity Auberge began as a family-run inn and has grown into a modern boutique hotel. Our mission is to provide a welcoming, memorable experience for every guest, blending local charm with world-class comfort. We believe in genuine service, attention to detail, and creating a home away from home for travelers from all walks of life.</p>
        </div>
        <div class="hotel-section-title">Awards & Recognitions</div>
        <div class="hotel-divider mx-auto"></div>
        <div class="mb-4 d-flex flex-column align-items-center gap-3">
            <img src="images/certificate.png" alt="TripAdvisor Certificate" style="height:80px;width:auto;border-radius:10px;box-shadow:0 2px 8px rgba(0,0,0,0.10);">
            <div>
                <strong>TripAdvisor Certificate of Excellence</strong><br>
                Recognized for outstanding guest reviews and service quality.<br>
                <span class="badge bg-success mt-2">2024 Winner</span>
            </div>
        </div>
        <div class="hotel-section-title">Sustainability & Community</div>
        <div class="hotel-divider mx-auto"></div>
        <div class="mb-4" style="max-width:800px;margin:0 auto;">
            <p>We are committed to eco-friendly practices, including energy-efficient lighting, water conservation, and recycling programs. Alacrity Auberge supports local farmers and artisans, and we regularly participate in community clean-up and charity events. Your stay helps us make a positive impact on our environment and neighborhood.</p>
        </div>
        <div class="hotel-section-title">Meet the Team</div>
        <div class="hotel-divider mx-auto"></div>
        <div class="mb-4" style="max-width:900px;margin:0 auto;">
            <div class="row justify-content-center g-4">
                <div class="col-6 col-md-3">
                    <div class="team-card text-center">
                        <img src="images/ruzzel.jpg" alt="Ruzzel Gania" class="rounded-circle mb-2" style="width:100px;height:100px;object-fit:cover;border:4px solid #ffc43b;box-shadow:0 2px 8px rgba(0,0,0,0.10);">
                        <div class="fw-bold">Ruzzel Gania</div>
                        <div class="text-muted">Head Coder</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="team-card text-center">
                        <img src="images/lander.jpg" alt="Lander Leander" class="rounded-circle mb-2" style="width:100px;height:100px;object-fit:cover;border:4px solid #ffc43b;box-shadow:0 2px 8px rgba(0,0,0,0.10);">
                        <div class="fw-bold">Lander Leander</div>
                        <div class="text-muted">Assistant Coder</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="team-card text-center">
                        <img src="images/ely.jpg" alt="Ely Leonardo" class="rounded-circle mb-2" style="width:100px;height:100px;object-fit:cover;border:4px solid #ffc43b;box-shadow:0 2px 8px rgba(0,0,0,0.10);">
                        <div class="fw-bold">Ely Leonardo</div>
                        <div class="text-muted">Documentation and file management</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="team-card text-center">
                        <img src="images/isabelpo.jpg" alt="Isabel De Gracia" class="rounded-circle mb-2" style="width:100px;height:100px;object-fit:cover;border:4px solid #ffc43b;box-shadow:0 2px 8px rgba(0,0,0,0.10);">
                        <div class="fw-bold">Isabel De Gracia</div>
                        <div class="text-muted">Assistant in file managing and documenting.</div>
                    </div>
                </div>
            </div>
            <div class="mt-4" style="font-size:1.08rem;">Our dedicated team is the heart of Alacrity Auberge. From our front desk staff to housekeeping and management, every member is passionate about making your stay exceptional. We pride ourselves on warm smiles, local knowledge, and going the extra mile for our guests.</div>
        </div>
        <div class="hotel-section-title">Loyalty Program</div>
        <div class="hotel-divider mx-auto"></div>
        <div class="mb-4" style="max-width:800px;margin:0 auto;">
            <p>Join our Guest Rewards Program and enjoy exclusive benefits, including room upgrades, late check-out, and special offers for returning guests. Ask our front desk for details and start earning rewards with every stay!</p>
        </div>
        <div class="hotel-section-title">Accessibility & Safety</div>
        <div class="hotel-divider mx-auto"></div>
        <div class="mb-4" style="max-width:800px;margin:0 auto;">
            <p>Alacrity Auberge is committed to providing a safe and accessible environment for all guests. We offer accessible rooms, ramps, and elevators, as well as 24/7 security and enhanced cleaning protocols for your peace of mind.</p>
        </div>
    </div>
    <div class="policy-section">
        <div class="policy-title">GENERAL POLICIES</div>
        <div>Check In: 14:00 Hrs<br>Check Out: 12:00 Hrs</div>
        <hr>
        <div class="policy-title">CHILDREN POLICY</div>
        <div>
            Baby Cots for infants are available Free of charge<br>
            1st Child, 2-12 years old is Free of charge on Terms Booked<br>
            2nd Child, 2-12 years old – A discount of 50% applies on Terms Booked
        </div>
        <hr>
        <div class="policy-title">CANCELLATION POLICY</div>
        <div>
            For reservations cancelled prior 48 hours of arrival, No Cancellation Fee will be charged.<br>
            For reservations cancelled within 48 hours of arrival, the equivalent of 1 day's Cancellation Fee will be charged.<br>
            For "no show", the whole amount of the reservation will be charged.<br>
            In case of a cancellation of a NON REFUNDABLE reservation, the whole amount of reservation will be charged.
        </div>
        <hr>
        <div class="policy-title">TERMS OF PAYMENT</div>
        <div>
            Cash, Credit Card or Bank Transfer are all acceptable forms of payment.<br>
            All prices quoted are in PHP and are inclusive of all taxes and surcharges.
        </div>
        <hr>
        <div class="policy-title">SMOKING</div>
        <div>
            Smoking is strictly prohibited in all public areas of the hotel including elevators, corridors, lounge, lobby and the breakfast area.<br>
            Smoking is permitted on the balconies or patios and all outside areas.<br>
            Smoking rooms are available on request.
        </div>
        <hr>
        <div class="policy-title">PETS</div>
        <div>No Pets are allowed.</div>
    </div>
<?php include 'footer.php'; ?>
</body>
</html> 