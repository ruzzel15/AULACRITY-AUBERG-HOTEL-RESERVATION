<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Location | Alacrity Auberge</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link rel="stylesheet" href="navbar.css">
  <style>
    .location-hero {
      background: linear-gradient(rgba(0,0,0,0.45), rgba(0,0,0,0.45)), url('images/location-hero.jpg') center/cover no-repeat;
      color: #fff;
      padding: 80px 0 40px 0;
      text-align: center;
    }
    .location-section {
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 2px 16px rgba(0,0,0,0.07);
      padding: 32px 24px;
      margin-top: -40px;
      margin-bottom: 40px;
      max-width: 900px;
      margin-left: auto;
      margin-right: auto;
    }
    .location-address {
      font-size: 1.2rem;
      font-weight: 500;
      color: #333;
      margin-bottom: 12px;
    }
    .location-directions {
      color: #555;
      margin-bottom: 18px;
    }
    .location-map {
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 2px 12px rgba(0,0,0,0.08);
      margin-bottom: 24px;
    }
    .location-contact {
      font-size: 1.08rem;
      color: #444;
    }
    @media (max-width: 768px) {
      .location-section {
        padding: 18px 6px;
      }
      .location-hero {
        padding: 48px 0 24px 0;
      }
    }
  </style>
</head>
<body>
  <?php include 'navbar.php'; ?>

  <div class="location-hero">
    <h1 class="display-5 fw-bold mb-2">Our Location</h1>
    <p class="lead">Find Alacrity Auberge in the heart of the city</p>
  </div>

  <div class="location-section">
    <div class="location-address mb-2">
      <i class="fa fa-map-marker-alt text-warning me-2"></i>
      123 City Center Avenue, Downtown, Metro City, 10001
    </div>
    <div class="location-directions mb-3">
      <i class="fa fa-location-arrow text-primary me-2"></i>
      <b>Directions:</b> Alacrity Auberge is located just 5 minutes from Central Station and 20 minutes from the airport. Easily accessible by taxi, bus, or metro. Secure parking is available for guests.
    </div>
    <div class="location-map mb-4">
      <iframe src="https://www.google.com/maps?q=123+City+Center+Avenue,+Metro+City,+10001&output=embed" width="100%" height="340" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <div class="row g-3 align-items-center">
      <div class="col-md-6">
        <div class="location-contact mb-2">
          <i class="fa fa-phone-alt text-success me-2"></i>
          <a href="tel:+1234567890" class="text-decoration-none text-dark">+1 234 567 890</a>
        </div>
        <div class="location-contact mb-2">
          <i class="fa fa-envelope text-danger me-2"></i>
          <a href="mailto:info@alacrityauberge.com" class="text-decoration-none text-dark">info@alacrityauberge.com</a>
        </div>
        <div class="location-contact">
          <i class="fa fa-globe text-info me-2"></i>
          <a href="https://alacrityauberge.com" class="text-decoration-none text-dark">alacrityauberge.com</a>
        </div>
      </div>
      <div class="col-md-6">
        <div class="location-contact mb-2">
          <i class="fa fa-clock text-warning me-2"></i>
          <b>Check-in:</b> 2:00 PM &nbsp; <b>Check-out:</b> 12:00 PM
        </div>
        <div class="location-contact mb-2">
          <i class="fa fa-car text-primary me-2"></i>
          <b>Parking:</b> On-site, secure, and complimentary for guests
        </div>
        <div class="location-contact">
          <i class="fa fa-train text-secondary me-2"></i>
          <b>Nearby:</b> Central Station (5 min walk), Metro Line 2 (2 min walk)
        </div>
      </div>
    </div>
  </div>

  <?php include 'footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
