<?php
$conn = new mysqli("localhost","root","","event_management");

$user_id = $_GET['id'];

// update request status
$conn->query("UPDATE faculty_requests SET status='rejected' WHERE user_id='$user_id'");

// add notification
$conn->query("INSERT INTO notifications (user_id, message)
VALUES ('$user_id', 'Your faculty request has been rejected')");

echo "<script>alert('Request Rejected'); window.location='clubhead_dashboard.php';</script>";
?>