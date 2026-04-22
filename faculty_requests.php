<?php
session_start();

$conn = new mysqli("localhost","root","","event_management");

if ($conn->connect_error) {
    die("DB connection failed");
}

$result = $conn->query("SELECT * FROM faculty_requests ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>Faculty Requests</title>

<style>
body{
    font-family:Inter;
    background:#0f172a;
    color:white;
    padding:30px;
}

.card{
    background:rgba(255,255,255,0.05);
    border:1px solid rgba(255,255,255,0.1);
    padding:20px;
    border-radius:12px;
    margin-bottom:20px;
}

.btn{
    padding:8px 12px;
    border-radius:8px;
    text-decoration:none;
    color:white;
    font-weight:600;
}

.approve{ background:#10b981; }
.reject{ background:#ef4444; }
.view{ background:#3b82f6; }
</style>

</head>

<body>

<h2>📩 Attendance Requests</h2>

<?php while($row = $result->fetch_assoc()){ ?>

<div class="card">

    <h3><?php echo $row['event_name']; ?></h3>

    <p>
        <b>Faculty:</b> <?php echo $row['faculty_name']; ?><br>
        <b>Time:</b> <?php echo $row['from_time']; ?> → <?php echo $row['to_time']; ?><br>
        <b>Status:</b> <?php echo $row['status']; ?>
    </p>

    <!-- VIEW STUDENTS -->
    <a class="btn view" href="view_students.php?id=<?php echo $row['id']; ?>">
        View Students
    </a>

    <!-- APPROVE -->
    <a class="btn approve" href="approve_request.php?id=<?php echo $row['id']; ?>">
        Approve
    </a>

    <!-- REJECT -->
    <a class="btn reject" href="reject_request.php?id=<?php echo $row['id']; ?>">
        Reject
    </a>

</div>

<?php } ?>

</body>
</html>