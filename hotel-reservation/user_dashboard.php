<?php
session_start();
include 'config.php';

// 🔒 Protect user dashboard
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit();
}
$user_id = $_SESSION['user_id'];
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'User';

// Fetch confirmed reservations for this user
$sql = "SELECT r.id AS reservation_id, rooms.name, rooms.price, r.check_in_date, r.check_out_date, r.status
        FROM reservations r
        JOIN rooms ON r.room_id = rooms.id
        WHERE r.user_id = '$user_id' AND r.status = 'confirmed'
        ORDER BY r.check_in_date ASC";
$result = mysqli_query($conn, $sql);

// Fetch next upcoming confirmed reservation
$next_sql = "SELECT rooms.name, r.check_in_date, r.check_out_date
             FROM reservations r
             JOIN rooms ON r.room_id = rooms.id
             WHERE r.user_id = '$user_id' AND r.status = 'confirmed' AND r.check_in_date >= CURDATE()
             ORDER BY r.check_in_date ASC LIMIT 1";
$next_res = mysqli_query($conn, $next_sql);
$next = mysqli_fetch_assoc($next_res);

// Fetch user info
$user_info = mysqli_fetch_assoc(mysqli_query($conn, "SELECT username, email FROM users WHERE id='$user_id' LIMIT 1"));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Dashboard</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="navbar.css">
    <style>
        body { background: #f7f8fa; }
        .dashboard-header { background: linear-gradient(90deg, #ffc43b 0%, #ffecb3 100%); padding: 32px 0 18px 0; text-align: center; margin-bottom: 32px; }
        .dashboard-header h1 { font-weight: 700; color: #333; }
        .next-stay-card { background: #fffbe6; border-radius: 12px; box-shadow: 0 2px 8px rgba(255,196,59,0.08); padding: 18px 24px; margin-bottom: 24px; }
        .amenity-icon { font-size: 1.5rem; color: #ffc43b; margin-right: 10px; }
        .profile-card { background: #fff; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.07); padding: 18px 24px; }
        .contact-card { background: #f8f9fa; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.04); padding: 18px 24px; }
        .table-responsive { margin-top: 18px; }
        .badge-status { font-size: 1rem; padding: 6px 14px; border-radius: 8px; }
        .badge-confirmed { background: #28a745; color: #fff; }
        @media (max-width: 991px) { .dashboard-header { padding: 18px 0 10px 0; } }
    </style>
</head>
<body>
<?php include 'navbar.php'; ?>
<div class="dashboard-header">
    <h1><i class="fa fa-user-circle me-2 text-primary"></i>Welcome, <?php echo htmlspecialchars($username); ?>!</h1>
    <div class="lead">Your personalized dashboard for Alacrity Auberge</div>
</div>
<div class="container mb-5">
    <div class="row g-4">
        <div class="col-lg-8">
            <?php if ($next): ?>
            <div class="next-stay-card mb-4">
                <h5 class="mb-2"><i class="fa fa-calendar-check text-success me-2"></i>Your Next Stay</h5>
                <div class="fs-5 fw-bold mb-1"><?php echo htmlspecialchars($next['name']); ?></div>
                <div>Check-in: <strong><?php echo htmlspecialchars($next['check_in_date']); ?></strong></div>
                <div>Check-out: <strong><?php echo htmlspecialchars($next['check_out_date']); ?></strong></div>
                <?php
                $checkin = strtotime($next['check_in_date']);
                $now = strtotime(date('Y-m-d'));
                $days = ($checkin - $now) / (60*60*24);
                if ($days > 0) {
                    echo '<div class="mt-2 text-secondary">Check-in is in <strong>' . intval($days) . '</strong> day' . ($days > 1 ? 's' : '') . '.</div>';
                } elseif ($days == 0) {
                    echo '<div class="mt-2 text-success">Check-in is today!</div>';
                }
                ?>
            </div>
            <?php endif; ?>
            <div class="card mb-4">
                <div class="card-header bg-light fw-bold"><i class="fa fa-bed me-2 text-primary"></i>Your Confirmed Reservations</div>
                <div class="card-body">
                    <?php if (mysqli_num_rows($result) > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-striped align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Room</th>
                                    <th>Price (₱/night)</th>
                                    <th>Check-in</th>
                                    <th>Check-out</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($reservation = mysqli_fetch_assoc($result)): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($reservation['name']); ?></td>
                                    <td><?php echo htmlspecialchars($reservation['price']); ?></td>
                                    <td><?php echo htmlspecialchars($reservation['check_in_date']); ?></td>
                                    <td><?php echo htmlspecialchars($reservation['check_out_date']); ?></td>
                                    <td><span class="badge badge-status badge-confirmed"><i class="fa fa-check"></i> Confirmed</span></td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php else: ?>
                        <div class="text-muted">You have no confirmed reservations yet.</div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header bg-light fw-bold"><i class="fa fa-info-circle me-2 text-secondary"></i>Hotel Amenities</div>
                <div class="card-body">
                    <div class="d-flex flex-wrap gap-4">
                        <div><i class="fa fa-wifi amenity-icon"></i>Free WiFi</div>
                        <div><i class="fa fa-swimmer amenity-icon"></i>Swimming Pool</div>
                        <div><i class="fa fa-dumbbell amenity-icon"></i>Fitness Center</div>
                        <div><i class="fa fa-utensils amenity-icon"></i>Restaurant</div>
                        <div><i class="fa fa-spa amenity-icon"></i>Spa</div>
                        <div><i class="fa fa-parking amenity-icon"></i>Free Parking</div>
                        <div><i class="fa fa-tv amenity-icon"></i>Smart TV</div>
                        <div><i class="fa fa-mug-hot amenity-icon"></i>Breakfast Included</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="profile-card mb-4">
                <h5 class="mb-2"><i class="fa fa-user me-2 text-primary"></i>Your Profile</h5>
                <div><strong>Name:</strong> <?php echo htmlspecialchars($user_info['username']); ?></div>
                <div><strong>Email:</strong> <?php echo htmlspecialchars($user_info['email']); ?></div>
            </div>
            <div class="contact-card mb-4">
                <h5 class="mb-2"><i class="fa fa-phone-alt me-2 text-success"></i>Contact Us</h5>
                <div><i class="fa fa-phone me-2"></i> <a href="tel:+6321234567">+63 2 1234 567</a></div>
                <div><i class="fa fa-envelope me-2"></i> <a href="mailto:info@alacrityauberge.com">info@alacrityauberge.com</a></div>
                <div><i class="fa fa-map-marker-alt me-2"></i> Manila, Philippines</div>
            </div>
            <div class="card mb-4">
                <div class="card-header bg-light fw-bold"><i class="fa fa-question-circle me-2 text-info"></i>Need Help?</div>
                <div class="card-body">
                    <a href="guest_services.php" class="btn btn-outline-info w-100 mb-2"><i class="fa fa-concierge-bell me-1"></i> Guest Services</a>
                    <a href="the_hotel.php" class="btn btn-outline-secondary w-100 mb-2"><i class="fa fa-hotel me-1"></i> About the Hotel</a>
                    <a href="location.php" class="btn btn-outline-dark w-100"><i class="fa fa-map-marker-alt me-1"></i> Location & Directions</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
