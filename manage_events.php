<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'club_admin') {
    header("Location: login.html");
    exit();
}

$conn = new mysqli("localhost","root","","event_management");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// DELETE EVENT
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM events WHERE id=$id");
    header("Location: manage_events.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Events | CDG</title>

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

  <!-- SIDEBAR SAME AS DASHBOARD -->
  <aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
      <img src="assets/club_dash_pic.jpeg" alt="Profile"
        onerror="this.src='https://ui-avatars.com/api/?name=<?php echo $_SESSION['name']; ?>&background=f59e0b&color=fff'">
      <h3><?php echo htmlspecialchars($_SESSION['name']); ?></h3>
      <p style="font-size: 0.8rem; color: var(--text-muted);">Club Administrator</p>
    </div>

    <nav class="sidebar-nav">
      <a href="clubhead_dashboard.php" class="nav-link"><i class="fas fa-home"></i> Dashboard</a>
      <a href="clubhead_dashboard.php" class="nav-link"><i class="fas fa-plus-circle"></i> Create Event</a>
      <a href="manage_events.php" class="nav-link active"><i class="fas fa-edit"></i> Manage Events</a>
      <a href="#" class="nav-link"><i class="fas fa-users"></i> Registrations</a>
      <a href="#" class="nav-link"><i class="fas fa-tools"></i> Equipment</a>
      <a href="#" class="nav-link"><i class="fas fa-question-circle"></i> Queries</a>
    </nav>

    <div class="sidebar-footer">
      <form action="logout.php" method="post">
        <button type="submit" class="btn btn-outline" style="width: 100%; border-color: #ef4444; color: #ef4444;">
          <i class="fas fa-sign-out-alt"></i> Logout
        </button>
      </form>
    </div>
  </aside>

  <!-- MAIN CONTENT -->
  <main class="main-content">

    <header class="content-header">
      <h1>Manage Events 🎯</h1>
      <p>View and manage all your created events</p>
    </header>

    <section class="glass-card">

      <h2 style="margin-bottom: 1.5rem;">
        <i class="fas fa-calendar-alt" style="color: var(--primary);"></i> Event List
      </h2>

      <div style="overflow-x:auto;">
        <table style="width:100%; border-collapse: collapse;">

          <tr style="background: var(--surface-dark);">
            <th style="padding:10px;">ID</th>
            <th>Name</th>
            <th>Date</th>
            <th>Venue</th>
            <th>Description</th>
            <th>Action</th>
          </tr>

          <?php
          $result = $conn->query("SELECT * FROM events ORDER BY id DESC");

          if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
          ?>
          <tr style="border-bottom: 1px solid var(--border-color);">
            <td style="padding:10px;"><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['event_date']; ?></td>
            <td><?php echo $row['venue']; ?></td>
            <td><?php echo $row['description']; ?></td>
            <td style="display:flex; gap:6px;">
  <a href="edit_event.php?id=<?php echo $row['id']; ?>" 
     class="btn"
     style="background:#3b82f6; color:white; padding:6px 12px; border-radius:6px;">
     Edit
  </a>

  <a href="manage_events.php?delete=<?php echo $row['id']; ?>" 
     onclick="return confirm('Delete this event?')"
     class="btn"
     style="background:#ef4444; color:white; padding:6px 12px; border-radius:6px;">
     Delete
  </a>
</td>
          </tr>
          <?php
              }
          } else {
              echo "<tr><td colspan='6' style='text-align:center; padding:1rem;'>No events found</td></tr>";
          }
          ?>

        </table>
      </div>

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