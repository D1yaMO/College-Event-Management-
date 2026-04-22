<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'club_admin') {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Send Faculty Request | Club Admin</title>

<style>
body{
    font-family: Inter, sans-serif;
    background:#0f172a;
    color:#fff;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
}

.form-box{
    width:450px;
    padding:25px;
    border:1px solid rgba(255,255,255,0.2);
    border-radius:15px;
    background:rgba(255,255,255,0.05);
    backdrop-filter:blur(10px);
}

input, textarea, button{
    width:100%;
    padding:10px;
    margin-top:10px;
    border-radius:8px;
    border:none;
}

input, textarea{
    background:#1e293b;
    color:#fff;
}

button{
    background:linear-gradient(135deg,#ef4444,#f97316);
    color:white;
    font-weight:bold;
    cursor:pointer;
}

h2{
    text-align:center;
    margin-bottom:20px;
}
</style>
</head>

<body>

<div class="form-box">

<h2>Send Faculty Attendance Request</h2>

<form action="club_admin_submit_request.php" method="POST" enctype="multipart/form-data">

    <input type="text" name="event_name" placeholder="Event Name" required>

    <input type="text" name="faculty_name" placeholder="Faculty Name" required>

    <!-- ✅ ADD THIS (IMPORTANT FIX) -->
    <input type="email" name="faculty_email" placeholder="Faculty Email" required>

    <input type="text" name="from_time" placeholder="From Time (e.g. 10:00 AM)" required>

    <input type="text" name="to_time" placeholder="To Time (e.g. 12:00 PM)" required>

    <textarea name="message" placeholder="Message to Faculty" required></textarea>

    <label style="margin-top:10px;">Upload Student CSV</label>
    <input type="file" name="file" accept=".csv" required>

    <button type="submit">Send Request</button>

</form>

</div>

</body>
</html>