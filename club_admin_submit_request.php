<?php
session_start();

$conn = new mysqli("localhost", "root", "", "event_management");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ============================
// SAFE FETCH (FIXES YOUR ERROR)
// ============================

$event_name    = $_POST['event_name'] ?? '';
$faculty_name  = $_POST['faculty_name'] ?? '';
$faculty_email = $_POST['faculty_email'] ?? '';
$message       = $_POST['message'] ?? '';
$from_time     = $_POST['from_time'] ?? '';
$to_time       = $_POST['to_time'] ?? '';

// 🔴 DEBUG (TEMP — REMOVE LATER)
if(empty($faculty_email)){
    die("❌ Faculty email missing!");
}

// ============================
// INSERT INTO DB
// ============================

$stmt = $conn->prepare("
INSERT INTO faculty_requests 
(event_name, faculty_name, faculty_email, message, from_time, to_time, status)
VALUES (?, ?, ?, ?, ?, ?, 'pending')
");

$stmt->bind_param(
    "ssssss",
    $event_name,
    $faculty_name,
    $faculty_email,
    $message,
    $from_time,
    $to_time
);

if($stmt->execute()){
    echo "<script>
    alert('✅ Attendance Request Sent Successfully!');
    window.location.href='club_admin_send_request.php';
    </script>";
} else {
    echo "❌ Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>