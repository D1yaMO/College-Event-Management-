<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role']!='club_admin') {
    header("Location: login.html");
    exit();
}

$conn = new mysqli("localhost","root","","event_management");

$events = $conn->query("SELECT * FROM events");
?>

<!DOCTYPE html>
<html>
<head>
<title>Registrations</title>
<link rel="stylesheet" href="assets/globals.css">
</head>

<body>

<h1>Event Registrations</h1>

<?php while($event=$events->fetch_assoc()) { ?>

<div style="margin:20px;padding:15px;border:1px solid #ccc;">

<h2><?php echo $event['event_name']; ?></h2>

<?php
$id=$event['id'];
$stmt=$conn->prepare("SELECT * FROM registrations WHERE event_id=?");
$stmt->bind_param("i",$id);
$stmt->execute();
$res=$stmt->get_result();
?>

<?php if($res->num_rows>0){ ?>
<ul>
<?php while($r=$res->fetch_assoc()){ ?>
<li>
<?php echo $r['student_name']; ?> |
<?php echo $r['student_email']; ?> |
<?php echo $r['department']; ?>
</li>
<?php } ?>
</ul>
<?php } else { ?>
<p>No registrations yet</p>
<?php } ?>

</div>

<?php } ?>

</body>
</html>
