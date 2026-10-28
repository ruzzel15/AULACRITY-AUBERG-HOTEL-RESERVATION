<?php
session_start();
include 'config.php';

// Only allow logged-in users
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch reservations for this user with room info
$sql = "SELECT r.id AS reservation_id, rooms.name, rooms.price, r.check_in_date, r.check_out_date, r.status
        FROM reservations r
        JOIN rooms ON r.room_id = rooms.id
        WHERE r.user_id = '$user_id'
        ORDER BY r.check_in_date DESC";

$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Reservations</title>
    <style>
        table { border-collapse: collapse; width: 90%; margin: 20px auto; }
        th, td { padding: 10px; border: 1px solid #ccc; text-align: center; }
        th { background-color: #007bff; color: white; }
        .btn-cancel {
            background-color: #dc3545; color: white; border: none;
            padding: 5px 10px; border-radius: 5px; cursor: pointer;
        }
        .btn-cancel:hover { background-color: #a71d2a; }
    </style>
</head>
<body>
<h2 style="text-align:center;">My Reservations</h2>
<a href="rooms.php">Back to Rooms</a> | 
<a href="logout.php">Logout</a>
<hr>

<?php if (mysqli_num_rows($result) > 0): ?>
    <table>
        <thead>
            <tr>
                <th>Room</th>
                <th>Price (₱/night)</th>
                <th>Check-in</th>
                <th>Check-out</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($reservation = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($reservation['name']); ?></td>
                    <td><?php echo htmlspecialchars($reservation['price']); ?></td>
                    <td><?php echo htmlspecialchars($reservation['check_in_date']); ?></td>
                    <td><?php echo htmlspecialchars($reservation['check_out_date']); ?></td>
                    <td><?php echo htmlspecialchars(ucfirst($reservation['status'])); ?></td>
                    <td>
                        <?php if ($reservation['status'] == 'pending'): ?>
                            <form action="cancel_reservation.php" method="post" onsubmit="return confirm('Are you sure you want to cancel this reservation?');">
                                <input type="hidden" name="reservation_id" value="<?php echo $reservation['reservation_id']; ?>">
                                <button type="submit" class="btn-cancel">Cancel</button>
                            </form>
                        <?php else: ?>
                            N/A
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
<?php else: ?>
    <p style="text-align:center;">You have no reservations yet.</p>
<?php endif; ?>

</body>
</html>
