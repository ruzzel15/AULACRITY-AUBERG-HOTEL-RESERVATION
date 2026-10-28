<?php
session_start();
include 'config.php';

// Only logged-in users
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Check if form submitted with reservation_id
if (isset($_POST['reservation_id'])) {
    $reservation_id = $_POST['reservation_id'];
    $user_id = $_SESSION['user_id'];

    // Make sure this reservation belongs to this user
    $check_sql = "SELECT * FROM reservations WHERE id='$reservation_id' AND user_id='$user_id' AND status='pending'";
    $check_res = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($check_res) > 0) {
        // Delete or update status to 'cancelled'
        $cancel_sql = "UPDATE reservations SET status='cancelled' WHERE id='$reservation_id'";
        if (mysqli_query($conn, $cancel_sql)) {
            header("Location: my_reservations.php");
            exit();
        } else {
            echo "❌ Error cancelling reservation: " . mysqli_error($conn);
        }
    } else {
        echo "❌ Reservation not found or cannot be cancelled.";
    }
} else {
    // If accessed without POST data
    header("Location: my_reservations.php");
    exit();
}
?>
