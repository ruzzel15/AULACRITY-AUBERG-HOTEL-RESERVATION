<?php
session_start();
include 'config.php';

// ✅ Only allow logged-in users (any role)
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// ✅ Fetch available rooms
$sql = "SELECT * FROM rooms WHERE status='available'";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Available Rooms</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="navbar.css">
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(135deg, #f8f8f8 60%, #e9e4f0 100%) fixed;
            margin: 0;
            padding: 0;
        }
        .rooms-header {
            max-width: 1100px;
            margin: 0 auto 32px auto;
            padding: 32px 0 0 0;
            text-align: center;
        }
        .rooms-header h2 {
            font-size: 2.7rem;
            font-weight: 900;
            letter-spacing: 2px;
            color: #2c3e50;
            margin-bottom: 10px;
        }
        .rooms-header p {
            color: #555;
            font-size: 1.18rem;
            margin-bottom: 0;
        }
        .rooms-container {
            max-width: 1400px;
            width: 100%;
            margin: 0 auto;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .rooms-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 48px 36px;
            margin: 0 auto;
            max-width: calc(3 * 420px + 2 * 36px);
        }
        .room-card {
            width: 100%;
            min-width: 0;
            max-width: 420px;
        }
        .room-card {
            background: #fff;
            border-radius: 28px;
            box-shadow: 0 12px 48px rgba(0,0,0,0.13);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: box-shadow 0.22s, transform 0.18s, border 0.18s;
            border: 2.5px solid #f3e7c3;
            position: relative;
        }
        .room-card:hover {
            box-shadow: 0 24px 64px rgba(0,0,0,0.16);
            transform: translateY(-8px) scale(1.025);
            border: 2.5px solid #ffc43b;
        }
        .room-img {
            width: 100%;
            height: 270px;
            object-fit: cover;
            border-radius: 28px 28px 0 0;
        }
        .room-card-body {
            padding: 34px 28px 26px 28px;
            flex: 1 1 auto;
            display: flex;
            flex-direction: column;
        }
        .room-card-title {
            font-size: 1.55rem;
            font-weight: 900;
            margin-bottom: 8px;
            color: #2c3e50;
        }
        .room-badges {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }
        .badge-guests {
            background: #ffc43b;
            color: #222;
            font-weight: 600;
            border-radius: 8px;
            padding: 4px 12px;
            font-size: 1.05rem;
        }
        .badge-rating {
            background: #179c3c;
            color: #fff;
            font-weight: 700;
            border-radius: 8px;
            padding: 4px 12px;
            font-size: 1.05rem;
        }
        .room-card-price {
            color: #007bff;
            font-weight: 800;
            font-size: 1.22rem;
            margin-bottom: 10px;
        }
        .room-highlights {
            display: flex;
            flex-wrap: nowrap;
            justify-content: flex-start;
            gap: 18px;
            margin-bottom: 10px;
            width: 100%;
        }
        .room-highlight {
            background: #f8f8f8;
            border-radius: 8px;
            padding: 6px 18px;
            font-size: 1.01rem;
            color: #444;
            display: flex;
            align-items: center;
            gap: 8px;
            min-width: 80px;
            flex: 0 1 auto;
        }
        .room-card .btn {
            border-radius: 8px;
            font-weight: 700;
            margin-right: 8px;
        }
        .room-card .btn-details {
            background: #f8f8f8;
            color: #222;
            border: 1.5px solid #ffc43b;
            border-radius: 8px;
            font-weight: 700;
            transition: background 0.2s, color 0.2s;
        }
        .room-card .btn-details:hover {
            background: #fffbe6;
            color: #222;
        }
        .room-card .btn-warning {
            font-size: 1.13rem;
            font-weight: 900;
            padding: 10px 28px;
            box-shadow: 0 2px 8px rgba(255,196,59,0.10);
        }
        .d-flex.flex-column.align-items-stretch.mb-2.gap-2 {
            gap: 12px !important;
        }
        .room-badge-featured {
            position: absolute;
            top: 18px;
            left: 18px;
            background: #ffc43b;
            color: #222;
            font-weight: 900;
            font-size: 1.01rem;
            border-radius: 8px;
            padding: 6px 18px;
            box-shadow: 0 2px 8px rgba(255,196,59,0.13);
            z-index: 2;
        }
        .room-badge-hot {
            position: absolute;
            top: 18px;
            right: 18px;
            background: #ff4d4f;
            color: #fff;
            font-weight: 900;
            font-size: 1.01rem;
            border-radius: 8px;
            padding: 6px 18px;
            box-shadow: 0 2px 8px rgba(255,77,79,0.13);
            z-index: 2;
        }
        .room-badge-popular {
            position: absolute;
            top: 240px;
            left: 24px;
            background: #007bff;
            color: #fff;
            font-weight: 900;
            font-size: 1.01rem;
            border-radius: 8px;
            padding: 6px 18px;
            box-shadow: 0 2px 8px rgba(0,123,255,0.13);
            z-index: 2;
        }
        .room-badge-staff {
            position: absolute;
            bottom: 18px;
            right: 18px;
            background: #22223b;
            color: #ffc43b;
            font-weight: 900;
            font-size: 1.01rem;
            border-radius: 8px;
            padding: 6px 18px;
            box-shadow: 0 2px 8px rgba(34,34,59,0.13);
            z-index: 2;
        }
        .why-book-section {
            max-width: 1200px;
            margin: 48px auto 0 auto;
            padding: 32px 40px 16px 40px;
            background: #fffbe6;
            border-radius: 18px;
            box-shadow: 0 2px 8px rgba(255,196,59,0.08);
        }
        .why-book-title {
            font-size: 1.35rem;
            font-weight: 800;
            color: #2c3e50;
            margin-bottom: 12px;
        }
        .why-book-list {
            display: flex;
            flex-wrap: wrap;
            gap: 24px;
            margin-bottom: 0;
        }
        .why-book-item {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            padding: 18px 22px;
            font-size: 1.08rem;
            color: #444;
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 220px;
        }
        .help-section {
            max-width: 1200px;
            margin: 32px auto 0 auto;
            padding: 24px 16px 0 16px;
            text-align: center;
        }
        .help-section .btn {
            font-size: 1.08rem;
            font-weight: 700;
            padding: 10px 28px;
            border-radius: 8px;
        }
        .footer-divider {
            width: 100%;
            border: none;
            border-top: 2px solid #f3e7c3;
            margin: 48px 0 0 0;
        }
        footer {
            background: #22223b;
            color: #fff;
            padding: 40px 0 18px 0;
            margin-top: 0;
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
        @media (max-width: 600px) {
            .room-img { height: 140px; }
            .room-card-body { padding: 12px 8px 10px 8px; }
            .why-book-list { flex-direction: column; gap: 12px; }
        }
        .back-to-top {
            position: fixed;
            bottom: 32px;
            right: 32px;
            background: #ffc43b;
            color: #222;
            border: none;
            border-radius: 50%;
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            box-shadow: 0 2px 8px rgba(255,196,59,0.18);
            cursor: pointer;
            z-index: 999;
            transition: background 0.2s, color 0.2s;
        }
        .back-to-top:hover {
            background: #e0b44c;
            color: #111;
        }
        .collapse-details {
          max-height: 0;
          overflow: hidden;
          transition: max-height 0.35s cubic-bezier(0.4,0,0.2,1), padding 0.2s;
          padding-top: 0;
          padding-bottom: 0;
        }
        .collapse-details.active {
          max-height: 400px;
          padding-top: 14px;
          padding-bottom: 8px;
        }
        .details-chevron {
          transition: transform 0.3s;
        }
        .btn-details.open .details-chevron {
          transform: rotate(180deg);
        }
    </style>
</head>
<body>
<?php include 'navbar.php'; ?>
<div class="rooms-header">
    <h2>Available Rooms</h2>
    <p>Choose from our selection of comfortable, modern rooms. Enjoy the best rates, flexible booking, and top-notch amenities for your stay.</p>
</div>
<!-- Rooms and Sidebar Layout (Bootstrap row/col for centering) -->
<div class="container rooms-container" style="margin-top: 32px;">
  <div class="row justify-content-center">
    <?php if (mysqli_num_rows($result) > 0): ?>
      <?php while ($room = mysqli_fetch_assoc($result)):
                $max_guests = isset($room['max_guests']) ? $room['max_guests'] : 2;
                $rating = number_format(rand(89, 97) / 10, 1);
                $reviews = number_format(rand(2000, 20000));
                $room_id = $room['id'];
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
                // Set badges and amenities (do not touch $room_img here)
                $badge_featured = $badge_hot = $badge_popular = $badge_staff = '';
                $amenities = [];
                if (stripos($room['name'], 'Standard') !== false) {
                    $badge_featured = '<span class="room-badge-featured">Featured Room</span>';
                    $amenities = [
                        ['icon' => 'fa-wifi', 'label' => 'WiFi'],
                        ['icon' => 'fa-tv', 'label' => 'TV']
                    ];
                } elseif (stripos($room['name'], 'Deluxe') !== false && stripos($room['name'], 'Grand') === false) {
                    $badge_hot = '<span class="room-badge-hot">Hot Deal</span>';
                    $amenities = [
                        ['icon' => 'fa-wifi', 'label' => 'WiFi'],
                        ['icon' => 'fa-tv', 'label' => 'TV'],
                        ['icon' => 'fa-bath', 'label' => 'Bath']
                    ];
                } elseif (stripos($room['name'], 'Grand Deluxe') !== false) {
                    $badge_popular = '<span class="room-badge-popular">Popular Choice</span>';
                    $amenities = [
                        ['icon' => 'fa-wifi', 'label' => 'WiFi'],
                        ['icon' => 'fa-tv', 'label' => 'TV'],
                        ['icon' => 'fa-bath', 'label' => 'Bath'],
                        ['icon' => 'fa-mug-hot', 'label' => 'Kettle'],
                        ['icon' => 'fa-utensils', 'label' => 'Breakfast']
                    ];
                } elseif (stripos($room['name'], 'Penthouse') !== false) {
                    $badge_staff = '<span class="room-badge-staff">Staff Pick</span>';
                    $amenities = [
                        ['icon' => 'fa-wifi', 'label' => 'WiFi'],
                        ['icon' => 'fa-tv', 'label' => 'TV'],
                        ['icon' => 'fa-bath', 'label' => 'Bath'],
                        ['icon' => 'fa-mug-hot', 'label' => 'Kettle'],
                        ['icon' => 'fa-utensils', 'label' => 'Breakfast'],
                        ['icon' => 'fa-spa', 'label' => 'Spa Access']
                    ];
                } elseif (stripos($room['name'], 'Superior Twin') !== false) {
                    $amenities = [
                        ['icon' => 'fa-wifi', 'label' => 'WiFi'],
                        ['icon' => 'fa-tv', 'label' => 'TV'],
                        ['icon' => 'fa-bath', 'label' => 'Bath']
                    ];
                } elseif (stripos($room['name'], 'Family') !== false) {
                    $amenities = [
                        ['icon' => 'fa-wifi', 'label' => 'WiFi'],
                        ['icon' => 'fa-tv', 'label' => 'TV'],
                        ['icon' => 'fa-bath', 'label' => 'Bath'],
                        ['icon' => 'fa-mug-hot', 'label' => 'Kettle']
                    ];
                } else {
                    $amenities = [
                        ['icon' => 'fa-wifi', 'label' => 'WiFi'],
                        ['icon' => 'fa-tv', 'label' => 'TV']
                    ];
                }
            ?>
        <div class="col-md-4 d-flex align-items-stretch mb-5">
          <div class="room-card w-100">
                <?php echo $badge_featured . $badge_hot . $badge_popular . $badge_staff; ?>
                <img src="<?php echo $room_img; ?>" alt="<?php echo htmlspecialchars($room['name']); ?>" class="room-img">
                <div class="room-card-body">
                    <div class="room-card-title"><?php echo htmlspecialchars($room['name']); ?></div>
                    <div class="room-badges mb-2">
                        <span class="badge-guests"><i class="fa fa-users me-1"></i> <?php echo $max_guests; ?> Guests</span>
                        <span class="badge-rating"><i class="fa fa-star me-1"></i> <?php echo $rating; ?> <span style="font-weight:400;">(<?php echo $reviews; ?>)</span></span>
                    </div>
                    <div class="room-highlights mb-2">
                        <?php foreach ($amenities as $am): ?>
                            <span class="room-highlight"><i class="fa <?php echo $am['icon']; ?>"></i> <?php echo $am['label']; ?></span>
                        <?php endforeach; ?>
                    </div>
                    <div class="room-card-price">₱<?php echo $room['price']; ?> / night</div>
                    <div class="d-flex flex-column align-items-stretch mb-2 gap-2">
                        <a href="room_details.php?id=<?php echo $room_id; ?>" class="btn btn-details btn-sm w-100">See Details <i class="fa fa-chevron-right"></i></a>
                        <form action="book_room.php" method="post" class="d-flex align-items-center gap-2 flex-wrap w-100">
                            <input type="hidden" name="room_id" value="<?php echo $room['id']; ?>">
                            <input type="date" name="check_in_date" class="form-control form-control-sm" required style="max-width:130px;">
                            <input type="date" name="check_out_date" class="form-control form-control-sm" required style="max-width:130px;">
                            <button type="submit" name="book" class="btn btn-warning btn-sm">Book Now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
        <p>No available rooms right now.</p>
    <?php endif; ?>
  </div>
</div>
<style>
@media (max-width: 991px) {
  .rooms-container .d-flex { flex-direction: column !important; }
  .rooms-grid { grid-template-columns: 1fr !important; }
  aside.d-lg-block { display: block !important; width: 100% !important; margin-left: 0 !important; margin-top: 32px; }
}
@media (max-width: 1200px) {
    .rooms-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 700px) {
    .rooms-grid { grid-template-columns: 1fr; }
}
</style>
<!-- How to Book Section (restored to below the grid) -->
<div class="container my-5">
    <h3 class="text-center mb-4" style="font-weight:800;color:#2c3e50;">How to Book</h3>
    <div class="row justify-content-center g-4">
        <div class="col-md-3 text-center">
            <i class="fa fa-search fa-2x mb-2 text-warning"></i>
            <div>1. Browse & Choose Your Room</div>
        </div>
        <div class="col-md-3 text-center">
            <i class="fa fa-calendar-check fa-2x mb-2 text-warning"></i>
            <div>2. Select Dates & Availability</div>
        </div>
        <div class="col-md-3 text-center">
            <i class="fa fa-credit-card fa-2x mb-2 text-warning"></i>
            <div>3. Book & Pay Securely</div>
        </div>
        <div class="col-md-3 text-center">
            <i class="fa fa-smile fa-2x mb-2 text-warning"></i>
            <div>4. Enjoy Your Stay!</div>
        </div>
    </div>
</div>
<!-- Why Book With Us Section -->
<div class="why-book-section mt-5">
    <div class="why-book-title">Why Book With Us?</div>
    <div class="why-book-list">
        <div class="why-book-item"><i class="fa fa-check-circle text-success"></i> Best Price Guarantee</div>
        <div class="why-book-item"><i class="fa fa-wifi"></i> Free High-Speed WiFi</div>
        <div class="why-book-item"><i class="fa fa-calendar-check"></i> Flexible Booking & Cancellation</div>
        <div class="why-book-item"><i class="fa fa-parking"></i> Free Parking</div>
        <div class="why-book-item"><i class="fa fa-shield-alt"></i> Secure Online Payment</div>
        <div class="why-book-item"><i class="fa fa-star"></i> Top Guest Reviews</div>
    </div>
</div>
<!-- Need Help Section -->
<div class="help-section">
    <h4>Need Help?</h4>
    <p>Contact our friendly staff for assistance with your booking or any questions about your stay.</p>
    <a href="mailto:info@sanandresresidences.com" class="btn btn-warning"><i class="fa fa-envelope"></i> Email Us</a>
    <a href="tel:+1234567890" class="btn btn-outline-secondary ms-2"><i class="fa fa-phone"></i> Call Reception</a>
</div>
<hr class="footer-divider">
<!-- Footer full width with .container-fluid -->
<footer style="width: 100%; margin: 0; padding: 40px 0 18px 0; background: #22223b; color: #fff;">
  <div class="container-fluid px-4">
    <div class="row">
      <div class="col-md-3 mb-3 mb-md-0">
        <div class="footer-logo mb-2">SAN ANDRES</div>
        <div>RESIDENCES</div>
      </div>
      <div class="col-md-3 mb-3 mb-md-0">
        <h6>QUICK LINKS</h6>
        <ul class="list-unstyled">
          <li><a href="index.php">Home</a></li>
          <li><a href="rooms.php">Rooms</a></li>
          <li><a href="contact.php">Contact</a></li>
          <li><a href="faqs.php">FAQs</a></li>
        </ul>
      </div>
      <div class="col-md-3 mb-3 mb-md-0">
        <h6>CONTACT</h6>
        <ul class="list-unstyled">
          <li><i class="fa fa-map-marker-alt"></i> 11, D. Mitsi Street, 6307 Larnaca, Cyprus</li>
          <li><i class="fa fa-phone"></i> (+) 357 24 621900</li>
          <li><i class="fa fa-envelope"></i> info@sanandresresidences.com</li>
        </ul>
      </div>
      <div class="col-md-3">
        <h6>FOLLOW US</h6>
        <a href="#" class="me-2"><i class="fab fa-facebook fa-lg"></i></a>
        <a href="#"><i class="fab fa-instagram fa-lg"></i></a>
      </div>
    </div>
    <div class="text-center mt-3" style="font-size:0.98rem; color:#ccc;">All Rights Reserved © 2024 SanAndresResidences.com</div>
  </div>
</footer>
<!-- Guest Reviews Carousel -->
<div class="container my-5">
    <h3 class="text-center mb-4" style="font-weight:800;color:#2c3e50;">What Our Guests Say</h3>
    <div id="guestReviewsCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="d-flex flex-column align-items-center">
                    <img src="https://randomuser.me/api/portraits/women/44.jpg" class="rounded-circle mb-3" style="width:72px;height:72px;object-fit:cover;">
                    <blockquote class="blockquote text-center">“Absolutely loved our stay! The staff were so helpful and the room was spotless.”</blockquote>
                    <footer class="blockquote-footer">Maria, Philippines</footer>
                </div>
            </div>
            <div class="carousel-item">
                <div class="d-flex flex-column align-items-center">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" class="rounded-circle mb-3" style="width:72px;height:72px;object-fit:cover;">
                    <blockquote class="blockquote text-center">“Great value for money and the location is perfect for exploring the city.”</blockquote>
                    <footer class="blockquote-footer">John, Australia</footer>
                </div>
            </div>
            <div class="carousel-item">
                <div class="d-flex flex-column align-items-center">
                    <img src="https://randomuser.me/api/portraits/women/68.jpg" class="rounded-circle mb-3" style="width:72px;height:72px;object-fit:cover;">
                    <blockquote class="blockquote text-center">“The breakfast was delicious and the beds were super comfy!”</blockquote>
                    <footer class="blockquote-footer">Anna, Germany</footer>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#guestReviewsCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#guestReviewsCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
<!-- Back to Top Button -->
<button class="back-to-top" onclick="window.scrollTo({top:0,behavior:'smooth'});" title="Back to Top"><i class="fa fa-arrow-up"></i></button>
<script>
</script>
</body>
</html>
