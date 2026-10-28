<?php session_start(); ?>
<?php include 'navbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery | Alacrity Auberge</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="navbar.css">
    <style>
        body {
            background: linear-gradient(135deg, #f8f8f8 60%, #e9e4f0 100%);
            font-family: 'Segoe UI', Arial, sans-serif;
        }
        .gallery-hero {
            position: relative;
            width: 100%;
            min-height: 320px;
            background: url('images/gallery-hero.jpg') center/cover no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 32px;
        }
        .gallery-hero::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(34,34,59,0.45);
            z-index: 1;
        }
        .gallery-hero-content {
            position: relative;
            z-index: 2;
            text-align: center;
            color: #fff;
        }
        .gallery-hero-content h1 {
            font-size: 2.8rem;
            font-weight: 900;
            letter-spacing: 2px;
            margin-bottom: 10px;
        }
        .gallery-hero-content p {
            font-size: 1.25rem;
            font-weight: 400;
            color: #ffe;
        }
        .gallery-section {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 2px 16px rgba(0,0,0,0.06);
            max-width: 1300px;
            margin: 0 auto 48px auto;
            padding: 48px 32px 32px 32px;
        }
        .gallery-section-title {
            text-align: center;
            font-size: 2rem;
            font-weight: 800;
            color: #2c3e50;
            margin-bottom: 0.5rem;
        }
        .gallery-divider {
            width: 60px;
            height: 3px;
            background: #e0c36e;
            margin: 0 auto 32px auto;
            border-radius: 2px;
        }
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 28px;
        }
        .gallery-img-card {
            background: #f8f8f8;
            border-radius: 16px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            padding: 0 0 18px 0;
            transition: box-shadow 0.2s, transform 0.2s;
            position: relative;
            overflow: hidden;
        }
        .gallery-img-card:hover {
            box-shadow: 0 8px 32px rgba(0,0,0,0.13);
            transform: translateY(-6px) scale(1.03);
        }
        .gallery-img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            border-radius: 16px 16px 0 0;
            transition: transform 0.2s;
        }
        .gallery-img-card:hover .gallery-img {
            transform: scale(1.04);
        }
        .gallery-caption {
            text-align: center;
            font-weight: 700;
            margin-top: 12px;
            color: #2c3e50;
            font-size: 1.13rem;
        }
        .gallery-highlight {
            text-align: center;
            color: #888;
            font-size: 0.98rem;
            margin-top: 2px;
        }
        .amenities-section {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 2px 8px rgba(255,196,59,0.08);
            max-width: 1300px;
            margin: 0 auto 48px auto;
            padding: 48px 32px 32px 32px;
        }
        .amenities-section-title {
            text-align: center;
            font-size: 2rem;
            font-weight: 800;
            color: #2c3e50;
            margin-bottom: 0.5rem;
        }
        .amenities-divider {
            width: 60px;
            height: 3px;
            background: #e0c36e;
            margin: 0 auto 32px auto;
            border-radius: 2px;
        }
        .gallery-amenities-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 28px;
        }
        .gallery-amenity-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            padding: 0 0 18px 0;
            transition: box-shadow 0.2s, transform 0.2s;
            position: relative;
            overflow: hidden;
            text-align: center;
        }
        .gallery-amenity-card:hover {
            box-shadow: 0 8px 32px rgba(0,0,0,0.13);
            transform: translateY(-6px) scale(1.03);
        }
        .gallery-amenity-img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            border-radius: 16px 16px 0 0;
        }
        .gallery-amenity-caption {
            font-weight: 700;
            color: #2c3e50;
            font-size: 1.13rem;
            margin-top: 12px;
        }
        .gallery-amenity-desc {
            color: #888;
            font-size: 0.98rem;
            margin-top: 2px;
        }
        @media (max-width: 991px) {
            .gallery-section, .amenities-section {
                padding: 24px 8px 16px 8px;
            }
            .gallery-header {
                margin-top: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="gallery-hero">
        <div class="gallery-hero-content">
            <h1>Alacrity Auberge Gallery</h1>
            <p>Discover our beautiful rooms and world-class amenities. See what makes your stay special!</p>
        </div>
    </div>
    <div class="gallery-section">
        <div class="gallery-section-title">Our Rooms</div>
        <div class="gallery-divider"></div>
        <div class="gallery-grid">
            <div class="gallery-img-card">
                <img src="images/standard.jpg" class="gallery-img" alt="Standard Room">
                <div class="gallery-caption">Standard Room</div>
                <div class="gallery-highlight">Best for couples or solo travelers</div>
            </div>
            <div class="gallery-img-card">
                <img src="images/deluxe.jpg" class="gallery-img" alt="Deluxe Room">
                <div class="gallery-caption">Deluxe Room</div>
                <div class="gallery-highlight">Spacious comfort with city view</div>
            </div>
            <div class="gallery-img-card">
                <img src="images/grand deluxe.jpg" class="gallery-img" alt="Grand Deluxe Room">
                <div class="gallery-caption">Grand Deluxe Room</div>
                <div class="gallery-highlight">Luxury and panoramic windows</div>
            </div>
            <div class="gallery-img-card">
                <img src="images/superior twin.jpg" class="gallery-img" alt="Superior Twin Room">
                <div class="gallery-caption">Superior Twin Room</div>
                <div class="gallery-highlight">Perfect for friends or colleagues</div>
            </div>
            <div class="gallery-img-card">
                <img src="images/family.jpg" class="gallery-img" alt="Family Suite">
                <div class="gallery-caption">Family Suite</div>
                <div class="gallery-highlight">Ideal for families, extra space</div>
            </div>
            <div class="gallery-img-card">
                <img src="images/penthouse.jpg" class="gallery-img" alt="Penthouse Suite">
                <div class="gallery-caption">Penthouse Suite</div>
                <div class="gallery-highlight">Ultimate luxury, top floor</div>
            </div>
        </div>
    </div>
    <div class="amenities-section">
        <div class="amenities-section-title">Amenities</div>
        <div class="amenities-divider"></div>
        <div class="gallery-amenities-grid">
            <div class="gallery-amenity-card">
                <img src="images/gym.jpg" alt="Gym" class="gallery-amenity-img">
                <div class="gallery-amenity-caption">Gym</div>
                <div class="gallery-amenity-desc">Stay fit with our modern fitness center</div>
            </div>
            <div class="gallery-amenity-card">
                <img src="images/lobby.jpg" alt="Lobby" class="gallery-amenity-img">
                <div class="gallery-amenity-caption">Lobby</div>
                <div class="gallery-amenity-desc">Spacious, stylish, and welcoming</div>
            </div>
            <div class="gallery-amenity-card">
                <img src="images/pool.jpg" alt="Swimming Pool" class="gallery-amenity-img">
                <div class="gallery-amenity-caption">Swimming Pool</div>
                <div class="gallery-amenity-desc">Relax and refresh in our pool</div>
            </div>
            <div class="gallery-amenity-card">
                <img src="images/spa.jpg" alt="Spa" class="gallery-amenity-img">
                <div class="gallery-amenity-caption">Spa</div>
                <div class="gallery-amenity-desc">Pamper yourself with spa treatments</div>
            </div>
            <div class="gallery-amenity-card">
                <img src="images/parking.jpg" alt="Parking" class="gallery-amenity-img">
                <div class="gallery-amenity-caption">Parking</div>
                <div class="gallery-amenity-desc">Free and secure parking for guests</div>
            </div>
            <div class="gallery-amenity-card">
                <img src="images/resto.jpg" alt="Restaurant" class="gallery-amenity-img">
                <div class="gallery-amenity-caption">Restaurant</div>
                <div class="gallery-amenity-desc">Delicious cuisine in our on-site resto</div>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
</body>
</html> 