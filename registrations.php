<?php
session_start();

/* ACCESS CONTROL */
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'club_admin') {
    header("Location: login.html");
    exit();
}

/* DB CONNECTION */
$conn = new mysqli("localhost", "root", "", "event_management");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

/* FETCH EVENTS */
$events = $conn->query("SELECT * FROM events");

if (!$events) {
    die("Query Error: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Event Registrations</title>

<style>

body{
margin:0;
font-family:'Segoe UI';
background:#0f172a;
color:white;
}

/* HEADER */
h1{
text-align:center;
margin-top:30px;
}

/* CARD */
.card{
max-width:900px;
margin:20px auto;
padding:20px;
background:#1e293b;
border-radius:10px;
}

/* EVENT TITLE */
.card h2{
margin-bottom:15px;
color:#f59e0b;
}

/* LIST */
ul{
list-style:none;
padding:0;
}

li{
padding:8px;
border-bottom:1px solid #334155;
}

/* EMPTY */
.empty{
color:#9ca3af;
}

</style>

</head>

<body>

<h1>Event Registrations</h1>

<?php while($event = $events->fetch_assoc()) { ?>

<div class="card">

<!-- ✅ FIXED HERE -->
<h2><?php echo isset($event['name']) ? htmlspecialchars($event['name']) : 'Event'; ?></h2>

<?php
$id = $event['id'];

$stmt = $conn->prepare("SELECT * FROM registrations WHERE event_id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();
?>

<?php if($res->num_rows > 0){ ?>

<ul>
<?php while($r = $res->fetch_assoc()){ ?>
<li>
<?php echo htmlspecialchars($r['student_name']); ?> |
<?php echo htmlspecialchars($r['student_email']); ?> |
<?php echo htmlspecialchars($r['department']); ?>
</li>
<?php } ?>
</ul>

<?php } else { ?>

<p class="empty">No registrations yet</p>

<?php } ?>

</div>

<?php } ?>

</body>
</html>