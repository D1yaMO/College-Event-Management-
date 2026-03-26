<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'student') {
    header("Location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Dashboard | CDG</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/globals.css">
  <link rel="stylesheet" href="assets/dashboard.css">
</head>
<body>

<button class="menu-toggle" onclick="toggleMenu()">
  <i class="fas fa-bars"></i>
</button>

<div class="dashboard-container">
  <!-- Sidebar -->
  <aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
      <img src="assets/student.png" alt="Profile" onerror="this.src='https://ui-avatars.com/api/?name=<?php echo $_SESSION['name']; ?>&background=f59e0b&color=fff'">
      <h3><?php echo htmlspecialchars($_SESSION['name']); ?></h3>
      <p style="font-size: 0.8rem; color: var(--text-muted);">Student ID: #12345</p>
    </div>
    
    <nav class="sidebar-nav">
      <a href="student_profile.php" class="nav-link">
        <i class="fas fa-user-circle"></i> Profile
      </a>
      <a href="notifications.php" class="nav-link">
        <i class="fas fa-bell"></i> Notifications
      </a>
      <a href="attendance.php" class="nav-link">
        <i class="fas fa-calendar-check"></i> Attendance
      </a>
      <a href="achievements.php" class="nav-link">
        <i class="fas fa-award"></i> Achievements
      </a>
      <a href="request_faculty.php" class="nav-link">
        <i class="fas fa-user-shield"></i> Faculty Access
      </a>
    </nav>

    <div class="sidebar-footer">
      <form action="logout.php" method="post">
        <button type="submit" class="btn btn-outline" style="width: 100%; border-color: #ef4444; color: #ef4444;">
          <i class="fas fa-sign-out-alt"></i> Logout
        </button>
      </form>
    </div>
  </aside>

  <!-- Main Content -->
  <main class="main-content">
    <header class="content-header">
      <h1>Welcome back, <?php echo explode(' ', $_SESSION['name'])[0]; ?>! 👋</h1>
      <p>Here's what's happening in your campus today.</p>
    </header>

    <!-- Stats -->
    <section class="stats-grid">
      <div class="glass-card stat-card">
        <span class="value">12</span>
        <span class="label">Total Events</span>
      </div>
      <div class="glass-card stat-card">
        <span class="value">5</span>
        <span class="label">Registered</span>
      </div>
      <div class="glass-card stat-card">
        <span class="value">4</span>
        <span class="label">Attended</span>
      </div>
      <div class="glass-card stat-card">
        <span class="value">2</span>
        <span class="label">Achievements</span>
      </div>
    </section>

    <!-- Quick Access Grid -->
    <section class="dash-grid">
      <a href="std_dash_club.html" class="glass-card dash-item">
        <i class="fas fa-users"></i>
        <h3>Clubs</h3>
        <p style="font-size: 0.85rem; color: var(--text-muted);">Join technical & cultural groups</p>
      </a>
      <a href="std_dash_upcoming_event.html" class="glass-card dash-item">
        <i class="fas fa-calendar-alt"></i>
        <h3>Upcoming</h3>
        <p style="font-size: 0.85rem; color: var(--text-muted);">Don't miss out on latest events</p>
      </a>
      <a href="std_dash_event_recap.html" class="glass-card dash-item">
        <i class="fas fa-film"></i>
        <h3>Event Recap</h3>
        <p style="font-size: 0.85rem; color: var(--text-muted);">Relive the memories</p>
      </a>
      <a href="std_dash_my_reg.html" class="glass-card dash-item">
        <i class="fas fa-check-double"></i>
        <h3>My Events</h3>
        <p style="font-size: 0.85rem; color: var(--text-muted);">Your registered activities</p>
      </a>
      <a href="qr_checkin.html" class="glass-card dash-item">
        <i class="fas fa-qrcode"></i>
        <h3>QR Check-in</h3>
        <p style="font-size: 0.85rem; color: var(--text-muted);">Quick entry to venues</p>
      </a>
      <a href="venue_navigation.html" class="glass-card dash-item">
        <i class="fas fa-map-marked-alt"></i>
        <h3>Navigation</h3>
        <p style="font-size: 0.85rem; color: var(--text-muted);">Find your way around</p>
      </a>
    </section>
  </main>
</div>

<script>
  function toggleMenu() {
    document.getElementById('sidebar').classList.toggle('active');
  }
</script>

</body>
</html>
