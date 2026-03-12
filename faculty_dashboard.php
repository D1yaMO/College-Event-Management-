<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'faculty') {
    header("Location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Faculty Dashboard</title>
  <style>
    :root {
      --primary: #ffa500;
      --hover-bg: #e67300;
      --text-light: #fff;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', sans-serif;
    }

    body {
      min-height: 100vh;
      background: url('assets/fac_dash_pic.jpeg') no-repeat center center fixed;
      background-size: cover;
      color: var(--text-light);
    }

    /* Menu icon – always visible in top-left */
    .menu-toggle {
      position: fixed;
      top: 15px;
      left: 15px;
      z-index: 1500;
      background: rgba(0,0,0,0.7);
      color: white;
      border: none;
      width: 52px;
      height: 52px;
      border-radius: 50%;
      font-size: 28px;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 3px 12px rgba(0,0,0,0.5);
      transition: all 0.25s;
    }

    .menu-toggle:hover {
      background: var(--primary);
      transform: scale(1.08);
    }

    .menu-toggle.active {
      background: var(--primary);
    }

    /* Wrapper */
    .wrapper {
      display: flex;
      min-height: 100vh;
    }

    /* Sidebar – starts hidden */
    .sidebar {
      width: 280px;
      background: rgba(0, 0, 0, 0.92);
      padding: 90px 20px 30px;
      position: fixed;
      top: 0;
      left: 0;
      height: 100%;
      box-shadow: 4px 0 20px rgba(0,0,0,0.6);
      transform: translateX(-100%);           /* hidden by default */
      transition: transform 0.35s ease;
      z-index: 1400;
      display: flex;
      flex-direction: column;
    }

    .sidebar.active {
      transform: translateX(0);               /* shown when active */
    }

    .sidebar .top {
      text-align: center;
      margin-bottom: 40px;
    }

    .sidebar img {
      width: 90px;
      height: 90px;
      border-radius: 50%;
      border: 3px solid var(--primary);
      margin-bottom: 16px;
    }

    .sidebar h2 {
      font-size: 21px;
    }

    .sidebar .nav a {
      color: var(--text-light);
      text-decoration: none;
      padding: 14px 18px;
      display: block;
      margin: 8px 0;
      border-radius: 8px;
      background: rgba(255,165,0,0.07);
      transition: all 0.25s;
    }

    .sidebar .nav a:hover {
      background: var(--hover-bg);
      transform: translateX(6px);
    }

    .logout-btn {
      margin-top: auto;
      background: var(--primary);
      color: white;
      font-weight: bold;
      text-align: center;
      padding: 14px;
      border-radius: 8px;
      text-decoration: none;
      transition: 0.3s;
    }

    .logout-btn:hover {
      background: var(--hover-bg);
    }

    /* Main content – full width when menu is closed */
    .main-content {
      flex: 1;
      padding: 40px;
      padding-left: 90px;                    /* space for menu icon */
      transition: padding-left 0.4s ease;
      min-height: 100vh;
    }

    .sidebar.active ~ .main-content {
      padding-left: 320px;                   /* push content when menu open */
    }

    .main-content h1 {
      color: var(--primary);
      margin-bottom: 40px;
      font-size: 36px;
    }

    .card {
      background: rgba(255, 255, 255, 0.09);
      border-radius: 12px;
      padding: 28px;
      margin-bottom: 30px;
      box-shadow: 0 5px 20px rgba(0,0,0,0.4);
      transition: all 0.3s;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 30px rgba(0,0,0,0.45);
    }

    .card h3 {
      color: var(--primary);
      margin-bottom: 16px;
    }

    .card p {
      font-size: 16.5px;
      color: #f5e9d0;
    }

    /* Overlay when menu is open (optional - dims background) */
    .overlay {
      position: fixed;
      inset: 0;
      background: rgba(0,0,0,0.5);
      opacity: 0;
      visibility: hidden;
      transition: all 0.35s;
      z-index: 1300;
      pointer-events: none;
    }

    .sidebar.active ~ .overlay {
      opacity: 1;
      visibility: visible;
      pointer-events: all;
    }
  </style>
</head>
<body>

  <!-- Menu icon -->
  <button class="menu-toggle" id="menuBtn" onclick="toggleSidebar()">☰</button>

  <!-- Dim overlay when menu open -->
  <div class="overlay" id="overlay" onclick="closeSidebar()"></div>

  <div class="wrapper">

    <!-- Sidebar (hidden until toggled) -->
    <div class="sidebar" id="sidebar">
      <div class="top">
        <img src="assets/fac_dash_profile_pic" alt="Profile">
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?></h2>
      </div>
      <div class="nav">
        <a href="camp_req.html">Accept Campaign Requests</a>
        <a href="ongoing_event.html">View Ongoing Events</a>
        <a href="#">Upcoming Events</a>
        <a href="#">Student Details</a>
        <a href="#">Message Students</a>
        <a href="logout.php" class="logout-btn">Logout</a>
      </div>
    </div>

    <!-- Main content -->
    <div class="main-content">
      <h1>Faculty Dashboard</h1>

      <div class="card">
        <h3>Pending Campaign Requests</h3>
        <p>You have 2 campaign requests to review.</p>
      </div>

      <div class="card">
        <h3>Ongoing Events</h3>
        <p>3 events are currently active.</p>
      </div>

      <div class="card">
        <h3>Student Participation</h3>
        <p>Check who’s attending which events.</p>
      </div>

      <div class="card">
        <h3>Announcements</h3>
        <p>Send messages or reminders to all students.</p>
      </div>
    </div>
  </div>

  <script>
    const sidebar = document.getElementById('sidebar');
    const menuBtn = document.getElementById('menuBtn');
    const overlay = document.getElementById('overlay');

    function toggleSidebar() {
      sidebar.classList.toggle('active');
      menuBtn.classList.toggle('active');
      overlay.classList.toggle('active'); // optional dim
    }

    function closeSidebar() {
      sidebar.classList.remove('active');
      menuBtn.classList.remove('active');
      overlay.classList.remove('active');
    }

    // Close when clicking outside
    document.addEventListener('click', function(e) {
      if (!sidebar.contains(e.target) && 
          !menuBtn.contains(e.target) && 
          !overlay.contains(e.target)) {
        closeSidebar();
      }
    });

    // Optional: close with Esc key
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') {
        closeSidebar();
      }
    });
  </script>

</body>
</html>