<?php
session_start();
include 'config.php';

$room_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$room = null;
if ($room_id) {
    $result = mysqli_query($conn, "SELECT * FROM rooms WHERE id=$room_id LIMIT 1");
    if ($result && mysqli_num_rows($result) > 0) {
        $room = mysqli_fetch_assoc($result);
    }
}
if (!$room) {
    echo '<p>Room not found.</p>';
    exit();
}
$max_guests = isset($room['max_guests']) ? $room['max_guests'] : 2;
$rating = number_format(rand(89, 97) / 10, 1);
$reviews = number_format(rand(2000, 20000));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo htmlspecialchars($room['name']); ?> - Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="navbar.css">
    <style>
        body { background: #f8f8f8; }
        .details-container { max-width: 1100px; margin: 40px auto 0 auto; background: #fff; border-radius: 18px; box-shadow: 0 4px 18px rgba(0,0,0,0.08); padding: 32px 28px; }
        .details-header { display: flex; flex-wrap: wrap; gap: 32px; align-items: flex-start; }
        .details-img { width: 380px; height: 260px; object-fit: cover; border-radius: 14px; box-shadow: 0 2px 8px rgba(0,0,0,0.10); }
        .details-main { flex: 1 1 320px; }
        .details-title { font-size: 2.1rem; font-weight: 800; color: #2c3e50; margin-bottom: 8px; }
        .details-badges { display: flex; align-items: center; gap: 12px; margin-bottom: 10px; }
        .badge-guests { background: #ffc43b; color: #222; font-weight: 600; border-radius: 8px; padding: 4px 12px; font-size: 0.98rem; }
        .badge-rating { background: #179c3c; color: #fff; font-weight: 700; border-radius: 8px; padding: 4px 12px; font-size: 0.98rem; }
        .details-price { color: #007bff; font-weight: 700; font-size: 1.18rem; margin-bottom: 10px; }
        .details-section { margin-top: 32px; }
        .details-section h3 { font-size: 1.25rem; font-weight: 700; color: #2c3e50; margin-bottom: 12px; }
        .details-section ul { padding-left: 20px; }
        .details-section .card { border-radius: 10px; margin-bottom: 18px; }
        .details-facilities { display: flex; flex-wrap: wrap; gap: 16px; }
        .details-facility { background: #f8f8f8; border-radius: 8px; padding: 8px 16px; font-size: 1.01rem; color: #444; display: flex; align-items: center; gap: 8px; }
        .details-rules, .details-fineprint { background: #fffbe6; border: 1.5px solid #ffc43b; border-radius: 10px; padding: 16px 18px; color: #555; }
        .details-reviews { background: #f8f8f8; border-radius: 10px; padding: 18px 18px 10px 18px; }
        .details-review { border-bottom: 1px solid #eee; padding-bottom: 10px; margin-bottom: 10px; }
        .details-review:last-child { border-bottom: none; }
        @media (max-width: 900px) {
            .details-header { flex-direction: column; align-items: stretch; }
            .details-img { width: 100%; height: 200px; }
        }
    </style>
</head>
<body>
<?php include 'navbar.php'; ?>
<div class="details-container">
    <div class="details-header">
        <img src="<?php echo !empty($room['image_path']) ? 'uploads/' . htmlspecialchars($room['image_path']) : 'images/standard.jpg'; ?>" class="details-img" alt="<?php echo htmlspecialchars($room['name']); ?>">
        <div class="details-main">
            <div class="details-title"><?php echo htmlspecialchars($room['name']); ?></div>
            <div class="details-badges mb-2">
                <span class="badge-guests"><i class="fa fa-users me-1"></i> <?php echo $max_guests; ?> Guests</span>
                <span class="badge-rating"><i class="fa fa-star me-1"></i> <?php echo $rating; ?> <span style="font-weight:400;">(<?php echo $reviews; ?>)</span></span>
            </div>
            <div class="details-price">₱<?php echo $room['price']; ?> / night</div>
            <div class="mb-2" style="color:#444; font-size:1.05rem;">
                <?php echo nl2br(htmlspecialchars($room['description'])); ?>
            </div>
        </div>
    </div>
    <div class="details-section">
        <h3>Info & Prices</h3>
        <ul>
            <li>Room size: <?php echo isset($room['size']) ? htmlspecialchars($room['size']) : '30'; ?> m²</li>
            <li>Bed type: <?php echo isset($room['bed_type']) ? htmlspecialchars($room['bed_type']) : 'Double or Twin'; ?></li>
            <li>View: <?php echo isset($room['view']) ? htmlspecialchars($room['view']) : 'City'; ?></li>
            <li>Breakfast included: <?php echo isset($room['breakfast']) && $room['breakfast'] ? 'Yes' : 'No'; ?></li>
        </ul>
    </div>
    <div class="details-section">
        <h3>Facilities</h3>
        <div class="details-facilities">
            <div class="details-facility"><i class="fa fa-wifi"></i> Free WiFi</div>
            <div class="details-facility"><i class="fa fa-tv"></i> Flat-screen TV</div>
            <div class="details-facility"><i class="fa fa-snowflake"></i> Air conditioning</div>
            <div class="details-facility"><i class="fa fa-bath"></i> Private bathroom</div>
            <div class="details-facility"><i class="fa fa-mug-hot"></i> Electric kettle</div>
            <div class="details-facility"><i class="fa fa-parking"></i> Free parking</div>
            <div class="details-facility"><i class="fa fa-smoking-ban"></i> Non-smoking</div>
        </div>
    </div>
    <div class="details-section">
        <h3>House Rules</h3>
        <div class="details-rules">
            <ul>
                <li>Check-in: 14:00 - 22:00</li>
                <li>Check-out: Until 12:00</li>
                <li>Children and beds: All children are welcome</li>
                <li>Pets: Not allowed</li>
                <li>Cards accepted: Visa, MasterCard</li>
            </ul>
        </div>
    </div>
    <div class="details-section">
        <h3>The Fine Print</h3>
        <div class="details-fineprint">
            Please inform us in advance of your expected arrival time. Special Requests are subject to availability and may incur additional charges. Smoking is not allowed in the rooms.
        </div>
    </div>
    <div class="details-section">
        <h3>Guest Reviews</h3>
        <div class="details-reviews">
            <div class="details-review"><strong>Maria:</strong> "Wonderful stay, very clean and comfortable!"</div>
            <div class="details-review"><strong>John:</strong> "Great location and friendly staff. Will come back!"</div>
            <div class="details-review"><strong>Anna:</strong> "Loved the breakfast and the view from the room."</div>
        </div>
    </div>
</div>
</body>
</html> 