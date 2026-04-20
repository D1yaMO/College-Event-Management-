<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'club_admin') {
    header("Location: login.html");
    exit();
}

$conn = new mysqli("localhost", "root", "", "event_management");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'] ?? 0;

// FETCH EVENT DATA
$stmt = $conn->prepare("SELECT * FROM events WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (!$row) {
    die("Event not found");
}

// UPDATE EVENT
if (isset($_POST['update'])) {

    $name = $_POST['event_name'];
    $date = $_POST['event_date'];
    $venue = $_POST['venue'];
    $desc = $_POST['description'];

    $update = $conn->prepare("
        UPDATE events 
        SET name=?, event_date=?, venue=?, description=? 
        WHERE id=?
    ");

    $update->bind_param("ssssi", $name, $date, $venue, $desc, $id);
    $update->execute();

    header("Location: manage_events.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Event | CDG</title>

<link rel="stylesheet" href="assets/globals.css">
<link rel="stylesheet" href="assets/dashboard.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<body>

<div class="dashboard-container">

  <!-- SIDEBAR -->
  <aside class="sidebar">
    <div class="sidebar-header">
      <img src="assets/club_dash_pic.jpeg"
        onerror="this.src='https://ui-avatars.com/api/?name=<?php echo $_SESSION['name']; ?>'">
      <h3><?php echo htmlspecialchars($_SESSION['name']); ?></h3>
      <p style="font-size:0.8rem; color:var(--text-muted);">Club Administrator</p>
    </div>

    <nav class="sidebar-nav">
      <a href="clubhead_dashboard.php" class="nav-link"><i class="fas fa-home"></i> Dashboard</a>
      <a href="clubhead_dashboard.php" class="nav-link"><i class="fas fa-plus-circle"></i> Create Event</a>
      <a href="manage_events.php" class="nav-link active"><i class="fas fa-edit"></i> Manage Events</a>
    </nav>

    <div class="sidebar-footer">
      <form action="logout.php" method="post">
        <button class="btn btn-outline" style="width:100%; color:red; border-color:red;">
          <i class="fas fa-sign-out-alt"></i> Logout
        </button>
      </form>
    </div>
  </aside>

  <!-- MAIN -->
  <main class="main-content">

    <header class="content-header">
      <h1>Edit Event ✏️</h1>
      <p>Update event details below</p>
    </header>

    <section class="glass-card" style="max-width:700px;">

      <form method="POST" style="display:flex; flex-direction:column; gap:1rem;">

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">
          <input type="text" name="event_name" 
                 value="<?php echo htmlspecialchars($row['name']); ?>" 
                 required>

          <input type="date" name="event_date" 
                 value="<?php echo $row['event_date']; ?>" 
                 required>
        </div>

        <input type="text" name="venue" 
               value="<?php echo htmlspecialchars($row['venue']); ?>" 
               required>

        <textarea name="description" rows="5" required><?php echo htmlspecialchars($row['description']); ?></textarea>

        <button type="submit" name="update" class="btn btn-primary" style="padding:1rem;">
          Update Event
        </button>

        <a href="manage_events.php" style="text-align:center; margin-top:10px; color:var(--primary);">
          ← Back to Manage Events
        </a>

      </form>

    </section>

  </main>

</div>

</body>
</html>