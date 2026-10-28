<?php
// Navbar for San Andres Residences (exact copy from index.php)
?>
<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="navbar-brand d-flex align-items-center">
    <img src="images/logorealnobg.png" alt="Alacrity Auberge Logo">
    <span class="brand-text ms-2">
      <span class="brand-title">ALACRITY</span>
      <span class="brand-subtitle">AUBERGE</span>
    </span>
  </div>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="mainNavbar">
    <div class="navbar-center navbar-nav mx-auto">
      <ul class="navbar-nav ms-4 mb-2 mb-lg-0">
          <li class="nav-item">
              <a class="nav-link<?php if(basename($_SERVER['PHP_SELF'])=='index.php') echo ' active'; ?>" href="index.php"><i class="fa fa-home"></i> Home</a>
          </li>
          <li class="nav-item">
              <a class="nav-link<?php if(basename($_SERVER['PHP_SELF'])=='rooms.php') echo ' active'; ?>" href="rooms.php"><i class="fa fa-bed"></i> Rooms</a>
          </li>
          <li class="nav-item">
              <a class="nav-link<?php if(basename($_SERVER['PHP_SELF'])=='location.php') echo ' active'; ?>" href="location.php">Location</a>
          </li>
          <li class="nav-item">
              <a class="nav-link<?php if(basename($_SERVER['PHP_SELF'])=='guest_services.php') echo ' active'; ?>" href="guest_services.php"><i class="fa fa-concierge-bell"></i> Guest Services & Facilities</a>
          </li>
          <li class="nav-item">
              <a class="nav-link<?php if(basename($_SERVER['PHP_SELF'])=='gallery.php') echo ' active'; ?>" href="gallery.php"><i class="fa fa-images"></i> Gallery</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="the_hotel.php"><i class="fa fa-hotel"></i> The Hotel</a>
          </li>
      </ul>
    </div>
    <div class="navbar-right ms-lg-3 d-flex align-items-center">
      <?php if (isset($_SESSION['user_id'])): ?>
        <?php if ($_SESSION['role'] === 'admin'): ?>
          <a class="nav-link" href="admin_dashboard.php">Dashboard</a>
        <?php else: ?>
          <a class="nav-link" href="user_dashboard.php">Dashboard</a>
        <?php endif; ?>
        <a class="nav-link" href="logout.php">Logout</a>
      <?php else: ?>
        <a class="nav-link" href="login.php">Login</a>
        <a class="nav-link" href="register.php">Register</a>
      <?php endif; ?>
    </div>
  </div>
</nav> 