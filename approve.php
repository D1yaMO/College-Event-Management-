<?php
$conn = new mysqli("localhost", "root", "", "event_management");

$id = $_GET['id'];

$conn->query("UPDATE faculty_requests SET status='approved' WHERE id=$id");

header("Location: faculty_requests.php");
?>