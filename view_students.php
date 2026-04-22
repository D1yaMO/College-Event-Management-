<?php
session_start();

$conn = new mysqli("localhost","root","","event_management");

if ($conn->connect_error) {
    die("DB connection failed");
}

$request_id = $_GET['id'];

// get request info
$request = $conn->query("SELECT * FROM faculty_requests WHERE id=$request_id");
$req = $request->fetch_assoc();

// get students
$students = $conn->query("SELECT * FROM attendance_students WHERE request_id=$request_id");
?>

<!DOCTYPE html>
<html>
<head>
<title>Student List</title>

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
}

table{
    width:100%;
    margin-top:20px;
    border-collapse:collapse;
}

th, td{
    padding:10px;
    border-bottom:1px solid rgba(255,255,255,0.1);
    text-align:left;
}

th{
    color:#f97316;
}
</style>

</head>

<body>

<h2>📋 Student List</h2>

<div class="card">

    <h3><?php echo $req['event_name']; ?></h3>
    <p>
        <b>Faculty:</b> <?php echo $req['faculty_name']; ?><br>
        <b>Time:</b> <?php echo $req['from_time']; ?> → <?php echo $req['to_time']; ?>
    </p>

    <table>
        <tr>
            <th>Name</th>
            <th>USN</th>
            <th>Dept</th>
            <th>Sem</th>
            <th>Phone</th>
        </tr>

        <?php while($row = $students->fetch_assoc()){ ?>
        <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['usn']; ?></td>
            <td><?php echo $row['dept']; ?></td>
            <td><?php echo $row['sem']; ?></td>
            <td><?php echo $row['phone']; ?></td>
        </tr>
        <?php } ?>

    </table>

</div>

</body>
</html>