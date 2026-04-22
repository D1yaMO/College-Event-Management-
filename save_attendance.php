<?php
$conn = new mysqli("localhost","root","","event_management");

$request_id = $_GET['request_id'];
$name = $_GET['name'];
$usn = $_GET['usn'];
$status = $_GET['status'];

$conn->query("
INSERT INTO attendance_records 
(request_id, student_name, usn, status)
VALUES 
('$request_id','$name','$usn','$status')
");

header("Location: mark_attendance.php?request_id=$request_id");
?>