<?php
session_start();

$conn = new mysqli("localhost", "root", "", "event_management");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$today = date("Y-m-d");

/* SORT BY NEAREST DATE */
$result = $conn->query("SELECT * FROM events WHERE event_date > '$today' ORDER BY event_date ASC");
?>

<!DOCTYPE html>
<html>
<head>
<title>Upcoming Events</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>

:root{
  --bg-dark:#0f172a;
  --card:#1e293b;
  --accent:#f59e0b;
  --text-muted:#9ca3af;
}

body{
  margin:0;
  font-family:'Segoe UI';
  background:linear-gradient(135deg,#0f172a,#1e293b);
  color:white;
}

.main{
  padding:40px;
}

.header{
  display:flex;
  align-items:center;
  gap:20px;
  margin-bottom:30px;
}

.back{
  text-decoration:none;
  color:white;
  background:#1e293b;
  padding:12px 16px;
  border-radius:10px;
  font-size:18px;
}

.header-text h1{
  font-size:36px;
  margin:0;
}

.subtitle{
  color:var(--text-muted);
  font-size:16px;
}

/* GRID */
.grid{
  display:grid;
  grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
  gap:25px;
}

/* CARD */
.card{
  background:var(--card);
  padding:25px;
  border-radius:14px;
  transition:0.3s;
  box-shadow:0 6px 18px rgba(0,0,0,0.4);
}

.card:hover{
  transform:translateY(-6px);
}

/* TEXT */
.title{
  font-size:20px;
  font-weight:600;
  color:var(--accent);
  margin-bottom:10px;
}

.details{
  font-size:16px;
  color:var(--text-muted);
  margin-bottom:6px;
}

/* COUNTDOWN */
.countdown{
  margin-top:10px;
  font-size:14px;
  background:#2563eb;
  display:inline-block;
  padding:6px 12px;
  border-radius:20px;
}

/* EMPTY */
.empty{
  text-align:center;
  margin-top:50px;
  font-size:18px;
  color:var(--text-muted);
}

</style>

</head>

<body>

<div class="main">

<div class="header">
  <a href="faculty_dashboard.php" class="back">
    <i class="fas fa-arrow-left"></i>
  </a>

  <div class="header-text">
    <h1><i class="fas fa-calendar"></i> Upcoming Events</h1>
    <p class="subtitle">Events scheduled for future</p>
  </div>
</div>

<div class="grid">

<?php if($result && $result->num_rows > 0): ?>

<?php while($row = $result->fetch_assoc()): ?>

<?php
$eventDate = new DateTime($row['event_date']);
$todayDate = new DateTime($today);
$diff = $todayDate->diff($eventDate)->days;
?>

<div class="card">

<div class="title">
  <?php echo htmlspecialchars($row['name']); ?>
</div>

<div class="details">
  📍 <?php echo htmlspecialchars($row['venue']); ?>
</div>

<div class="details">
  📅 <?php echo htmlspecialchars($row['event_date']); ?>
</div>

<?php if(isset($row['time'])): ?>
<div class="details">
  ⏰ <?php echo htmlspecialchars($row['time']); ?>
</div>
<?php endif; ?>

<div class="countdown">
  ⏳ <?php echo $diff; ?> days left
</div>

</div>

<?php endwhile; ?>

<?php else: ?>

<div class="empty">
  🚫 No upcoming events
</div>

<?php endif; ?>

</div>

</div>

</body>
</html>