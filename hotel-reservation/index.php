<?php
session_start();
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Alacrity Auberge - Home</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<style>
body { background: #fff; }

.top-bar {
  width: 100%;
  height: 36px;
  background: #13161a;
  color: #fff;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0 40px;
  font-size: 15px;
}

.navbar {
  width: 100%;
  min-height: 110px;
  background: linear-gradient(90deg, rgba(19,22,26,0.92) 60%, rgba(34,40,49,0.85) 100%);
  backdrop-filter: blur(8px);
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 16px 34px;
  box-shadow: 0 4px 18px rgba(0,0,0,0.10);
  border-radius: 0 0 18px 18px;
  position: sticky;
  top: 0;
  z-index: 1000;
  transition: background 0.3s, box-shadow 0.3s;
}

.navbar-brand {
  display: flex;
  align-items: center;
  gap: 18px;
  font-size: 2.1rem;
  font-weight: bold;
  color: #fff;
  letter-spacing: 1px;
  border-radius: 8px;
  padding: 8px 12px 8px 0;
  /* Remove background and box-shadow for seamless look */
  background: none;
  box-shadow: none;
  min-width: 0;
}

.navbar-brand img {
  height: 64px;
  width: 64px;
  object-fit: contain;
  margin-right: 0;
  border-radius: 12px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.10);
  /* Remove background and padding */
  background: none;
  padding: 0;
}

.navbar-brand .brand-text {
  display: flex;
  flex-direction: column;
  justify-content: center;
  line-height: 1.1;
}

.navbar-brand .brand-title {
  font-size: 2.5rem;
  font-weight: 800;
  letter-spacing: 1px;
}

.navbar-brand .brand-subtitle {
  font-size: 1.05rem;
  font-weight: 400;
  margin-top: 4px;
  letter-spacing: 2px;
  color: #fff;
  opacity: 0.85;
}

.navbar-center {
  flex: 1;
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 10px;
}

.navbar-center .nav-link {
  font-size: 1.22rem;
  font-weight: 600;
  text-decoration: none;
  color: #fff;
  padding: 0 28px;
  height: 56px;
  display: flex;
  align-items: center;
  gap: 8px;
  border-radius: 24px;
  border: 2px solid transparent;
  background: none;
  transition: background 0.2s, color 0.2s, border 0.2s, box-shadow 0.2s;
  position: relative;
  margin: 0;
}

.navbar-center .nav-link.active {
  color: #ffc43b;
  background: rgba(255,196,59,0.10);
  border-bottom: 3px solid #ffc43b;
  border-radius: 24px 24px 0 0;
  box-shadow: 0 2px 8px rgba(255,196,59,0.08);
}

.navbar-center .nav-link:hover {
  background: rgba(255,255,255,0.13);
  color: #ffc43b;
  border-bottom: 3px solid #ffc43b;
}

.navbar-center .nav-link i {
  font-size: 1.1em;
  margin-right: 6px;
}

.navbar-right {
  display: flex;
  align-items: center;
  gap: 10px;
}

.navbar-right .nav-link, .navbar-right .btn {
  border: none;
  background: linear-gradient(90deg, #ffc43b 60%, #ffde7a 100%);
  color: #222 !important;
  border-radius: 10px;
  padding: 8px 20px;
  font-weight: 600;
  font-size: 1rem;
  box-shadow: 0 2px 8px rgba(255,196,59,0.10);
  margin-left: 8px;
  text-align: center;
  min-width: 90px;
  display: inline-block;
  transition: background 0.2s, color 0.2s, box-shadow 0.2s;
}

.navbar-right .nav-link:hover, .navbar-right .btn:hover {
  background: linear-gradient(90deg, #ffde7a 60%, #ffc43b 100%);
  color: #13161a !important;
  box-shadow: 0 4px 16px rgba(255,196,59,0.18);
}

body {
  padding-top: 0;
}

.navbar a, .navbar button {
  color: #fff; /* White text */
  font-weight: bold;
  margin: 0 20px;
  text-decoration: none;
  font-size: 18px;
  letter-spacing: 2px;
}

.navbar .active {
  color: #ffc43b; /* Gold for active link */
  border-bottom: 2px solid #ffc43b;
}

.navbar .offer-btn {
  background: #ffc43b;
  color: #222;
  border: none;
  padding: 16px 32px;
  border-radius: 2px;
  font-weight: bold;
  display: flex;
  align-items: center;
  gap: 10px;
}
.navbar-brand img { height: 48px; margin-right: 10px; }
.navbar-nav .nav-link { font-weight: 600; letter-spacing: 0.5px; margin: 0 8px; }
.hero {
  background: url('images/homepage.jpg') center/cover no-repeat;
  min-height: 480px;
  height: 80vh;
  color: #fff;
  position: relative;
  display: flex; align-items: center;
}
.hero-overlay {
  position: absolute; top: 0; left: 0; right: 0; bottom: 0;
  background: rgba(0,0,0,0.62);
}
.hero-content {
  position: relative; z-index: 2; width: 100%; text-align: center;
}
.hero-content h1 {
  font-size: 2.8rem; font-weight: 700; letter-spacing: 1px;
  text-shadow: 0 4px 18px rgba(0,0,0,0.45), 0 1px 0 #222;
}
.hero-content p {
  font-size: 1.2rem; margin-bottom: 24px;
  text-shadow: 0 2px 8px rgba(0,0,0,0.35);
}
.hero-content .btn {
  font-size: 1.3rem;
  padding: 18px 44px;
  font-weight: 700;
  border-radius: 32px;
  box-shadow: 0 6px 24px rgba(255,196,59,0.18), 0 2px 8px rgba(0,0,0,0.10);
  letter-spacing: 1px;
  transition: box-shadow 0.2s, background 0.2s;
}
.hero-content .btn:hover {
  box-shadow: 0 8px 32px rgba(255,196,59,0.28), 0 4px 16px rgba(0,0,0,0.13);
}
.info-bar {
  background: #222;
  color: #fff;
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 1.05rem;
  padding: 10px 0;
  gap: 40px;
  flex-wrap: wrap;
}
.info-bar span {
  display: flex;
  align-items: center;
  gap: 8px;
  margin: 4px 0;
}
.info-bar i {
  color: #e0b44c;
  margin-right: 7px;
  font-size: 1.15em;
}
.section-title {
  font-size: 2rem; font-weight: 700; color: #2c3e50; margin-bottom: 1.5rem; letter-spacing: 1px;
  text-align: center; position: relative;
}
.section-title:after {
  content: ""; display: block; width: 60px; height: 3px; background: #e0b44c; margin: 12px auto 0 auto; border-radius: 2px;
}
.gallery-img {
  width: 100%;
  height: 380px;
  max-height: 400px;
  object-fit: cover;
  border-radius: 22px;
  margin-bottom: 18px;
  box-shadow: 0 8px 32px rgba(0,0,0,0.13);
}
@media (max-width: 991px) {
  .gallery-img {
    height: 200px;
    max-height: 240px;
    border-radius: 12px;
  }
}
/* Step 6: Room card hover effect */
/* News card accent */
.news-card .card {
  border-left: 6px solid #ffc43b;
  border-radius: 12px;
  box-shadow: 0 4px 18px rgba(255,196,59,0.10);
  margin-bottom: 18px;
}
.news-card .card-body strong {
  color: #ffc43b;
  font-size: 1.08rem;
}
/* Room card pronounced hover */
.room-card {
  background: #fff;
  border-radius: 14px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.07);
  margin-bottom: 30px;
  overflow: hidden;
  transition: box-shadow 0.25s, transform 0.22s, border 0.22s;
  height: 100%;
  display: flex;
  flex-direction: column;
  border: 2px solid transparent;
}
.room-card:hover {
  box-shadow: 0 12px 36px rgba(255,196,59,0.18), 0 8px 32px rgba(0,0,0,0.18);
  transform: translateY(-10px) scale(1.04);
  border: 2px solid #ffc43b;
}
.room-card img { width: 100%; height: 180px; object-fit: cover; }
.room-card-body { padding: 20px; flex: 1 1 auto; display: flex; flex-direction: column; }
.room-card-title { font-size: 1.1rem; font-weight: 600; }
.room-card-desc { font-size: 0.97rem; color: #555; margin-bottom: 10px; }
.room-icons { color: #e0b44c; font-size: 1.1rem; margin-bottom: 8px; }
.room-card-price { color: #007bff; font-weight: 600; }
.room-card .btn {
  background: #ffc43b;
  color: #fff;
  border: none;
  font-weight: 600;
  border-radius: 8px;
  box-shadow: 0 2px 8px rgba(255,196,59,0.10);
  transition: background 0.2s, color 0.2s, box-shadow 0.2s;
}
.room-card .btn:hover {
  background: #cfa32e;
  color: #fff;
  box-shadow: 0 4px 16px rgba(255,196,59,0.18);
}
.contact-cards {
  display: flex; justify-content: center; gap: 30px; margin: 40px 0 30px 0;
  flex-wrap: wrap;
}
.contact-card {
  background: #fff; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.07);
  padding: 30px 24px; text-align: center; flex: 1 1 220px; min-width: 220px; max-width: 320px;
}
/* Contact info links */
.contact-card a {
  color: #007bff;
  font-weight: 600;
  text-decoration: none;
  transition: color 0.2s;
}
.contact-card a:hover {
  color: #ffc43b;
  text-decoration: underline;
}
.contact-card i {
  font-size: 2.2rem;
  color: #e0b44c;
  margin-bottom: 10px;
  margin-right: 6px;
}
/* Newsletter section styling */
.newsletter {
  background: #fffbe6;
  border: 2px solid #ffc43b;
  border-radius: 16px;
  box-shadow: 0 4px 18px rgba(255,196,59,0.10);
  padding: 40px 0 30px 0;
  text-align: center;
  margin-bottom: 32px;
}
.newsletter input[type=email] {
  max-width: 320px;
  display: inline-block;
  margin-right: 10px;
  border-radius: 8px;
  border: 1.5px solid #ffc43b;
}
.newsletter .btn {
  border-radius: 8px;
  font-weight: 700;
  box-shadow: 0 2px 8px rgba(255,196,59,0.10);
}
/* Footer styling */
footer {
  background: #22223b;
  color: #fff;
  padding: 40px 0 18px 0;
  margin-top: 40px;
  font-size: 1.05rem;
  border-radius: 0 0 18px 18px;
}
footer a {
  color: #ffc43b;
  text-decoration: underline;
  font-weight: 500;
}
footer .footer-logo {
  font-size: 1.3rem;
  font-weight: 700;
  letter-spacing: 1px;
  color: #ffc43b;
}
footer h6 {
  color: #ffc43b;
}
footer .fa-brands, footer .fa {
  color: #ffc43b;
  margin-right: 6px;
}
footer ul {
  margin-bottom: 12px;
}
/* Step 5: News card scroll for mobile */
@media (max-width: 991px) {
  .news-cards-row {
    flex-wrap: nowrap;
    overflow-x: auto;
    gap: 16px;
  }
  .news-card {
    min-width: 320px;
    flex: 0 0 auto;
  }
}
@media (max-width: 991px) {
  .contact-cards { flex-direction: column; align-items: center; }
  .info-bar {
    flex-direction: column;
    gap: 10px;
    padding: 12px 0;
  }
  .info-bar span {
    justify-content: flex-start;
    width: 100%;
    font-size: 1.08rem;
  }
}
@media (max-width: 767px) {
  .hero-content h1 { font-size: 2rem; }
  .section-title { font-size: 1.3rem; }
}
.top-bar, .navbar, .top-bar.elementor-sticky--effects, .navbar.elementor-sticky--effects {
  background: #13161a !important;
  position: static !important;
}

@media (max-width: 991px) {
  .navbar, .top-bar {
    padding: 0 8px;
  }
  .navbar-center {
    gap: 4px;
  }
  .navbar-center .nav-link {
    padding: 8px 8px;
  }
}

.topbar-btn {
  border: 2px solid #fff;
  background: #fff;
  color: #13161a !important;
  border-radius: 8px;
  padding: 8px 18px;
  font-weight: 600;
  font-size: 1rem;
  transition: background 0.2s, color 0.2s;
  margin-left: 8px;
  text-align: center;
  min-width: 90px;
  display: inline-block;
}
.topbar-btn:hover {
  background: #e6e6e6;
  color: #13161a !important;
}

.navbar-right .btn, .navbar-right .nav-link {
  border: 2px solid #fff;
  background: #fff;
  color: #13161a !important;
  border-radius: 8px;
  padding: 8px 18px;
  font-weight: 600;
  font-size: 1rem;
  transition: background 0.2s, color 0.2s;
  margin-left: 8px;
  text-align: center;
  min-width: 90px;
  display: inline-block;
}
.navbar-right .btn:hover, .navbar-right .nav-link:hover {
  background: #e6e6e6;
  color: #13161a !important;
}
/* Align news, gallery, about us columns and stretch to same height */
.row.g-4 {
  display: flex;
  align-items: stretch;
  margin-bottom: 0;
  height: 420px;
  gap: 32px;
  margin-left: 12px;
  margin-right: 12px;
}
.row.g-4 > [class^='col-lg-4'] {
  display: flex;
  flex-direction: column;
  justify-content: flex-start;
  height: 100%;
}
.news-card {
  flex: 1 1 0;
  display: flex;
  flex-direction: column;
  justify-content: stretch;
}
.news-card .card {
  min-height: 160px;
  flex: 1 1 0;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}
.col-lg-4#gallery {
  justify-content: flex-start;
}
.col-lg-4.news-card {
  justify-content: center;
}
.col-lg-4 > p {
  margin-top: auto;
  margin-bottom: auto;
}
.room-card .fa-map-marker-alt {
  color: #179c3c;
}
.booking-bar input[type="date"]::-webkit-input-placeholder { color: #bbb; }
.booking-bar input[type="date"]::-moz-placeholder { color: #bbb; }
.booking-bar input[type="date"]:-ms-input-placeholder { color: #bbb; }
.booking-bar input[type="date"]::placeholder { color: #bbb; }
.booking-bar input[type="date"]:focus, .booking-bar select:focus {
  outline: none;
  box-shadow: none;
  background: #f8f8f8;
}
@media (max-width: 991px) {
  .booking-bar {
    flex-direction: column;
    gap: 10px;
    min-width: 0;
    max-width: 100%;
    width: 100%;
  }
}
@media (max-width: 991px) {
  .d-flex.flex-row.gap-4.mt-4 {
    flex-direction: column;
    gap: 10px;
    max-width: 100%;
  }
}
.col-lg-4#gallery, .col-lg-4.about-us, .col-lg-4.news-card {
  min-height: 400px;
  padding-top: 18px;
  padding-bottom: 18px;
  display: flex;
  flex-direction: column;
  justify-content: center;
  height: 100%;
}
.col-lg-4.about-us > p {
  margin-top: auto;
  margin-bottom: auto;
}
.col-lg-4.news-card > div {
  margin-top: auto;
  margin-bottom: auto;
}
@media (max-width: 991px) {
  .row.g-4 {
    flex-direction: column;
    gap: 18px;
    height: auto;
    margin-left: 0;
    margin-right: 0;
  }
  .col-lg-4#gallery, .col-lg-4.about-us, .col-lg-4.news-card {
    min-height: 220px;
    padding-top: 8px;
    padding-bottom: 8px;
  }
}
.section-title, .col-lg-4#gallery h5, .col-lg-4.about-us h5, .col-lg-4.news-card h5 {
  font-family: inherit;
  font-size: 2rem !important;
  font-weight: 800;
  letter-spacing: 1.5px;
  text-transform: uppercase;
  color: #2c3e50;
  margin-bottom: 1.2rem;
  text-align: center;
}
@media (max-width: 991px) {
  .col-lg-4#gallery, .col-lg-4.about-us, .col-lg-4.news-card {
    min-height: 220px;
  }
  .col-lg-4#gallery h5, .col-lg-4.about-us h5, .col-lg-4.news-card h5 {
    font-size: 1.3rem !important;
  }
}
.col-lg-4.about-us, .col-lg-4.news-card {
  background: none;
  border-radius: 0;
  box-shadow: none;
  padding: 0;
  margin-bottom: 0;
}
.top-section-divider {
  display: none;
}
.news-card .card {
  transition: box-shadow 0.18s, transform 0.18s;
}
.news-card .card:hover {
  box-shadow: 0 8px 32px rgba(255,196,59,0.13), 0 2px 8px rgba(0,0,0,0.10);
  transform: translateY(-2px) scale(1.01);
}
.col-lg-4.news-card {
  display: flex;
  flex-direction: column;
  justify-content: flex-start;
  height: 100%;
}
@media (max-width: 991px) {
  .col-lg-4.news-card {
    padding-top: 8px;
  }
}
.col-lg-4#gallery h5, .col-lg-4.about-us h5, .col-lg-4.news-card h5 {
  margin-top: 0 !important;
}
.news-card-list { margin-top: 18px; }
.news-card-custom { border-radius: 18px; transition: box-shadow 0.18s; }
.news-card-custom:hover { box-shadow: 0 8px 32px rgba(255,196,59,0.13), 0 4px 18px rgba(0,0,0,0.13); }
@media (max-width: 600px) {
  .news-card-list .d-flex { flex-direction: column !important; align-items: flex-start !important; }
  .news-card-list img { margin-bottom: 10px; }
}
</style>
</head>
<body>
<?php include 'navbar.php'; ?>
<!-- HERO SECTION -->
<section class="hero position-relative container-fluid px-0">
  <div class="hero-overlay"></div>
  <div class="container hero-content">
    <h1 class="fw-bold mb-3">WELCOME TO ALACRITY AUBERGE</h1>
    <p class="mb-4">This newly refurbished, modern style residence, offers an excellent standard of accommodation in a quiet and fashionable environment.</p>
    <a href="#explore-rooms" class="btn btn-warning btn-lg">EXPLORE ROOMS</a>
  </div>
</section>
<!-- INFO BAR -->
<div class="info-bar container-fluid">
  <span><i class="fa fa-clock"></i> Check In: 14:00</span>
  <span><i class="fa fa-clock"></i> Check Out: 12:00</span>
  <span><i class="fa fa-paw"></i> Pets are not allowed</span>
  <span><i class="fa fa-credit-card"></i> Credit Cards</span>
</div>
<!-- GALLERY / ABOUT US / HOTEL NEWS -->
<div class="container-fluid my-5 px-4">
  <div class="row g-4 h-100 align-items-stretch">
    <div class="col-lg-4 d-flex flex-column h-100" id="gallery">
      <h5 class="mb-3" style="font-weight:700;">GALLERY</h5>
      <div id="galleryCarousel" class="carousel slide mb-2" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#galleryCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Standard Room"></button>
          <button type="button" data-bs-target="#galleryCarousel" data-bs-slide-to="1" aria-label="Deluxe Room"></button>
          <button type="button" data-bs-target="#galleryCarousel" data-bs-slide-to="2" aria-label="Grand Deluxe Room"></button>
          <?php
            $gallery_rooms = mysqli_query($conn, "SELECT * FROM rooms WHERE status='available'");
            $slide_index = 3;
            while ($room = mysqli_fetch_assoc($gallery_rooms)) {
              $room_img = '';
              if (!empty($room['image_path']) && file_exists('uploads/' . $room['image_path'])) {
                $room_img = 'uploads/' . htmlspecialchars($room['image_path']);
              } else {
                if (stripos($room['name'], 'Standard') !== false) {
                  $room_img = 'images/standard.jpg';
                } elseif (stripos($room['name'], 'Deluxe') !== false && stripos($room['name'], 'Grand') === false) {
                  $room_img = 'images/deluxe.jpg';
                } elseif (stripos($room['name'], 'Grand Deluxe') !== false) {
                  $room_img = 'images/grand deluxe.jpg';
                } elseif (stripos($room['name'], 'Penthouse') !== false) {
                  $room_img = 'images/penthouse.jpg';
                } elseif (stripos($room['name'], 'Superior Twin') !== false) {
                  $room_img = 'images/superior twin.jpg';
                } elseif (stripos($room['name'], 'Family') !== false) {
                  $room_img = 'images/family.jpg';
                } else {
                  $room_img = 'images/default.jpg';
                }
              }
              echo '<button type="button" data-bs-target="#galleryCarousel" data-bs-slide-to="' . $slide_index . '" aria-label="' . htmlspecialchars($room['name']) . '"></button>';
              $slide_index++;
            }
          ?>
        </div>
        <div class="carousel-inner rounded-4 shadow-lg">
          <div class="carousel-item active position-relative">
            <img src="images/standard.jpg" class="gallery-img d-block w-100" alt="Standard Room">
          </div>
          <div class="carousel-item position-relative">
            <img src="images/deluxe.jpg" class="gallery-img d-block w-100" alt="Deluxe Room">
          </div>
          <div class="carousel-item position-relative">
            <img src="images/grand deluxe.jpg" class="gallery-img d-block w-100" alt="Grand Deluxe Room">
          </div>
          <?php
            $gallery_rooms = mysqli_query($conn, "SELECT * FROM rooms WHERE status='available'");
            while ($room = mysqli_fetch_assoc($gallery_rooms)) {
              $room_img = '';
              if (!empty($room['image_path']) && file_exists('uploads/' . $room['image_path'])) {
                $room_img = 'uploads/' . htmlspecialchars($room['image_path']);
              } else {
                if (stripos($room['name'], 'Standard') !== false) {
                  $room_img = 'images/standard.jpg';
                } elseif (stripos($room['name'], 'Deluxe') !== false && stripos($room['name'], 'Grand') === false) {
                  $room_img = 'images/deluxe.jpg';
                } elseif (stripos($room['name'], 'Grand Deluxe') !== false) {
                  $room_img = 'images/grand deluxe.jpg';
                } elseif (stripos($room['name'], 'Penthouse') !== false) {
                  $room_img = 'images/penthouse.jpg';
                } elseif (stripos($room['name'], 'Superior Twin') !== false) {
                  $room_img = 'images/superior twin.jpg';
                } elseif (stripos($room['name'], 'Family') !== false) {
                  $room_img = 'images/family.jpg';
                } else {
                  $room_img = 'images/default.jpg';
                }
              }
              echo '<div class="carousel-item position-relative"><img src="' . $room_img . '" class="gallery-img d-block w-100" alt="' . htmlspecialchars($room['name']) . '"></div>';
            }
          ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#galleryCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#galleryCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
    <div class="col-lg-4 d-flex flex-column h-100 about-us">
      <h5 class="mb-3" style="font-weight:700;">ABOUT US</h5>
      <p style="font-size:1.05rem;">
        This newly refurbished, modern style hotel offers an excellent standard of accommodation in a quiet and fashionable environment. In addition to the trendy look of the space, great importance has been given to the quality of sleep and comfort, by investing in the highest standard of mattress, finest bed linen and pillows.<br><br>
        Our guests enjoy personalized service, a warm and welcoming atmosphere, and a range of amenities designed for both business and leisure travelers. Whether you are here for a relaxing getaway or a productive business trip, Alacrity Auberge provides the perfect blend of comfort, style, and convenience. Enjoy our on-site restaurant, 24-hour reception, complimentary Wi-Fi, and easy access to the city’s top attractions. Discover the difference at Alacrity Auberge—where every stay feels like coming home.
      </p>
    </div>
    <div class="col-lg-4 news-card d-flex flex-column h-100">
      <h5 class="mb-3" style="font-weight:700;text-align:center;font-size:2.1rem;letter-spacing:1px;">HOTEL NEWS</h5>
      <div class="news-card-list">
        <div class="card mb-4 bg-white border-0 shadow-sm flex-fill p-3 news-card-custom">
          <div class="d-flex align-items-start gap-3">
            <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=120&q=80" style="width:72px;height:72px;object-fit:cover;border-radius:12px;box-shadow:0 2px 8px rgba(0,0,0,0.10);border:2px solid #ffc43b;" alt="News">
            <div class="flex-grow-1">
              <div class="d-flex align-items-center mb-1">
                <span class="fw-bold" style="color:#ffc43b;font-size:1.18rem;">Facebook Contest: Like to Win</span>
                <span class="badge bg-success ms-2">NEW</span>
              </div>
              <div style="color:#444;font-size:1.01rem;">Dear Guests, We have some great news for you! You may win a free stay at Amorgos Boutique Hotel! All you have to do is: Like our Facebook Page & Share the photo of th [...]</div>
              <a href="#" class="text-decoration-none mt-2 d-inline-block" style="color:#007bff;font-weight:500;">Read More <i class="fa fa-arrow-right"></i></a>
            </div>
          </div>
        </div>
        <div class="card mb-4 bg-white border-0 shadow-sm flex-fill p-3 news-card-custom">
          <div class="d-flex align-items-start gap-3">
            <img src="https://images.unsplash.com/photo-1507089947368-19c1da9775ae?auto=format&fit=crop&w=120&q=80" style="width:72px;height:72px;object-fit:cover;border-radius:12px;box-shadow:0 2px 8px rgba(0,0,0,0.10);border:2px solid #ffc43b;" alt="News">
            <div class="flex-grow-1">
              <div class="d-flex align-items-center mb-1">
                <span class="fw-bold" style="color:#ffc43b;font-size:1.18rem;">Special Offer Available</span>
                <span class="badge bg-secondary ms-2">Apr 2024</span>
              </div>
              <div style="color:#444;font-size:1.01rem;">Where luxury meets convenience and affordable prices, that’s Amorgos Boutique Hotel. Take the benefits of our special offer for even lower rates! Book Now and S [...]</div>
              <a href="#" class="text-decoration-none mt-2 d-inline-block" style="color:#007bff;font-weight:500;">Read More <i class="fa fa-arrow-right"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Subtle divider below top section -->
<!-- (deleted) -->
<!-- Decorative divider and blurb before Explore Rooms -->
<div class="container-fluid d-flex flex-column align-items-center" style="max-width:900px; margin-top: 32px; margin-bottom: 0;">
  <div style="background: linear-gradient(90deg, #fffbe6 60%, #fff 100%); border-radius: 18px; box-shadow: 0 4px 24px rgba(255,196,59,0.08); padding: 28px 18px 18px 18px; width:100%; display:flex; flex-direction:column; align-items:center;">
    <hr style="width:80px; border:2px solid #ffc43b; border-radius:2px; margin-bottom:12px; margin-top:0;">
    <div class="mb-2" style="font-size:1.18rem; color:#444; font-weight:500; letter-spacing:0.5px;">
      <i class="fa fa-star text-warning me-2"></i>Why Choose Alacrity Auberge?
    </div>
    <div style="color:#666; max-width:700px; text-align:center; font-size:1.01rem;">
      Experience unmatched hospitality, modern amenities, and a prime location. Our dedicated staff, elegant rooms, and attention to detail ensure your stay is both comfortable and memorable. Book with us for a truly exceptional visit!
    </div>
  </div>
</div>
<!-- EXPLORE ROOMS SECTION (DYNAMIC) -->
<section class="container-fluid my-5 px-4" id="explore-rooms">
  <h2 class="section-title">EXPLORE ROOMS</h2>
  <div class="row justify-content-center">
    <?php
    // Only show Standard, Deluxe, and Grand Deluxe rooms
    $highlight_rooms = [
      'Standard Room',
      'Deluxe Room',
      'Grand Deluxe Room'
    ];
    $result = mysqli_query($conn, "SELECT * FROM rooms WHERE status='available' AND name IN ('Standard Room', 'Deluxe Room', 'Grand Deluxe Room')");
    if ($result && mysqli_num_rows($result) > 0):
      while($room = mysqli_fetch_assoc($result)):
        // Assign image and max persons based on room name
        $room_img = 'uploads/' . (isset($room['image_path']) ? htmlspecialchars($room['image_path']) : 'default.jpg');
        $max_persons = '';
        $badge = '';
        if (stripos($room['name'], 'Standard') !== false) {
          $room_img = 'images/standard.jpg';
          $max_persons = '2-4';
          $badge = '<span class="badge bg-primary rounded-pill px-3 py-2"><i class="fa fa-users me-1"></i>2-4 Guests</span>';
        } elseif (stripos($room['name'], 'Deluxe') !== false && stripos($room['name'], 'Grand') === false) {
          $room_img = 'images/deluxe.jpg';
          $max_persons = '3-5';
          $badge = '<span class="badge bg-success rounded-pill px-3 py-2"><i class="fa fa-users me-1"></i>3-5 Guests</span>';
        } elseif (stripos($room['name'], 'Grand Deluxe') !== false) {
          $room_img = 'images/grand deluxe.jpg';
          $max_persons = '4-6';
          $badge = '<span class="badge bg-warning text-dark rounded-pill px-3 py-2"><i class="fa fa-users me-1"></i>4-6 Guests</span>';
        }
        // Generate random rating and reviews
        $rating = number_format(rand(89, 97) / 10, 1);
        $reviews = number_format(rand(2000, 20000));
    ?>
    <div class="col-md-4 col-lg-3 mb-4 d-flex">
      <div class="room-card w-100">
        <img src="<?php echo $room_img; ?>" alt="Room image" class="room-img-top" style="height:200px;object-fit:cover;border-radius:14px 14px 0 0;">
        <div class="room-card-body d-flex flex-column justify-content-between" style="background:#fcfcfc;">
          <div>
            <div class="room-card-title mb-1 fw-bold" style="font-size:1.15rem;"><?php echo htmlspecialchars($room['name']); ?></div>
            <div class="d-flex align-items-center gap-2 mb-2">
              <?php echo $badge; ?>
              <span style="background:#179c3c;color:#fff;font-weight:700;border-radius:8px;padding:2px 12px 2px 10px;font-size:1.08rem;display:inline-block;min-width:44px;text-align:center;"> <?php echo $rating; ?> </span>
              <span style="font-weight:700;color:#222;font-size:1.05rem;">Excellent</span>
              <span style="color:#444;font-size:0.98rem;">(<?php echo $reviews; ?>)</span>
            </div>
            <div style="margin-top:2px;margin-bottom:2px;font-size:0.97rem;color:#888;display:flex;align-items:center;gap:4px;">
              <i class="fa fa-map-marker-alt text-secondary me-1"></i>Manila, Philippines
            </div>
            <div class="room-card-desc mt-2 mb-2" style="font-size:0.97rem; color:#555; min-height:70px;">
              <?php echo htmlspecialchars($room['description']); ?>
            </div>
          </div>
          <div>
            <div class="room-card-price mb-2" style="color:#007bff; font-weight:600; font-size:1.08rem;">₱<?php echo $room['price']; ?> / night</div>
            <a href="rooms.php" class="btn btn-warning btn-sm w-100 mt-1">SEE ROOM</a>
          </div>
        </div>
      </div>
    </div>
    <?php endwhile; else: ?>
    <div class="col-12 text-center"><p>No available rooms right now.</p></div>
    <?php endif; ?>
  </div>
</section>
<!-- CONTACT CARDS -->
<div class="container-fluid contact-cards px-4">
  <div class="contact-card">
    <i class="fa fa-phone"></i>
    <h6 class="fw-bold mt-2">CALL US</h6>
    <p style="font-size:0.98rem;">Our receptionists are available to speak with you anytime of the day.</p>
    <div class="mt-2"><a href="tel:+35724621900" class="text-decoration-none text-dark">(+)&nbsp;357 24 621900</a></div>
  </div>
  <div class="contact-card">
    <i class="fa fa-envelope"></i>
    <h6 class="fw-bold mt-2">SEND US E-MAIL</h6>
    <p style="font-size:0.98rem;">You can contact us anytime via email for any question or inquiry.</p>
    <div class="mt-2"><a href="mailto:info@amorgoshotel.com" class="text-decoration-none text-dark">info@amorgoshotel.com</a></div>
  </div>
  <div class="contact-card">
    <i class="fa fa-home"></i>
    <h6 class="fw-bold mt-2">VISIT US</h6>
    <p style="font-size:0.98rem;">We are located in Larnaca, Cyprus, you can visit us and see our hotel.</p>
    <div class="mt-2">11, D. Mitsi Street, 6307 Larnaca, Cyprus</div>
  </div>
</div>
<!-- NEWSLETTER SIGNUP -->
<div class="newsletter">
  <h5 class="mb-3" style="font-weight:700;">Sign up newsletter</h5>
  <form class="d-flex justify-content-center align-items-center flex-wrap gap-2" id="newsletterForm">
    <input type="email" class="form-control" placeholder="Enter a e-mail address" style="max-width:320px;" required aria-label="Email address">
    <button class="btn btn-warning" type="submit" style="font-weight:600;">SUBSCRIBE</button>
  </form>
  <div id="newsletterSuccess" class="alert alert-success mt-3 d-none" role="alert">
    Thank you for subscribing!
  </div>
</div>
<script>
// Newsletter form feedback
const newsletterForm = document.getElementById('newsletterForm');
const newsletterSuccess = document.getElementById('newsletterSuccess');
if(newsletterForm) {
  newsletterForm.addEventListener('submit', function(e) {
    e.preventDefault();
    newsletterSuccess.classList.remove('d-none');
    newsletterForm.reset();
    setTimeout(() => newsletterSuccess.classList.add('d-none'), 4000);
  });
}
</script>
<!-- FOOTER -->
<footer aria-label="Site Footer">
  <div class="container-fluid px-4">
    <div class="row">
      <div class="col-md-3 mb-3">
        <div class="footer-logo mb-2">ALACRITY<br><span style="font-size:0.9rem;font-weight:400;">AUBERGE</span></div>
      </div>
      <div class="col-md-3 mb-3">
        <h6 class="fw-bold">ABOUT CYPRUS</h6>
        <ul class="list-unstyled">
          <li><a href="#">About Cyprus</a></li>
          <li><a href="#">Cyprus Attractions</a></li>
          <li><a href="#">Weather in Cyprus</a></li>
        </ul>
      </div>
      <div class="col-md-3 mb-3">
        <h6 class="fw-bold">ABOUT AMORGOS</h6>
        <ul class="list-unstyled">
          <li><a href="#">Hotel News</a></li>
          <li><a href="#">Hotel Policies</a></li>
          <li><a href="#">Downloads</a></li>
          <li><a href="#">Meeting Room</a></li>
        </ul>
      </div>
      <div class="col-md-3 mb-3">
        <h6 class="fw-bold">HOTEL ROOMS</h6>
        <ul class="list-unstyled">
          <li>Standard Room</li>
          <li>Superior Room</li>
          <li>Grand Superior Room</li>
        </ul>
        <h6 class="fw-bold mt-3">CONTACT DETAILS</h6>
        <ul class="list-unstyled">
          <li><i class="fa fa-location-dot"></i> 11, D. Mitsi Street, 6307 Larnaca, Cyprus</li>
          <li><i class="fa fa-phone"></i> <a href="tel:+35724621900" class="text-decoration-none text-dark">(+) 357 24 621900</a></li>
          <li><i class="fa fa-phone"></i> <a href="tel:+35724626397" class="text-decoration-none text-dark">(+) 357 24 626397</a></li>
          <li><i class="fa fa-envelope"></i> <a href="mailto:info@amorgoshotel.com" class="text-decoration-none text-dark">info@amorgoshotel.com</a></li>
        </ul>
        <div class="mt-2">
          <a href="#" aria-label="TripAdvisor" class="me-2"><i class="fa-brands fa-tripadvisor fa-lg"></i></a>
          <a href="#" aria-label="Facebook" class="me-2"><i class="fa-brands fa-facebook fa-lg"></i></a>
          <a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram fa-lg"></i></a>
        </div>
      </div>
    </div>
    <div class="text-center mt-3">
      <small>All Rights Reserved © 2024 AlacrityAuberge.com &nbsp; | &nbsp; CONNECT WITH US <i class="fa-brands fa-tripadvisor"></i></small>
    </div>
  </div>
  <!-- TODO: Move inline CSS to a separate file for better maintainability. -->
</footer>
<!-- Add Bootstrap Modal for Gallery Lightbox -->
<div class="modal fade" id="galleryModal" tabindex="-1" aria-labelledby="galleryModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content bg-dark border-0">
      <div class="modal-body p-0 position-relative">
        <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
        <img src="https://images.unsplash.com/photo-1464983953574-0892a716854b?auto=format&fit=crop&w=1200&q=80" class="w-100" alt="Gallery Large" style="border-radius:10px;">
      </div>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
