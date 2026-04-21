<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.html");
    exit();
}

$conn = new mysqli("localhost", "root", "", "event_management");

$email = $_SESSION['email'];

// 🔹 Fetch all events
$events = $conn->query("SELECT * FROM events ORDER BY event_date DESC");

// 🔹 Fetch registered events for THIS user
$registeredEvents = [];
$regQuery = $conn->query("SELECT event_id FROM registrations WHERE student_email='$email'");

while ($row = $regQuery->fetch_assoc()) {
    $registeredEvents[] = $row['event_id'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Upcoming Events</title>
<link rel="stylesheet" href="assets/globals.css">

<style>
body { padding: 40px; background: var(--bg-dark); }

.container {
  max-width: 800px;
  margin: 60px auto;
}

.event-card {
  margin-bottom: 2rem;
  padding: 2rem;
}

button {
  margin-top: 10px;
  padding: 10px 15px;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  background: var(--primary);
}

button.registered {
  background: green;
  cursor: not-allowed;
}
</style>
</head>

<body>

<div class="container">

<h1>Upcoming Events</h1>

<?php if ($events && $events->num_rows > 0) { ?>

    <?php while ($row = $events->fetch_assoc()) { ?>

    <div class="glass-card event-card">

        <h2><?php echo htmlspecialchars($row['name']); ?></h2>
        <p><?php echo htmlspecialchars($row['description']); ?></p>
        <p><b>Date:</b> <?php echo $row['event_date']; ?></p>
        <p><b>Venue:</b> <?php echo $row['venue']; ?></p>

        <?php if (in_array($row['id'], $registeredEvents)) { ?>

            <!-- ✅ Already Registered -->
            <button class="registered">Registered ✓</button>

        <?php } else { ?>

            <!-- ✅ Register Button -->
            <button onclick="registerEvent(<?php echo $row['id']; ?>)">
                Register Now
            </button>

        <?php } ?>

    </div>

    <?php } ?>

<?php } else { ?>

    <p>No events available</p>

<?php } ?>

</div>

<script>
function registerEvent(eventId) {
  fetch("register_event.php", {
    method: "POST",
    headers: {"Content-Type": "application/x-www-form-urlencoded"},
    body: "event_id=" + eventId
  })
  .then(res => res.text())
  .then(data => {
    alert(data);
    location.reload(); // 🔥 refresh to update button
  })
  .catch(() => alert("Error registering"));
}
</script>

</body>
</html>