<?php
session_start();

$conn = new mysqli("localhost","root","","event_management");

if ($conn->connect_error) {
    die("Connection failed");
}

if (!isset($_SESSION['email'])) {
    header("Location: login.html");
    exit();
}

$email = $_SESSION['email'];

if (isset($_POST['save'])) {

    $usn = $_POST['usn'];
    $phone = $_POST['phone'];
    $semester = $_POST['semester'];
    $department = $_POST['department'];

    $stmt = $conn->prepare("
        UPDATE users 
        SET usn=?, phone=?, semester=?, department=? 
        WHERE email=?
    ");

    $stmt->bind_param("sssss", $usn, $phone, $semester, $department, $email);
    $stmt->execute();

    // update session too
    $_SESSION['usn'] = $usn;
    $_SESSION['phone'] = $phone;
    $_SESSION['semester'] = $semester;
    $_SESSION['department'] = $department;

    header("Location: student_dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Complete Profile</title>
<link rel="stylesheet" href="assets/globals.css">
</head>

<body style="background:var(--bg-dark); display:flex; justify-content:center; align-items:center; height:100vh;">

<div class="glass-card" style="padding:30px; width:400px;">

<h2>Complete Your Profile</h2>

<form method="POST">

<input name="usn" placeholder="USN" required style="width:100%;padding:10px;margin:10px 0;"><br>

<input name="phone" placeholder="Phone" required style="width:100%;padding:10px;margin:10px 0;"><br>

<input name="semester" placeholder="Semester" required style="width:100%;padding:10px;margin:10px 0;"><br>

<input name="department" placeholder="Department" required style="width:100%;padding:10px;margin:10px 0;"><br>

<button name="save" class="btn btn-primary" style="width:100%;">
Save Profile
</button>

</form>

</div>

</body>
</html>