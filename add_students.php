<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'faculty') {
    header("Location: login.html");
    exit();
}

$file = "students.json";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $students = $_POST['student'];
    file_put_contents($file, json_encode($students));
    echo "<script>alert('Students saved successfully');</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Students</title>

<style>
body{
font-family:Poppins;
background:#111;
color:white;
padding:40px;
}

input{
padding:8px;
margin:5px;
}

button{
padding:10px;
background:#ffa500;
border:none;
border-radius:5px;
}
</style>

</head>

<body>

<a href="faculty_dashboard.php">← Back</a>

<h2>Add Students (First Time Setup)</h2>

<form method="post">

<div id="students">
<input type="text" name="student[]" placeholder="Student Name">
</div>

<button type="button" onclick="addStudent()">Add Another Student</button>

<br><br>

<button type="submit">Save Students</button>

</form>

<script>

function addStudent(){
let div = document.getElementById("students");
let input = document.createElement("input");
input.type = "text";
input.name = "student[]";
input.placeholder = "Student Name";
div.appendChild(document.createElement("br"));
div.appendChild(input);
}

</script>

</body>
</html>