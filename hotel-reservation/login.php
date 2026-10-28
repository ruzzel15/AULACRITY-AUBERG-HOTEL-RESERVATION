<?php
session_start();
include 'config.php'; // your DB connection file

// Show errors during development
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check for Remember Me cookie before login logic
if (!isset($_SESSION['user_id']) && isset($_COOKIE['rememberme'])) {
    $token = $_COOKIE['rememberme'];
    $sql = "SELECT * FROM users WHERE remember_token='$token' LIMIT 1";
    $res = mysqli_query($conn, $sql);
    if ($res && mysqli_num_rows($res) === 1) {
        $user = mysqli_fetch_assoc($res);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        header("Location: index.php");
        exit();
    }
}

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    // fetch user by email
    $sql = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $res = mysqli_query($conn, $sql);

    if (mysqli_num_rows($res) === 1) {
        $user = mysqli_fetch_assoc($res);

        // ✅ if you stored hashed passwords in DB:
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            // Remember Me logic
            if (!empty($_POST['remember'])) {
                $token = bin2hex(random_bytes(32));
                setcookie('rememberme', $token, time() + (86400 * 30), "/", "", false, true);
                $user_id = $user['id'];
                mysqli_query($conn, "UPDATE users SET remember_token='$token' WHERE id='$user_id'");
            } else {
                setcookie('rememberme', '', time() - 3600, "/");
                $user_id = $user['id'];
                mysqli_query($conn, "UPDATE users SET remember_token=NULL WHERE id='$user_id'");
            }

            // Redirect based on role
            header("Location: index.php");
            exit();

        } else {
            // ❌ wrong password
            $error = "Incorrect password!";
        }
    } else {
        // ❌ email not found
        $error = "Email not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login | Alacrity Auberge</title>
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
.login-card {
    border-radius: 18px;
    box-shadow: 0 8px 32px rgba(0,0,0,0.10);
    background: #fff;
    padding: 54px 48px 40px 48px;
    max-width: 540px;
    margin: 48px auto;
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
.btn-login {
    background: linear-gradient(90deg, #ffc43b 0%, #ffecb3 100%);
    color: #222;
    font-weight: 700;
    border: none;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(255,196,59,0.10);
    transition: background 0.2s, color 0.2s, box-shadow 0.2s;
}
.btn-login:hover {
    background: #ffc43b;
    color: #fff;
    box-shadow: 0 4px 16px rgba(255,196,59,0.18);
}
.login-links { margin-top: 18px; }
.login-links a { color: #007bff; text-decoration: none; }
.login-links a:hover { text-decoration: underline; }
@media (max-width: 600px) {
    .login-card { padding: 18px 8px 18px 8px; max-width: 98vw; }
}
</style>
</head>
<body>
<div class="login-card">
    <div class="text-center mb-3">
        <img src="images/logorealnobg.png" alt="Alacrity Auberge Logo" class="brand-logo">
        <div class="brand-title">ALACRITY</div>
        <div class="brand-subtitle">AUBERGE</div>
    </div>
    <h3 class="text-center mb-4">Sign In</h3>
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger d-flex align-items-center" role="alert">
            <i class="fa fa-exclamation-circle me-2"></i> <?php echo $error; ?>
        </div>
    <?php endif; ?>
    <form method="post" autocomplete="off">
        <div class="mb-3 input-group">
            <span class="input-group-text"><i class="fa fa-envelope"></i></span>
            <input type="email" name="email" class="form-control" placeholder="Email address" required autofocus>
        </div>
        <div class="mb-3 input-group">
            <span class="input-group-text"><i class="fa fa-lock"></i></span>
            <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="remember" name="remember">
            <label class="form-check-label" for="remember">Remember Me</label>
        </div>
        <button type="submit" name="login" class="btn btn-login w-100 py-2">Login</button>
    </form>
    <div class="text-center my-3 text-muted">or</div>
    <div class="d-grid gap-2 mb-3">
        <button class="btn btn-social btn-facebook w-100" style="background:#3b5998;color:#fff;font-weight:600;"><i class="fab fa-facebook-f me-2"></i>Continue with Facebook</button>
        <button class="btn btn-social btn-google w-100" style="background:#fff;color:#222;font-weight:600;border:1px solid #eee;"><i class="fab fa-google me-2" style="color:#ea4335;"></i>Continue with Google</button>
        <button class="btn btn-social btn-apple w-100" style="background:#000;color:#fff;font-weight:600;"><i class="fab fa-apple me-2"></i>Continue with Apple</button>
        <button class="btn btn-social btn-instagram w-100" style="background:linear-gradient(45deg,#f58529,#dd2a7b,#8134af,#515bd4);color:#fff;font-weight:600;"><i class="fab fa-instagram me-2"></i>Continue with Instagram</button>
    </div>
    <div class="login-links text-center">
        <div class="mt-3">Don’t have an account? <a href="register.php">Register here</a>.</div>
        <div class="mt-1"><a href="forgot_password.php">Forgot password?</a></div>
    </div>
</div>
</body>
</html>
