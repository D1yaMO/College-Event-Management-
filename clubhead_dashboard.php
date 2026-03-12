<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'club_admin') {
    header("Location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Club Head Dashboard</title>
  <style>
    :root {
      --primary: #ffa500;
      --secondary: #6e2f3a;
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
      background: url('assets/club_dash_pic.jpeg') no-repeat center center fixed;
      background-size: cover;
      color: var(--text-light);
    }

    .wrapper {
      display: flex;
      min-height: 100vh;
    }

    /* ────────────────  SIDEBAR  ──────────────── */
    .sidebar {
      width: 260px;
      background: rgba(0, 0, 0, 0.88);
      padding: 30px 20px;
      position: fixed;
      top: 0;
      left: 0;
      height: 100%;
      box-shadow: 2px 0 15px rgba(0,0,0,0.5);
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      z-index: 1000;
      transition: transform 0.35s ease;
    }

    .sidebar .top {
      text-align: center;
    }

    .sidebar img {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      border: 3px solid var(--primary);
      margin-bottom: 10px;
    }

    .sidebar h2 {
      margin-bottom: 30px;
      font-size: 20px;
    }

    .sidebar .nav a {
      text-decoration: none;
      color: var(--text-light);
      padding: 14px 15px;
      display: block;
      margin: 10px 0;
      border-radius: 6px;
      background-color: rgba(189, 133, 28, 0.08);
      transition: all 0.25s;
    }

    .sidebar .nav a:hover {
      background-color: var(--hover-bg);
      transform: translateX(6px);
    }

    .logout-btn {
      margin-top: 40px;
      background-color: var(--primary);
      color: white;
      font-weight: bold;
      text-align: center;
      padding: 14px;
      border-radius: 6px;
      text-decoration: none;
      transition: 0.3s;
    }

    .logout-btn:hover {
      background-color: var(--hover-bg);
    }

    /* ────────────────  MENU BUTTON (mobile only) ──────────────── */
    .menu-toggle {
      position: fixed;
      top: 20px;
      left: 20px;
      z-index: 1100;
      background: rgba(0,0,0,0.6);
      color: white;
      border: none;
      width: 50px;
      height: 50px;
      border-radius: 50%;
      font-size: 28px;
      cursor: pointer;
      display: none;               /* hidden on desktop */
      align-items: center;
      justify-content: center;
      transition: all 0.3s;
      box-shadow: 0 2px 10px rgba(0,0,0,0.4);
    }

    .menu-toggle:hover {
      background: var(--primary);
      transform: scale(1.08);
    }

    /* ────────────────  MAIN CONTENT  ──────────────── */
    .main-content {
      flex: 1;
      padding: 40px;
      padding-left: 300px;          /* space for fixed sidebar */
      transition: padding-left 0.35s ease;
    }

    .main-content h1 {
      margin-bottom: 35px;
      color: var(--primary);
      font-size: 34px;
    }

    .card {
      background: rgba(255, 255, 255, 0.09);
      border-radius: 12px;
      padding: 28px;
      margin-bottom: 24px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.35);
      transition: transform 0.25s, box-shadow 0.25s;
    }

    .card:hover {
      transform: translateY(-4px);
      box-shadow: 0 8px 30px rgba(0,0,0,0.45);
    }

    .card h2 {
      color: var(--primary);
      margin-bottom: 16px;
    }

    .form-group {
      margin-bottom: 18px;
    }

    label {
      display: block;
      margin-bottom: 6px;
      font-weight: 500;
    }

    input[type="text"], textarea {
      width: 100%;
      padding: 12px;
      border-radius: 6px;
      border: 1px solid #aaa;
      background: rgba(255,255,255,0.12);
      color: white;
      resize: vertical;
    }

    input::placeholder, textarea::placeholder {
      color: rgba(255,255,255,0.6);
    }

    button {
      background-color: var(--primary);
      color: white;
      padding: 12px 22px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-weight: bold;
      transition: background 0.3s, transform 0.2s;
    }

    button:hover {
      background-color: var(--hover-bg);
      transform: translateY(-2px);
    }

    ul {
      padding-left: 24px;
      line-height: 1.7;
    }

    /* ────────────────  MOBILE ──────────────── */
    @media (max-width: 768px) {
      .sidebar {
        transform: translateX(-100%);
      }
      .sidebar.active {
        transform: translateX(0);
      }
      .main-content {
        padding: 20px;
        padding-left: 20px;
        padding-top: 90px;
      }
      .menu-toggle {
        display: flex;
      }
    }
  </style>
</head>
<body>

  <!-- Menu Button – only visible on mobile -->
  <button class="menu-toggle" onclick="toggleSidebar()">☰</button>

  <div class="wrapper">

    <!-- Left Sidebar – always visible on desktop -->
    <div class="sidebar" id="sidebar">
      <div class="top">
        <img src="assets/fac_dash_profile_pic" alt="Club Head">
        <h2><?php echo htmlspecialchars($_SESSION['name']); ?></h2>
      </div>
      <div class="nav">
        <a href="#">Dashboard</a>
        <a href="Cevent.html">Approve/Reject Events</a>
        <a href="#messages">View Student Messages</a>
        <a href="#">Notifications</a>
        <a href="#">Profile</a>
        <a href="logout.php" class="logout-btn">Logout</a>
      </div>
    </div>

    <!-- Main Area -->
    <div class="main-content">
      <h1>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?>!</h1>

      <div class="card">
        <h2>Upcoming Events</h2>
        <ul>
          <li>Tech Fest - April 20, 2025</li>
          <li>AI Workshop - April 25, 2025</li>
        </ul>
      </div>

      <div class="card" id="approval">
        <h2>Approve / Reject Event</h2>
        <form id="approvalForm">
          <div class="form-group">
            <label for="eventName">Event Name</label>
            <input type="text" id="eventName" placeholder="Enter event name">
          </div>
          <div class="form-group">
            <label for="studentName">Requested by</label>
            <input type="text" id="studentName" placeholder="Student name">
          </div>
          <div class="form-group">
            <label for="remarks">Remarks</label>
            <textarea id="remarks" rows="3" placeholder="Any comments..."></textarea>
          </div>
          <button type="button" onclick="submitDecision('approved')">Approve</button>
          <button type="button" onclick="submitDecision('rejected')" style="margin-left: 12px; background-color: crimson;">Reject</button>
        </form>
      </div>

      <div class="card" id="messages">
        <h2>Student Event Queries</h2>
        <ul>
          <li><strong>Ajay:</strong> Can you confirm the timings for Tech Fest?</li>
          <li><strong>Sneha:</strong> Is there any registration fee for AI Workshop?</li>
          <li><strong>Rahul:</strong> Can I volunteer for organizing events?</li>
        </ul>
      </div>
    </div>
  </div>

  <script>
    function toggleSidebar() {
      document.getElementById("sidebar").classList.toggle("active");
    }

    function submitDecision(status) {
      const event = document.getElementById("eventName").value;
      const student = document.getElementById("studentName").value;
      const remarks = document.getElementById("remarks").value;

      if (!event || !student) {
        alert("Please fill in event name and student name.");
        return;
      }

      alert(`Event "${event}" by ${student} has been ${status}.\nRemarks: ${remarks}`);
      document.getElementById("approvalForm").reset();
    }

    // Close sidebar on outside click (mobile)
    document.addEventListener('click', function(event) {
      const sidebar = document.getElementById("sidebar");
      const menuBtn = document.querySelector(".menu-toggle");
      if (window.innerWidth <= 768 &&
          !sidebar.contains(event.target) && 
          !menuBtn.contains(event.target)) {
        sidebar.classList.remove("active");
      }
    });
  </script>

</body>
</html>