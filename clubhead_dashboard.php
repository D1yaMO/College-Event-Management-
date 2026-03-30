<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'club_admin') {
    header("Location: login.html");
    exit();
}

//(event creation)
$conn2 = new mysqli("localhost","root","","event_management");

if ($conn2->connect_error) {
    die("Connection failed: " . $conn2->connect_error);
}

if (isset($_POST['create_event'])) {
    $name = $_POST['event_name'];
    $date = $_POST['event_date'];
    $venue = $_POST['venue'];
    $desc = $_POST['description'];
    $user = $_SESSION['name'];

    $sql = "INSERT INTO events (name, event_date, venue, description, created_by) 
            VALUES ('$name', '$date', '$venue', '$desc', '$user')";

    if ($conn2->query($sql) === TRUE) {
        echo "<script>alert('Event created successfully!');</script>";
    } else {
        echo "Error: " . $conn2->error;
    }
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
  <aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
      <img src="assets/club_dash_pic.jpeg" alt="Profile" onerror="this.src='https://ui-avatars.com/api/?name=<?php echo $_SESSION['name']; ?>&background=f59e0b&color=fff'">
      <h3><?php echo htmlspecialchars($_SESSION['name']); ?></h3>
      <p style="font-size: 0.8rem; color: var(--text-muted);">Club Administrator</p>
    </div>
    
    <nav class="sidebar-nav">
      <a href="#" class="nav-link active"><i class="fas fa-home"></i> Dashboard</a>
      <a href="#" class="nav-link"><i class="fas fa-plus-circle"></i> Create Event</a>
      <a href="manage_events.php" class="nav-link"><i class="fas fa-edit"></i> Manage Events</a>
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

  <main class="main-content">
    <header class="content-header">
      <h1>Welcome, <?php echo $_SESSION['name']; ?> 👋</h1>
      <p>Manage your club activities and event requests from one central hub.</p>
    </header>

    <div style="display: grid; grid-template-columns: 2fr 1.2fr; gap: 2rem;">
      
      <div class="left-col">

        <!-- Faculty Requests -->
        <section class="glass-card" style="margin-bottom: 2rem;">
          <h2 style="margin-bottom: 1.5rem;"><i class="fas fa-user-shield" style="color: var(--primary);"></i> Faculty Requests</h2>

          <?php
          $conn = new mysqli("localhost","root","","event_management");
          if ($conn->connect_error) {
              echo "<p style='color: #ef4444;'>Connection failed: " . $conn->connect_error . "</p>";
          } else {
              $result = $conn->query("SELECT * FROM faculty_requests WHERE status='pending'");
              if($result && $result->num_rows > 0){
                  while($row = $result->fetch_assoc()){
          ?>
                      <div class="request-card">
                        <p><strong><?php echo $row['name']; ?></strong> (<?php echo $row['email']; ?>)</p>
                        <div class="action-btns">
                          <a href="approve_faculty.php?id=<?php echo $row['user_id']; ?>" class="btn approve-btn" style="padding: 0.5rem 1rem; font-size: 0.85rem;">Approve</a>
                          <a href="reject_faculty.php?id=<?php echo $row['user_id']; ?>" class="btn reject-btn" style="padding: 0.5rem 1rem; font-size: 0.85rem;">Reject</a>
                        </div>
                      </div>
          <?php
                  }
              } else {
                  echo "<p style='color: var(--text-muted);'>No pending faculty requests at the moment.</p>";
              }
              $conn->close();
          }
          ?>
        </section>

        <!-- Create Event -->
        <section class="glass-card">
          <h2 style="margin-bottom: 1.5rem;"><i class="fas fa-plus-circle" style="color: var(--primary);"></i> Create New Event</h2>

          <!-- ✅ FIXED FORM ONLY -->
          <form method="POST" style="display: flex; flex-direction: column; gap: 1rem;">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
              <input type="text" name="event_name" placeholder="Event Name" required>
              <input type="date" name="event_date" required>
            </div>

            <input type="text" name="venue" placeholder="Venue Location" required>

            <textarea name="description" placeholder="Event Description" rows="4" required></textarea>

            <button type="submit" name="create_event" class="btn btn-primary" style="padding: 1rem;">Publish Event</button>
          </form>

        </section>

      </div>

      <!-- Right Side -->
      <div class="right-col">
        <section class="glass-card" style="margin-bottom: 2rem;">
          <h2 style="margin-bottom: 1.5rem;"><i class="fas fa-tools" style="color: var(--primary);"></i> Quick Tools</h2>

          <div style="display: flex; flex-direction: column; gap: 1rem;">
            <div style="padding: 1rem; background: var(--surface-dark); border-radius: 8px;">
              <h4 style="margin-bottom: 0.5rem;">Request Equipment</h4>
              <input type="text" placeholder="Item name" style="margin-bottom: 0.5rem;">
              <input type="number" placeholder="Quantity" style="margin-bottom: 0.5rem;">
              <button class="btn btn-outline" style="width: 100%; font-size: 0.85rem;">Send Request</button>
            </div>

            <div style="padding: 1rem; background: var(--surface-dark); border-radius: 8px;">
              <h4 style="margin-bottom: 0.5rem;">Upload Attendance</h4>
              <input type="file" style="margin-bottom: 0.5rem; font-size: 0.8rem;">
              <button class="btn btn-outline" style="width: 100%; font-size: 0.85rem;">Process File</button>
            </div>
          </div>
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