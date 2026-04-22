<?php
session_start();

$conn = new mysqli("localhost", "root", "", "event_management");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$today = date("Y-m-d");
$result = $conn->query("SELECT * FROM events WHERE event_date='$today'");
?>

<!DOCTYPE html>
<html>
<head>
<title>Ongoing Events</title>

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

/* MAIN */
.main{
  padding:40px;
}

/* HEADER */
.header{
  display:flex;
  align-items:center;
  gap:20px;
  margin-bottom:30px;
}

/* BACK BUTTON LEFT */
.back{
  text-decoration:none;
  color:white;
  background:#1e293b;
  padding:12px 16px;
  border-radius:10px;
  transition:0.3s;
  font-size:18px;
}

.back:hover{
  background:#334155;
}

/* TITLE */
.header-text h1{
  font-size:36px;   /* 🔥 BIGGER */
  margin:0;
}

.subtitle{
  color:var(--text-muted);
  font-size:16px;   /* 🔥 BIGGER */
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
  box-shadow:0 6px 18px rgba(0,0,0,0.4);
  transition:0.3s;
}

.card:hover{
  transform:translateY(-6px);
}

/* TEXT */
.title{
  font-size:20px;   /* 🔥 BIGGER */
  font-weight:600;
  color:var(--accent);
  margin-bottom:12px;
}

.details{
  font-size:16px;   /* 🔥 BIGGER */
  color:var(--text-muted);
  margin-bottom:8px;
}

/* BADGE */
.badge{
  display:inline-block;
  background:red;
  padding:6px 12px;
  border-radius:20px;
  font-size:13px;
  margin-top:10px;
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

<!-- HEADER -->
<div class="header">

  <!-- BACK BUTTON LEFT -->
  <a href="faculty_dashboard.php" class="back">
    <i class="fas fa-arrow-left"></i>
  </a>

  <div class="header-text">
    <h1><i class="fas fa-calendar-check"></i> Ongoing Events</h1>
    <p class="subtitle">Events happening today</p>
  </div>

</div>

<!-- EVENTS -->
<div class="grid">

<?php if($result && $result->num_rows > 0): ?>

<?php while($row = $result->fetch_assoc()): ?>

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

<div class="badge">LIVE</div>

</div>

<?php endwhile; ?>

<?php else: ?>

<div class="empty">
  🚫 No events happening today
</div>

<?php endif; ?>

</div>

</div>

</body>
</html>