<?php
session_start();
include 'config.php';
// ✅ Only allow admin access
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}
// Handle file upload
function handle_image_upload($file_input, $old_image = null) {
    if (isset($_FILES[$file_input]) && $_FILES[$file_input]['error'] === UPLOAD_ERR_OK) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $ext = strtolower(pathinfo($_FILES[$file_input]['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, $allowed)) return $old_image;
        $filename = uniqid('room_', true) . '.' . $ext;
        $target = 'uploads/' . $filename;
        if (move_uploaded_file($_FILES[$file_input]['tmp_name'], $target)) {
            // Optionally delete old image
            if ($old_image && file_exists('uploads/' . $old_image)) {
                @unlink('uploads/' . $old_image);
            }
            return $filename;
        }
    }
    return $old_image;
}
// ✅ ADD ROOM
if (isset($_POST['add_room'])) {
    $name = $_POST['name'];
    $desc = $_POST['description'];
    $price = $_POST['price'];
    $status = $_POST['status'];
    $image_path = handle_image_upload('image');
    $sql = "INSERT INTO rooms (name, description, price, status, image_path) VALUES ('$name', '$desc', '$price', '$status', '$image_path')";
    if (!mysqli_query($conn, $sql)) {
        die("❌ Add Error: " . mysqli_error($conn));
    }
    header("Location: manage_rooms.php");
    exit();
}
// ✅ UPDATE ROOM
if (isset($_POST['update_room'])) {
    $id = $_POST['room_id'];
    $name = $_POST['name'];
    $desc = $_POST['description'];
    $price = $_POST['price'];
    $status = $_POST['status'];
    $old_image = $_POST['old_image'];
    $image_path = handle_image_upload('image', $old_image);
    $sql = "UPDATE rooms SET name='$name', description='$desc', price='$price', status='$status', image_path='$image_path' WHERE id=$id";
    if (!mysqli_query($conn, $sql)) {
        die("❌ Update Error: " . mysqli_error($conn));
    }
    header("Location: manage_rooms.php");
    exit();
}
// ✅ DELETE ROOM
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    // Delete image file
    $imgq = mysqli_query($conn, "SELECT image_path FROM rooms WHERE id=$id");
    if ($imgq && $imgrow = mysqli_fetch_assoc($imgq)) {
        if (!empty($imgrow['image_path']) && file_exists('uploads/' . $imgrow['image_path'])) {
            @unlink('uploads/' . $imgrow['image_path']);
        }
    }
    $sql = "DELETE FROM rooms WHERE id=$id";
    if (!mysqli_query($conn, $sql)) {
        die("❌ Delete Error: " . mysqli_error($conn));
    }
    header("Location: manage_rooms.php");
    exit();
}
// ✅ FETCH ROOMS
$result = mysqli_query($conn, "SELECT * FROM rooms ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Rooms | Alacrity Auberge</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="navbar.css">
    <style>
        body { background: #f7f8fa; }
        .rooms-card {
            max-width: 1200px;
            margin: 40px auto 32px auto;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 2px 16px rgba(0,0,0,0.07);
            padding: 32px 24px 24px 24px;
        }
        .rooms-title {
            font-size: 2.1rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 18px;
        }
        .badge-available { background: #28a745; }
        .badge-unavailable { background: #dc3545; }
        .btn-action {
            border: none;
            border-radius: 5px;
            padding: 5px 12px;
            font-size: 0.98rem;
            margin-right: 4px;
        }
        .btn-update { background: #ffc43b; color: #222; }
        .btn-update:hover { background: #e0a800; color: #222; }
        .btn-delete { background: #dc3545; color: #fff; }
        .btn-delete:hover { background: #a71d2a; color: #fff; }
        .back-btn { margin-bottom: 18px; }
        .form-label { font-weight: 500; }
        .room-img-thumb { width: 60px; height: 40px; object-fit: cover; border-radius: 6px; border: 1px solid #eee; margin-right: 8px; }
        @media (max-width: 768px) {
            .rooms-card { padding: 12px 2px; }
            .rooms-title { font-size: 1.4rem; }
        }
    </style>
</head>
<body>
<?php include 'navbar.php'; ?>
<div class="rooms-card">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="rooms-title"><i class="fa fa-bed me-2 text-success"></i>Manage Rooms</div>
        <a href="admin_dashboard.php" class="btn btn-outline-secondary back-btn"><i class="fa fa-arrow-left me-1"></i> Back to Dashboard</a>
    </div>
    <!-- Add New Room Form -->
    <div class="card mb-4">
        <div class="card-header bg-light fw-bold"><i class="fa fa-plus-circle me-1 text-primary"></i>Add New Room</div>
        <div class="card-body">
            <form method="post" class="row g-3 align-items-end" enctype="multipart/form-data">
                <div class="col-md-3">
                    <label class="form-label">Name:</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Description:</label>
                    <textarea name="description" class="form-control" required></textarea>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Price:</label>
                    <input type="number" name="price" class="form-control" required>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Status:</label>
                    <select name="status" class="form-select">
                        <option value="available">Available</option>
                        <option value="unavailable">Unavailable</option>
                    </select>
                </div>
                <div class="col-md-1">
                    <label class="form-label">Image:</label>
                    <input type="file" name="image" class="form-control form-control-sm" accept="image/*">
                </div>
                <div class="col-12 d-grid">
                    <button type="submit" name="add_room" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Rooms Table with inline edit -->
    <div class="table-responsive">
        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <form method="post" enctype="multipart/form-data">
                        <td><?php echo $row['id']; ?></td>
                        <td>
                            <?php if (!empty($row['image_path'])): ?>
                                <img src="uploads/<?php echo htmlspecialchars($row['image_path']); ?>" class="room-img-thumb" alt="Room image">
                            <?php else: ?>
                                <span class="text-muted">No image</span>
                            <?php endif; ?>
                            <input type="file" name="image" class="form-control form-control-sm mt-1" accept="image/*">
                            <input type="hidden" name="old_image" value="<?php echo htmlspecialchars($row['image_path']); ?>">
                        </td>
                        <td><input type="text" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" class="form-control form-control-sm" required></td>
                        <td><textarea name="description" class="form-control form-control-sm" required><?php echo htmlspecialchars($row['description']); ?></textarea></td>
                        <td><input type="number" name="price" value="<?php echo $row['price']; ?>" class="form-control form-control-sm" required></td>
                        <td>
                            <select name="status" class="form-select form-select-sm">
                                <option value="available" <?php if($row['status']=='available') echo 'selected'; ?>>Available</option>
                                <option value="unavailable" <?php if($row['status']=='unavailable') echo 'selected'; ?>>Unavailable</option>
                            </select>
                            <span class="badge <?php echo ($row['status']=='available') ? 'badge-available' : 'badge-unavailable'; ?> ms-2">
                                <?php echo ucfirst($row['status']); ?>
                            </span>
                        </td>
                        <td>
                            <input type="hidden" name="room_id" value="<?php echo $row['id']; ?>">
                            <button type="submit" name="update_room" class="btn btn-update btn-action"><i class="fa fa-save"></i> Update</button>
                            <a href="manage_rooms.php?delete=<?php echo $row['id']; ?>" class="btn btn-delete btn-action" onclick="return confirm('Delete this room?');"><i class="fa fa-trash"></i> Delete</a>
                        </td>
                    </form>
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
