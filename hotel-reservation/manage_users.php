<?php
session_start();
include 'config.php';
// ✅ Only allow admin access
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}
// ✅ Handle delete action
if (isset($_GET['delete'])) {
    $user_id = $_GET['delete'];
    // Optional: Prevent deleting admin account
    $check = mysqli_query($conn, "SELECT role FROM users WHERE id='$user_id'");
    $row = mysqli_fetch_assoc($check);
    if ($row['role'] != 'admin') {
        mysqli_query($conn, "DELETE FROM users WHERE id='$user_id'");
    }
}
// ✅ Fetch all users
$sql = "SELECT id, username, email, role, created_at FROM users ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users | Alacrity Auberge</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="navbar.css">
    <style>
        body { background: #f7f8fa; }
        .users-card {
            max-width: 1100px;
            margin: 40px auto 32px auto;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 2px 16px rgba(0,0,0,0.07);
            padding: 32px 24px 24px 24px;
        }
        .users-title {
            font-size: 2.1rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 18px;
        }
        .table thead th {
            background: #ffc43b;
            color: #222;
            font-weight: 700;
        }
        .badge-admin { background: #007bff; }
        .badge-user { background: #28a745; }
        .btn-delete {
            background: #dc3545;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 5px 12px;
            font-size: 0.98rem;
        }
        .btn-delete:hover { background: #a71d2a; }
        .back-btn {
            margin-bottom: 18px;
        }
        @media (max-width: 768px) {
            .users-card { padding: 12px 2px; }
            .users-title { font-size: 1.4rem; }
        }
    </style>
</head>
<body>
<?php include 'navbar.php'; ?>
<div class="users-card">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="users-title"><i class="fa fa-users me-2 text-primary"></i>Manage Users</div>
        <a href="admin_dashboard.php" class="btn btn-outline-secondary back-btn"><i class="fa fa-arrow-left me-1"></i> Back to Dashboard</a>
    </div>
    <div class="table-responsive">
        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td>
                        <?php if ($row['role'] == 'admin'): ?>
                            <span class="badge badge-admin">Admin</span>
                        <?php else: ?>
                            <span class="badge badge-user">User</span>
                        <?php endif; ?>
                    </td>
                    <td><?php echo $row['created_at']; ?></td>
                    <td>
                        <?php if ($row['role'] != 'admin'): ?>
                            <a class="btn btn-delete" href="manage_users.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this user?')"><i class="fa fa-trash"></i> Delete</a>
                        <?php else: ?>
                            <em>Admin</em>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
<?php include 'footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
