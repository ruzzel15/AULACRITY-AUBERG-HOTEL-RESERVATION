<?php
session_start();
include 'config.php';

// Only allow admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Handle status updates
if (isset($_POST['approve'])) {
    $reservation_id = $_POST['reservation_id'];
    $update_sql = "UPDATE reservations SET status='confirmed' WHERE id='$reservation_id'";
    mysqli_query($conn, $update_sql);
} elseif (isset($_POST['reject'])) {
    $reservation_id = $_POST['reservation_id'];
    $update_sql = "UPDATE reservations SET status='cancelled' WHERE id='$reservation_id'";
    mysqli_query($conn, $update_sql);
} elseif (isset($_POST['update_status'])) {
    $reservation_id = $_POST['reservation_id'];
    $new_status = $_POST['status'];
    $update_sql = "UPDATE reservations SET status='$new_status' WHERE id='$reservation_id'";
    mysqli_query($conn, $update_sql);
}

// Fetch all reservations
$sql = "SELECT r.id, u.username, rm.name AS room_name, r.check_in_date, r.check_out_date, r.status
        FROM reservations r
        JOIN users u ON r.user_id = u.id
        JOIN rooms rm ON r.room_id = rm.id
        ORDER BY r.id DESC";
$res = mysqli_query($conn, $sql);

// Summary counts
$total = $pending = $confirmed = $cancelled = 0;
$res_summary = mysqli_query($conn, "SELECT status, COUNT(*) as cnt FROM reservations GROUP BY status");
while ($row = mysqli_fetch_assoc($res_summary)) {
    $total += $row['cnt'];
    if ($row['status'] == 'pending') $pending = $row['cnt'];
    if ($row['status'] == 'confirmed') $confirmed = $row['cnt'];
    if ($row['status'] == 'cancelled') $cancelled = $row['cnt'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manage Reservations</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="navbar.css">
    <style>
        .summary-card { background: #fffbe6; border-radius: 12px; box-shadow: 0 2px 8px rgba(255,196,59,0.08); padding: 18px 24px; margin-bottom: 24px; }
        .badge-status { font-size: 1rem; padding: 6px 14px; border-radius: 8px; }
        .badge-pending { background: #ffc107; color: #222; }
        .badge-confirmed { background: #28a745; color: #fff; }
        .badge-cancelled { background: #dc3545; color: #fff; }
        .action-btn { min-width: 90px; }
        .table-responsive { margin-top: 18px; }
        @media (max-width: 600px) { .summary-card { padding: 10px 8px; } }
    </style>
</head>
<body>
<?php include 'navbar.php'; ?>
<div class="container my-5">
    <div class="d-flex flex-wrap gap-3 align-items-center mb-4">
        <div class="summary-card flex-fill">
            <div class="fw-bold fs-5 mb-1"><i class="fa fa-list me-2 text-warning"></i>Total Reservations</div>
            <div class="fs-4"><?php echo $total; ?></div>
        </div>
        <div class="summary-card flex-fill">
            <div class="fw-bold fs-5 mb-1"><i class="fa fa-clock me-2 text-secondary"></i>Pending</div>
            <div class="fs-4 text-warning"><?php echo $pending; ?></div>
        </div>
        <div class="summary-card flex-fill">
            <div class="fw-bold fs-5 mb-1"><i class="fa fa-check-circle me-2 text-success"></i>Confirmed</div>
            <div class="fs-4 text-success"><?php echo $confirmed; ?></div>
        </div>
        <div class="summary-card flex-fill">
            <div class="fw-bold fs-5 mb-1"><i class="fa fa-times-circle me-2 text-danger"></i>Cancelled</div>
            <div class="fs-4 text-danger"><?php echo $cancelled; ?></div>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header bg-light d-flex flex-wrap align-items-center justify-content-between">
            <div class="fw-bold fs-4"><i class="fa fa-calendar-check me-2 text-primary"></i>Manage Reservations</div>
            <a href="admin_dashboard.php" class="btn btn-outline-secondary"><i class="fa fa-arrow-left me-1"></i> Back to Dashboard</a>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <input type="text" id="searchInput" class="form-control" placeholder="Search by user, room, or status...">
            </div>
            <div class="table-responsive">
                <table class="table table-striped align-middle" id="reservationsTable">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Room</th>
                            <th>Check-In</th>
                            <th>Check-Out</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($res)): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo htmlspecialchars($row['username']); ?></td>
                            <td><?php echo htmlspecialchars($row['room_name']); ?></td>
                            <td><?php echo $row['check_in_date']; ?></td>
                            <td><?php echo $row['check_out_date']; ?></td>
                            <td>
                                <?php if($row['status']=='pending'): ?>
                                    <span class="badge badge-status badge-pending"><i class="fa fa-clock"></i> Pending</span>
                                <?php elseif($row['status']=='confirmed'): ?>
                                    <span class="badge badge-status badge-confirmed"><i class="fa fa-check"></i> Confirmed</span>
                                <?php elseif($row['status']=='cancelled'): ?>
                                    <span class="badge badge-status badge-cancelled"><i class="fa fa-times"></i> Cancelled</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary badge-status"><?php echo htmlspecialchars($row['status']); ?></span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($row['status']=='pending'): ?>
                                    <form method="post" class="d-inline">
                                        <input type="hidden" name="reservation_id" value="<?php echo $row['id']; ?>">
                                        <button type="submit" name="approve" class="btn btn-success btn-sm action-btn mb-1"><i class="fa fa-check"></i> Approve</button>
                                    </form>
                                    <form method="post" class="d-inline">
                                        <input type="hidden" name="reservation_id" value="<?php echo $row['id']; ?>">
                                        <button type="submit" name="reject" class="btn btn-danger btn-sm action-btn mb-1"><i class="fa fa-times"></i> Reject</button>
                                    </form>
                                <?php else: ?>
                                    <form method="post" class="d-inline">
                                        <input type="hidden" name="reservation_id" value="<?php echo $row['id']; ?>">
                                        <select name="status" class="form-select form-select-sm d-inline w-auto" style="display:inline-block;min-width:100px;">
                                            <option value="pending" <?php if($row['status']=='pending') echo 'selected'; ?>>Pending</option>
                                            <option value="confirmed" <?php if($row['status']=='confirmed') echo 'selected'; ?>>Confirmed</option>
                                            <option value="cancelled" <?php if($row['status']=='cancelled') echo 'selected'; ?>>Cancelled</option>
                                        </select>
                                        <button type="submit" name="update_status" class="btn btn-primary btn-sm action-btn"><i class="fa fa-save"></i> Update</button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Simple search/filter for reservations table
const searchInput = document.getElementById('searchInput');
const table = document.getElementById('reservationsTable');
searchInput.addEventListener('keyup', function() {
    const filter = searchInput.value.toLowerCase();
    const rows = table.getElementsByTagName('tr');
    for (let i = 1; i < rows.length; i++) {
        let show = false;
        const cells = rows[i].getElementsByTagName('td');
        for (let j = 0; j < cells.length; j++) {
            if (cells[j].innerText.toLowerCase().indexOf(filter) > -1) {
                show = true;
                break;
            }
        }
        rows[i].style.display = show ? '' : 'none';
    }
});
</script>
</body>
</html>
