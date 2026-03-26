<?php
session_start();
$conn = new mysqli("localhost","root","","event_management");

$user_id = $_SESSION['user_id'];
$name = $_SESSION['name'];

// get email from DB
$result = $conn->query("SELECT email FROM users WHERE id='$user_id'");
$row = $result->fetch_assoc();
$email = $row['email'];

// check if already requested
$check = $conn->query("SELECT * FROM faculty_requests WHERE user_id='$user_id' AND status='pending'");

if($check->num_rows > 0){
    echo "<script>alert('Request already sent!'); window.location='student_dashboard.php';</script>";
    exit();
}

// insert request
$sql = "INSERT INTO faculty_requests (user_id, name, email)
VALUES ('$user_id','$name','$email')";

$conn->query($sql);

echo "<script>alert('Request sent to admin!'); window.location='student_dashboard.php';</script>";
?>