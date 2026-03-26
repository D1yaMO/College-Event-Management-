<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
<title>Campaign Requests</title>

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
margin-top:40px;
}

th,td{
padding:12px;
text-align:center;
border-bottom:1px solid #333;
}

th{
background:#ffa500;
color:black;
}

button{
padding:6px 12px;
border:none;
border-radius:5px;
cursor:pointer;
}

.approve{background:green;color:white;}
.reject{background:red;color:white;}

</style>
</head>

<body>

<a class="back" href="faculty_dashboard.php">←</a>

<h2 style="text-align:center;">Campaign Requests</h2>

<table>

<tr>
<th>Event</th>
<th>Club</th>
<th>Date</th>
<th>Action</th>
</tr>

<tr>
<td>Hackathon</td>
<td>Coding Club</td>
<td>12 Apr</td>
<td>
<button class="approve">Approve</button>
<button class="reject">Reject</button>
</td>
</tr>

</table>

</body>
</html>