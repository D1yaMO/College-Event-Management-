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

if (isset($_POST['create_event'])) {

    $name = $_POST['event_name'];
    $date = $_POST['event_date'];
    $venue = $_POST['venue'];
    $desc = $_POST['description'];
    $user = $_SESSION['name'];

    $stmt = $conn->prepare("
        INSERT INTO events (name, event_date, venue, description, created_by)
        VALUES (?, ?, ?, ?, ?)
    ");

    $stmt->bind_param("sssss", $name, $date, $venue, $desc, $user);
    $stmt->execute();

    header("Location: manage_events.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Create Event</title>

<link rel="stylesheet" href="assets/globals.css">
<link rel="stylesheet" href="assets/dashboard.css">

<!-- ✅ FIX 1: ICONS (IMPORTANT) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<!-- fonts -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
input, textarea {
  background: var(--surface-dark);
  color: white;
  border: 1px solid var(--border-color);
  padding: 10px;
  border-radius: 8px;
}

/* date picker fix + orange icon */
input[type="date"] {
  color-scheme: dark;
  color: white;
}

input[type="date"]::-webkit-calendar-picker-indicator {
  filter: invert(60%) sepia(80%) saturate(500%) hue-rotate(10deg);
  cursor: pointer;
}
</style>

</head>

<body>

<div class="dashboard-container">

  <?php include 'sidebar.php'; ?>

  <!-- MAIN CONTENT -->
  <main class="main-content">

    <section class="glass-card" style="max-width:700px;">

      <h2 style="margin-bottom:1rem;">
        <i class="fas fa-plus-circle" style="color:var(--primary);"></i>
        Create Event
      </h2>

      <form method="POST" style="display:flex; flex-direction:column; gap:1rem;">

        <input type="text" name="event_name" placeholder="Event Name" required>

        <input type="date" name="event_date" required>

        <input type="text" name="venue" placeholder="Venue" required>

        <textarea name="description" placeholder="Description" required></textarea>

        <input type="text" name="created_by" placeholder="User Name" required>

        <button type="submit" name="create_event" class="btn btn-primary">
          Publish Event
        </button>

      </form>

    </section>

  </main>

</div>

</body>
</html>