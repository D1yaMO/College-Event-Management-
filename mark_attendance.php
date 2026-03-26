<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'faculty') {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Mark Attendance</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<style>

body{
font-family:Poppins;
background:#111;
color:white;
margin:0;
padding:40px;
}

.back{
position:absolute;
top:20px;
left:20px;
font-size:24px;
color:white;
text-decoration:none;
}

.container{
max-width:900px;
margin:auto;
}

h1{
text-align:center;
color:#ffa500;
margin-bottom:30px;
}

.card{
background:#1e1e1e;
padding:30px;
border-radius:10px;
}

/* inputs */

input,select{
padding:8px;
border-radius:5px;
border:none;
margin-bottom:15px;
}

/* table */

table{
width:100%;
border-collapse:collapse;
margin-top:20px;
}

th,td{
padding:10px;
text-align:center;
border-bottom:1px solid #333;
}

th{
background:#ffa500;
color:black;
}

/* buttons */

button{
padding:10px 15px;
background:#ffa500;
border:none;
border-radius:5px;
font-weight:bold;
cursor:pointer;
margin-top:10px;
}

.add-btn{
background:#4CAF50;
margin-bottom:10px;
}

</style>

</head>

<body>

<a class="back" href="faculty_dashboard.php">←</a>

<div class="container">

<h1>Mark Attendance</h1>

<div class="card">

<label>Date:</label><br>
<input type="date">

<br>

<label>Subject:</label><br>
<input type="text" placeholder="Enter subject">

<br>

<button class="add-btn" onclick="addRow()">Add Student</button>

<form>

<table id="attendanceTable">

<tr>
<th>Student Name</th>
<th>Present</th>
<th>Absent</th>
</tr>

<tr>
<td><input type="text" name="student[]"></td>
<td><input type="radio" name="status0" value="present"></td>
<td><input type="radio" name="status0" value="absent"></td>
</tr>

</table>

<button type="submit">Submit Attendance</button>

</form>

</div>

</div>

<script>

let count = 1;

function addRow(){

let table = document.getElementById("attendanceTable");

let row = table.insertRow();

row.innerHTML = `
<td><input type="text" name="student[]"></td>
<td><input type="radio" name="status${count}" value="present"></td>
<td><input type="radio" name="status${count}" value="absent"></td>
`;

count++;

}

</script>

</body>

</html>