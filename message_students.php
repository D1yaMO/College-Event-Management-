<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>

<title>Message Students</title>

<style>

body{
font-family:Poppins;
background:#111;
color:white;
padding:40px;
text-align:center;
}

.back{
position:absolute;
top:20px;
left:20px;
font-size:24px;
color:white;
text-decoration:none;
}

input,textarea{
width:350px;
padding:10px;
margin:10px;
border-radius:5px;
border:none;
}

button{
padding:10px 20px;
background:#ffa500;
border:none;
border-radius:5px;
font-weight:bold;
}

</style>

</head>

<body>

<a class="back" href="faculty_dashboard.php">←</a>

<h2>Send Message to Students</h2>

<form>

<input type="text" placeholder="Subject"><br>

<textarea placeholder="Message"></textarea><br>

<button type="submit">Send</button>

</form>

</body>
</html>