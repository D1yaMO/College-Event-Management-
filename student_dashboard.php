<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Student Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
  <style>
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background: url('assets/std_dash_pic.jpeg') no-repeat center center fixed;
      background-size: cover;
      color: white;
    }

    .overlay {
      background-color: rgba(0, 0, 0, 0.7);
      min-height: 100vh;
      padding: 40px;
    }

    h1 {
      text-align: center;
      margin-bottom: 20px;
    }

    .logout {
      text-align: center;
      margin-bottom: 40px;
    }

    .logout button {
      padding: 12px 24px;
      background-color: orange;
      color: white;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
      font-weight: bold;
      box-shadow: 0 4px 10px rgba(255, 165, 0, 0.4);
      transition: background 0.3s ease, transform 0.2s ease;
    }

    .logout button:hover {
      background-color: darkorange;
      transform: scale(1.05);
    }

    .nav-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 24px;
      max-width: 1100px;
      margin: auto;
    }

    .nav-item {
      background: rgba(255, 255, 255, 0.15);
      padding: 30px;
      border-radius: 12px;
      text-align: center;
      text-decoration: none;
      color: white;
      font-size: 18px;
      font-weight: 500;
      box-shadow: 0 6px 14px rgba(0, 0, 0, 0.4);
      border: 1px solid rgba(255, 255, 255, 0.3);
      backdrop-filter: blur(3px);
      transition: 0.3s;
    }

    .nav-item:hover {
      background: rgba(255, 255, 255, 0.25);
      transform: translateY(-5px) scale(1.03);
    }
  </style>
</head>
<body>
  <div class="overlay">
    <h1>Welcome, <?php echo $_SESSION['name']; ?>!</h1>

    <div class="logout">
      <form action="logout.php" method="post">
        <button type="submit">Logout</button>
      </form>
    </div>

    <div class="nav-grid">
     <a class="nav-item" href="std_dash_club.html">Clubs</a>
     <a class="nav-item" href="std_dash_event_recap.html">Event Recap</a>
      <a class="nav-item" href="std_dash_upcoming_event.html">Upcoming Events</a>
      <a class="nav-item" href="std_dash_my_reg.html">My Registered Events</a>
      <a class="nav-item" href="#">Attendance</a>
      <a class="nav-item" href="#">Notifications</a>
      <a class="nav-item" href="#">Event Enquiry</a>
      <a class="nav-item" href="#">QR Check-in</a>
      <a class="nav-item" href="#">Achievements</a>
      <a class="nav-item" href="#">Live Stream</a>
      <a class="nav-item" href="#">Feedback</a>
      <a class="nav-item" href="#">Venue Navigation</a>
      <a class="nav-item" href="#">Profile Settings</a>
      <a class="nav-item" href="#">Help Desk</a>
     <a class="nav-item" href="https://mvjce.edu.in/" target="_blank">About College</a>

    </div>
  </div>
</body>
</html>
