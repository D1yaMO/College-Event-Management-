<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'faculty') {
    header("Location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Faculty Dashboard | CDG</title>
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
  <aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
      <img src="assets/fac_dash_profile_pic.webp" alt="Profile" onerror="this.src='https://ui-avatars.com/api/?name=<?php echo $_SESSION['name']; ?>&background=f59e0b&color=fff'">
      <h3><?php echo htmlspecialchars($_SESSION['name']); ?></h3>
      <p style="font-size: 0.8rem; color: var(--text-muted);">Faculty Portal</p>
    </div>
    
    <nav class="sidebar-nav">
      <a href="camp_req.php" class="nav-link">
        <i class="fas fa-clipboard-list"></i> Campaign Requests
      </a>
      <a href="ongoing_event.php" class="nav-link">
        <i class="fas fa-play-circle"></i> Ongoing Events
      </a>
      <a href="upcoming_event.php" class="nav-link">
        <i class="fas fa-calendar-alt"></i> Upcoming Events
      </a>
      <a href="student_details.php" class="nav-link">
        <i class="fas fa-user-graduate"></i> Student Details
      </a>
      <a href="message_students.php" class="nav-link">
        <i class="fas fa-comment-dots"></i> Message Students
      </a>
      <a href="mark_attendance.php" class="nav-link">
        <i class="fas fa-user-check"></i> Mark Attendance
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

  <main class="main-content">
    <header class="content-header">
      <h1>Faculty Control Panel</h1>
      <p>Oversee events, monitor student participation, and manage academic activities.</p>
    </header>

    <section class="stats-grid">
      <div class="glass-card stat-card">
        <span class="value">8</span>
        <span class="label">Active Requests</span>
      </div>
      <div class="glass-card stat-card">
        <span class="value">3</span>
        <span class="label">Ongoing Events</span>
      </div>
      <div class="glass-card stat-card">
        <span class="value">450+</span>
        <span class="label">Total Students</span>
      </div>
      <div class="glass-card stat-card">
        <span class="value">12</span>
        <span class="label">Reports Pending</span>
      </div>
    </section>

    <section class="dash-grid">
      <a href="camp_req.php" class="glass-card dash-item">
        <i class="fas fa-bullhorn"></i>
        <h3>Campaigns</h3>
        <p style="font-size: 0.85rem; color: var(--text-muted);">Approve/Reject requests</p>
      </a>
      <a href="ongoing_event.php" class="glass-card dash-item">
        <i class="fas fa-tasks"></i>
        <h3>Monitor Events</h3>
        <p style="font-size: 0.85rem; color: var(--text-muted);">Real-time event tracking</p>
      </a>
      <a href="student_details.php" class="glass-card dash-item">
        <i class="fas fa-users-cog"></i>
        <h3>Student Database</h3>
        <p style="font-size: 0.85rem; color: var(--text-muted);">View student profiles & history</p>
      </a>
      <a href="message_students.php" class="glass-card dash-item">
        <i class="fas fa-paper-plane"></i>
        <h3>Broadcast</h3>
        <p style="font-size: 0.85rem; color: var(--text-muted);">Send important notifications</p>
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
