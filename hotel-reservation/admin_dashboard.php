<?php
session_start();
include 'config.php';
// Protect admin dashboard
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Alacrity Auberge</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="navbar.css">
    <style>
        body { background: #f7f8fa; }
        .dashboard-header {
            background: linear-gradient(90deg, #ffc43b 0%, #ffecb3 100%);
            padding: 32px 0 18px 0;
            text-align: center;
            margin-bottom: 32px;
        }
        .dashboard-header h1 {
            font-weight: 700;
            color: #333;
        }
        .dashboard-summary .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.07);
            transition: transform 0.12s;
        }
        .dashboard-summary .card:hover {
            transform: translateY(-4px) scale(1.03);
        }
        .dashboard-summary .card-title {
            font-size: 1.2rem;
            font-weight: 600;
        }
        .quick-links .btn {
            min-width: 180px;
            margin-bottom: 12px;
        }
        .recent-activity {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.07);
            padding: 24px 18px;
            margin-top: 32px;
        }
        @media (max-width: 768px) {
            .dashboard-summary .col-md-4 { margin-bottom: 18px; }
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="dashboard-header">
        <h1><i class="fa fa-user-shield me-2 text-primary"></i>Admin Dashboard</h1>
        <div class="lead">
  Welcome, <?php
    if (isset($_SESSION['username'])) {
        echo htmlspecialchars($_SESSION['username']);
    } else {
        echo "Admin";
    }
  ?>!
</div>
    </div>
    <div class="container">
        <div class="row dashboard-summary mb-4">
            <div class="col-md-4">
                <div class="card text-center py-4">
                    <div class="card-body">
                        <div class="mb-2"><i class="fa fa-users fa-2x text-info"></i></div>
                        <div class="card-title">Users</div>
                        <div class="h3 mb-2">
                            <?php $u = mysqli_query($conn, "SELECT COUNT(*) FROM users"); $uc = mysqli_fetch_row($u)[0]; echo $uc; ?>
                        </div>
                        <a href="manage_users.php" class="btn btn-outline-info btn-sm">Manage Users</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center py-4">
                    <div class="card-body">
                        <div class="mb-2"><i class="fa fa-bed fa-2x text-success"></i></div>
                        <div class="card-title">Rooms</div>
                        <div class="h3 mb-2">
                            <?php $r = mysqli_query($conn, "SELECT COUNT(*) FROM rooms"); $rc = mysqli_fetch_row($r)[0]; echo $rc; ?>
                        </div>
                        <a href="manage_rooms.php" class="btn btn-outline-success btn-sm">Manage Rooms</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center py-4">
                    <div class="card-body">
                        <div class="mb-2"><i class="fa fa-calendar-check fa-2x text-warning"></i></div>
                        <div class="card-title">Reservations</div>
                        <div class="h3 mb-2">
                            <?php $re = mysqli_query($conn, "SELECT COUNT(*) FROM reservations"); $rec = mysqli_fetch_row($re)[0]; echo $rec; ?>
                        </div>
                        <a href="manage_reservations.php" class="btn btn-outline-warning btn-sm">Manage Reservations</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row quick-links mb-4 text-center">
            <div class="col-md-12">
                <a href="manage_users.php" class="btn btn-primary me-2"><i class="fa fa-user-cog me-1"></i> Manage Users</a>
                <a href="manage_rooms.php" class="btn btn-success me-2"><i class="fa fa-bed me-1"></i> Manage Rooms</a>
                <a href="manage_reservations.php" class="btn btn-warning text-dark"><i class="fa fa-calendar-check me-1"></i> Manage Reservations</a>
            </div>
        </div>
        <div class="recent-activity">
            <h5 class="mb-3"><i class="fa fa-history me-2 text-secondary"></i>Recent Activity</h5>
            <ul class="list-group">
                <?php
                try {
                    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
                    $logs = mysqli_query($conn, "SELECT action, created_at FROM admin_logs ORDER BY created_at DESC LIMIT 5");
                    if ($logs && mysqli_num_rows($logs) > 0) {
                        while ($log = mysqli_fetch_assoc($logs)) {
                            echo '<li class="list-group-item d-flex justify-content-between align-items-center">'
                                . htmlspecialchars($log['action']) .
                                '<span class="badge bg-light text-muted">' . date('M d, Y H:i', strtotime($log['created_at'])) . '</span></li>';
                        }
                    } else {
                        echo '<li class="list-group-item text-muted">No recent activity.</li>';
                    }
                } catch (mysqli_sql_exception $e) {
                    echo '<li class="list-group-item text-danger">Admin logs table not found. Recent activity tracking is not enabled.</li>';
                }
                ?>
            </ul>
        </div>
        <div class="text-end mt-4">
            <a href="logout.php" class="btn btn-outline-danger"><i class="fa fa-sign-out-alt me-1"></i> Logout</a>
        </div>
    </div>
    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
