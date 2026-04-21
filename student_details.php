<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>

<title>Student Details</title>

<style>

body{
font-family:Poppins;
background:#111;
color:white;
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

table{
width:80%;
margin:auto;
border-collapse:collapse;
margin-top:30px;
}

th,td{
padding:12px;
border-bottom:1px solid #333;
text-align:center;
}

th{
background:#ffa500;
color:black;
}

</style>

</head>

<body>

<a class="back" href="faculty_dashboard.php">←</a>

<h2 style="text-align:center;">Student Details</h2>

<table>

<tr>
<th>Name</th>
<th>USN</th>
<th>Department</th>
</tr>

<tr>
<td>Cherry</td>
<td>1MV23CS001</td>
<td>CSE</td>
</tr>

<tr>
<td>Rahul</td>
<td>1MV23CS002</td>
<td>CSE</td>
</tr>

<tr>
<td>Aisha</td>
<td>1MV23CS003</td>
<td>CSE</td>
</tr>

</table>

</body>
</html>
