<?php
$conn = new mysqli("localhost","root","","event_management");

$user_id = $_GET['id'];

// update role
$conn->query("UPDATE users SET role='faculty' WHERE id='$user_id'");

// update request status
$conn->query("UPDATE faculty_requests SET status='approved' WHERE user_id='$user_id'");

// add notification
$conn->query("INSERT INTO notifications (user_id, message)
VALUES ('$user_id', 'Your faculty request has been approved')");

echo "<script>alert('Faculty Approved!'); window.location='clubhead_dashboard.php';</script>";
?>