<?php
session_start();
include 'config.php';

// If user already logged in, redirect to dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

$error = "";

if (isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Basic validation
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $error = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        // Check if email already exists
        $check = mysqli_query($conn, "SELECT id FROM users WHERE email='$email' LIMIT 1");
        if (mysqli_num_rows($check) > 0) {
            $error = "Email is already registered.";
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert new user
            $sql = "INSERT INTO users (username, email, password, role, created_at) 
                    VALUES ('$username', '$email', '$hashed_password', 'user', NOW())";
            if (mysqli_query($conn, $sql)) {
                // Registration successful
                header("Location: login.php");
                exit();
            } else {
                $error = "Registration failed: " . mysqli_error($conn);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register | Alacrity Auberge</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #f8f8f8 60%, #ffe9b3 100%) fixed;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .register-card {
            border-radius: 18px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.10);
            background: #fff;
            padding: 36px 32px 28px 32px;
            max-width: 440px;
            margin: 32px auto;
        }
        .brand-logo {
            width: 80px;
            height: 80px;
            object-fit: contain;
            border-radius: 16px;
            margin-bottom: 10px;
            border: 2px solid #eee;
            box-shadow: 0 2px 12px rgba(0,0,0,0.10);
            display: inline-block;
        }
        .brand-title {
            font-size: 2rem;
            font-weight: 900;
            color: #ffc43b;
            letter-spacing: 2px;
            margin-bottom: 2px;
        }
        .brand-subtitle {
            font-size: 1.1rem;
            color: #222;
            font-weight: 500;
            letter-spacing: 1px;
            margin-bottom: 18px;
        }
        .input-group-text { background: #fffbe6; border: none; }
        .form-control:focus { box-shadow: 0 0 0 2px #ffe9b3; border-color: #ffc43b; }
        .btn-register {
            background: linear-gradient(90deg, #ffc43b 0%, #ffecb3 100%);
            color: #222;
            font-weight: 700;
            border: none;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(255,196,59,0.10);
            transition: background 0.2s, color 0.2s, box-shadow 0.2s;
        }
        .btn-register:hover {
            background: #ffc43b;
            color: #fff;
            box-shadow: 0 4px 16px rgba(255,196,59,0.18);
        }
        .register-links { margin-top: 18px; }
        .register-links a { color: #007bff; text-decoration: none; }
        .register-links a:hover { text-decoration: underline; }
        @media (max-width: 600px) {
            .register-card { padding: 18px 8px 18px 8px; }
        }
    </style>
</head>
<body>
<div class="register-card">
    <div class="text-center mb-3">
        <img src="images/logorealnobg.png" alt="Alacrity Auberge Logo" class="brand-logo">
        <div class="brand-title">ALACRITY</div>
        <div class="brand-subtitle">AUBERGE</div>
    </div>
    <h3 class="text-center mb-4">Create Account</h3>
    <?php if(!empty($error)): ?>
        <div class="alert alert-danger d-flex align-items-center" role="alert">
            <i class="fa fa-exclamation-circle me-2"></i> <?php echo $error; ?>
        </div>
    <?php endif; ?>
    <form method="post" autocomplete="off">
        <div class="mb-3 input-group">
            <span class="input-group-text"><i class="fa fa-user"></i></span>
            <input type="text" name="username" class="form-control" placeholder="Username" required>
        </div>
        <div class="mb-3 input-group">
            <span class="input-group-text"><i class="fa fa-envelope"></i></span>
            <input type="email" name="email" class="form-control" placeholder="Email address" required>
        </div>
        <div class="mb-3 input-group">
            <span class="input-group-text"><i class="fa fa-lock"></i></span>
            <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>
        <div class="mb-3 input-group">
            <span class="input-group-text"><i class="fa fa-lock"></i></span>
            <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" required>
        </div>
        <button type="submit" name="register" class="btn btn-register w-100 py-2">Register</button>
    </form>
    <div class="register-links text-center">
        <div class="mt-3">Already have an account? <a href="login.php">Login here</a>.</div>
    </div>
</div>
</body>
</html>
