<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'club_admin') {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Club Admin Dashboard | CDG</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<link rel="stylesheet" href="assets/globals.css">
<link rel="stylesheet" href="assets/dashboard.css">

<style>
.request-card {
  margin-bottom: 1rem;
  padding: 1rem;
  border: 1px solid var(--border-color);
  border-radius: 8px;
}
.action-btns {
  display: flex;
  gap: 0.5rem;
  margin-top: 1rem;
}
.approve-btn { background: #10b981; }
.reject-btn { background: #ef4444; }
</style>

</head>

<body>

<button class="menu-toggle" onclick="toggleMenu()">
  <i class="fas fa-bars"></i>
</button>

<div class="dashboard-container">

 <?php include 'sidebar.php'; ?>
  <!-- MAIN CONTENT -->
  <main class="main-content">

    <header class="content-header">
      <h1>Welcome, <?php echo $_SESSION['name']; ?> 👋</h1>
      <p>Manage your club activities from one central hub.</p>
    </header>

    <div style="display:grid; grid-template-columns:2fr 1.2fr; gap:2rem;">

      <!-- LEFT COLUMN -->
      <div class="left-col">

        <section class="glass-card">

          <h2 style="margin-bottom:1.5rem;">
            <i class="fas fa-user-shield" style="color:var(--primary);"></i>
            Faculty Requests
          </h2>

          <?php
          $conn = new mysqli("localhost","root","","event_management");

          if ($conn->connect_error) {
              echo "<p style='color:red;'>Connection failed</p>";
          } else {

              $result = $conn->query("SELECT * FROM faculty_requests WHERE status='pending'");

              if ($result && $result->num_rows > 0) {

                  while ($row = $result->fetch_assoc()) {
          ?>

          <div class="request-card">
            <p><strong><?php echo $row['name']; ?></strong>
            (<?php echo $row['email']; ?>)</p>

            <div class="action-btns">
              <a href="approve_faculty.php?id=<?php echo $row['user_id']; ?>"
                 class="btn approve-btn">Approve</a>

              <a href="reject_faculty.php?id=<?php echo $row['user_id']; ?>"
                 class="btn reject-btn">Reject</a>
            </div>
          </div>

          <?php
                  }

              } else {
                  echo "<p style='color:var(--text-muted);'>No pending requests</p>";
              }

              $conn->close();
          }
          ?>

        </section>

      </div>

      <!-- RIGHT COLUMN -->
      <div class="right-col">

        <section class="glass-card">

          <h2 style="margin-bottom:1.5rem;">
            <i class="fas fa-bolt" style="color:var(--primary);"></i>
            Quick Info
          </h2>

          <p style="color:var(--text-muted);">
            Welcome to your admin dashboard. Use the sidebar to manage events,
            registrations, and equipment requests.
          </p>

        </section>

      </div>

    </div>

  </main>

</div>

<script>
function toggleMenu() {
  document.getElementById('sidebar').classList.toggle('active');
}
</script>

</body>
</html>