<?php
$conn = new mysqli("localhost", "root", "", "event_management");

$id = $_GET['id'];
$status = $_GET['status'];

$conn->query("UPDATE faculty_requests SET status='$status' WHERE id=$id");

header("Location: faculty_requests.php");
?>