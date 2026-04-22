<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'club_admin') {
    header("Location: login.html");
    exit();
}

$conn = new mysqli("localhost","root","","event_management");
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
.request-card{
  padding:1.2rem;
  border:1px solid var(--border-color);
  border-radius:12px;
  background:rgba(255,255,255,0.03);
}

.action-btns{
  margin-top:1rem;
}

.primary-btn{
  background:#ef4444;
  color:#fff;
  padding:10px 16px;
  border-radius:8px;
  text-decoration:none;
  display:inline-block;
}
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

    <!-- ONLY FEATURE -->
    <section class="glass-card">

      <h2 style="margin-bottom:1rem;">
        <i class="fas fa-user-check" style="color:var(--primary);"></i>
        Attendance System
      </h2>

      <div class="request-card">

        <p style="color:var(--text-muted);">
          Upload student CSV and send attendance request to faculty for approval.
        </p>

        <div class="action-btns">
          <a href="club_admin_send_request.php" class="primary-btn">
            + Create Attendance Request
          </a>
        </div>

      </div>

    </section>

  </div>

  <!-- RIGHT COLUMN -->
 <section class="glass-card">

  <h2 style="margin-bottom:1rem;">
    <i class="fas fa-info-circle" style="color:var(--primary);"></i>
    Help
  </h2>

  <p style="color:var(--text-muted); font-size:0.9rem;">
    Need help? Click below to understand how attendance requests work.
  </p>

  <button onclick="toggleHelp()" style="
    margin-top:10px;
    padding:8px 12px;
    border:none;
    border-radius:8px;
    background:#1e293b;
    color:#fff;
    cursor:pointer;
  ">
    View Steps
  </button>

  <!-- HIDDEN HELP -->
  <div id="helpBox" style="
    display:none;
    margin-top:10px;
    font-size:0.85rem;
    color:var(--text-muted);
    line-height:1.6;
  ">
    1. Upload student CSV<br>
    2. Assign faculty<br>
    3. Faculty approves request<br>
    4. Attendance process starts
  </div>

</section>
<script>
function toggleHelp() {
  let box = document.getElementById("helpBox");
  box.style.display = box.style.display === "none" ? "block" : "none";
}
</script>

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