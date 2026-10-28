<?php
session_start();
$success = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $success = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Forgot Password | Alacrity Auberge</title>
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
        .forgot-card {
            border-radius: 18px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.10);
            background: #fff;
            padding: 44px 40px 32px 40px;
            max-width: 480px;
            margin: 40px auto;
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
        .btn-forgot {
            background: linear-gradient(90deg, #ffc43b 0%, #ffecb3 100%);
            color: #222;
            font-weight: 700;
            border: none;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(255,196,59,0.10);
            transition: background 0.2s, color 0.2s, box-shadow 0.2s;
        }
        .btn-forgot:hover {
            background: #ffc43b;
            color: #fff;
            box-shadow: 0 4px 16px rgba(255,196,59,0.18);
        }
        .forgot-links { margin-top: 18px; }
        .forgot-links a { color: #007bff; text-decoration: none; }
        .forgot-links a:hover { text-decoration: underline; }
        @media (max-width: 600px) {
            .forgot-card { padding: 18px 8px 18px 8px; max-width: 98vw; }
        }
    </style>
</head>
<body>
<div class="forgot-card">
    <div class="text-center mb-3">
        <img src="images/logorealnobg.png" alt="Alacrity Auberge Logo" class="brand-logo">
        <div class="brand-title">ALACRITY</div>
        <div class="brand-subtitle">AUBERGE</div>
    </div>
    <h3 class="text-center mb-4">Forgot Password</h3>
    <?php if ($success): ?>
        <div class="alert alert-success d-flex align-items-center" role="alert">
            <i class="fa fa-check-circle me-2"></i> If this email exists in our system, a password reset link has been sent.
        </div>
    <?php else: ?>
    <form method="post" autocomplete="off">
        <div class="mb-3 input-group">
            <span class="input-group-text"><i class="fa fa-envelope"></i></span>
            <input type="email" name="email" class="form-control" placeholder="Enter your email address" required autofocus>
        </div>
        <button type="submit" class="btn btn-forgot w-100 py-2">Send Reset Link</button>
    </form>
    <?php endif; ?>
    <div class="forgot-links text-center">
        <div class="mt-3"><a href="login.php">Back to Login</a></div>
    </div>
</div>
</body>
</html> 