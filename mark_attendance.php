<?php
session_start();

$conn = new mysqli("localhost","root","","event_management");

$request_id = $_GET['request_id'];

// get students from CSV table
$result = $conn->query("SELECT * FROM attendance_students WHERE request_id=$request_id");

// get request info
$req = $conn->query("SELECT * FROM faculty_requests WHERE id=$request_id")->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
<title>Mark Attendance</title>
<style>
body{
    font-family:Arial;
    background:#0f172a;
    color:white;
}
.container{
    width:80%;
    margin:auto;
    margin-top:40px;
}
.card{
    background:#1e293b;
    padding:15px;
    margin-bottom:10px;
    border-radius:10px;
}
button{
    padding:8px 12px;
    border:none;
    cursor:pointer;
    margin-right:10px;
}
.present{background:#10b981;color:white;}
.absent{background:#ef4444;color:white;}
</style>
</head>

<body>

<div class="container">

<h2>Attendance - <?php echo $req['event_name']; ?></h2>

<?php while($row = $result->fetch_assoc()) { ?>

<div class="card">
    <p>
        <b><?php echo $row['name']; ?></b><br>
        USN: <?php echo $row['usn']; ?>
    </p>

    <a href="save_attendance.php?request_id=<?php echo $request_id; ?>&name=<?php echo $row['name']; ?>&usn=<?php echo $row['usn']; ?>&status=Present">
        <button class="present">Present</button>
    </a>

    <a href="save_attendance.php?request_id=<?php echo $request_id; ?>&name=<?php echo $row['name']; ?>&usn=<?php echo $row['usn']; ?>&status=Absent">
        <button class="absent">Absent</button>
    </a>
</div>

<?php } ?>

</div>

</body>
</html>