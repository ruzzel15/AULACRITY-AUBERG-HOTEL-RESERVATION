<?php
session_start();
include 'config.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Check if form submitted
if (isset($_POST['book'])) {
    $user_id = $_SESSION['user_id'];
    $room_id = $_POST['room_id'];
    $check_in = $_POST['check_in_date'];
    $check_out = $_POST['check_out_date'];

    // Basic validation: check dates
    if ($check_in >= $check_out) {
        echo "❌ Check-out date must be after check-in date.";
        exit();
    }

    // Insert reservation
    $sql = "INSERT INTO reservations (user_id, room_id, check_in_date, check_out_date, status) 
            VALUES ('$user_id', '$room_id', '$check_in', '$check_out', 'pending')";

    if (mysqli_query($conn, $sql)) {
        // Redirect to My Reservations page
        header("Location: my_reservations.php");
        exit();
    } else {
        echo "❌ Error: " . mysqli_error($conn);
    }
} else {
    // If accessed directly without POST data, redirect back
    header("Location: rooms.php");
    exit();
}
?>
