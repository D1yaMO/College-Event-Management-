<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'faculty') {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Faculty Dashboard</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>

/* ===== GLOBAL ===== */

body{
margin:0;
font-family:'Segoe UI';
background:#0f172a;
color:white;
display:flex;
}

/* ===== TOPBAR ===== */

.topbar{
position:fixed;
top:0;
right:0;
width:100%;
display:flex;
justify-content:flex-end;
padding:15px 30px;
z-index:1000;
}

.top-icons{
display:flex;
align-items:center;
gap:20px;
}

/* ===== BELL ===== */

.bell{
position:relative;
cursor:pointer;
font-size:20px;
}

.bell span{
position:absolute;
top:-5px;
right:-8px;
background:red;
font-size:10px;
padding:2px 6px;
border-radius:50%;
}

/* NOTIFICATION BOX */

.notif-dropdown{
display:none;
position:absolute;
right:0;
top:35px;
background:#1e293b;
padding:10px;
border-radius:8px;
width:200px;
box-shadow:0 5px 15px rgba(0,0,0,0.4);
}

.notif-dropdown p{
margin:5px 0;
font-size:13px;
}

.notif-dropdown.active{
display:block;
}

/* ===== PROFILE ===== */

.profile{
position:relative;
cursor:pointer;
}

.profile img{
width:35px;
height:35px;
border-radius:50%;
}

.dropdown{
display:none;
position:absolute;
right:0;
top:45px;
background:#1e293b;
padding:10px;
border-radius:8px;
min-width:150px;
}

.dropdown a{
display:block;
padding:8px;
color:white;
text-decoration:none;
}

.profile:hover .dropdown{
display:block;
}

/* ===== MENU BUTTON ===== */

.menu-btn{
position:fixed;
top:20px;
left:20px;
z-index:2000;
background:#f59e0b;
border:none;
width:45px;
height:45px;
border-radius:50%;
color:white;
font-size:20px;
cursor:pointer;
}

/* ===== OVERLAY ===== */

.overlay{
position:fixed;
top:0;
left:0;
width:100%;
height:100%;
background:rgba(0,0,0,0.5);
display:none;
z-index:1000;
}

.overlay.active{
display:block;
}

/* ===== SIDEBAR ===== */

.sidebar{
width:240px;
height:100vh;
background:#1e293b;
padding:20px;
display:flex;
flex-direction:column;
position:fixed;
left:-300px;
top:0;
transition:0.3s;
z-index:1500;
}

.sidebar.active{
left:0;
}

/* PROFILE */

.profile-box{
text-align:center;
margin-bottom:30px;
}

.profile-circle{
width:80px;
height:80px;
background:#f59e0b;
border-radius:50%;
display:flex;
align-items:center;
justify-content:center;
font-size:28px;
margin:auto;
}

/* MENU */

.menu{
flex:1;
}

.menu a{
display:flex;
align-items:center;
gap:10px;
padding:12px;
border-radius:8px;
text-decoration:none;
color:white;
margin:5px 0;
}

.menu a:hover{
background:#334155;
}

/* LOGOUT */

.logout{
margin-top:auto;
}

.logout button{
width:100%;
padding:12px;
background:#ef4444;
border:none;
border-radius:8px;
color:white;
margin: 
}

/* ===== MAIN ===== */

.main{
flex:1;
padding:80px 40px 40px 40px;
max-width:1200px;
margin:auto;
}

/* HEADER */

.header h1{
margin-bottom:5px;
}

/* STATS */

.stats{
display:grid;
grid-template-columns:repeat(4,1fr);
gap:20px;
margin:20px 0;
}

.stat{
background:#1e293b;
padding:20px;
border-radius:12px;
text-align:center;
}

.stat h2{
color:#f59e0b;
}

/* CARDS */

.grid{
display:grid;
grid-template-columns:repeat(4,1fr);
gap:20px;
}

.card{
background:#1e293b;
padding:25px;
border-radius:12px;
text-align:center;
text-decoration:none;
color:white;
transition:0.3s;
}

.card:hover{
transform:translateY(-8px);
}

.card i{
font-size:28px;
color:#f59e0b;
}

/* RESPONSIVE */

@media(max-width:900px){
.stats,.grid{
grid-template-columns:repeat(2,1fr);
}
}

</style>

</head>

<body>

<!-- TOPBAR -->

<div class="topbar">
<div class="top-icons">

<!-- BELL -->
<div class="bell" onclick="toggleNotifications()">
<i class="fas fa-bell"></i>
<span>3</span>

<div class="notif-dropdown" id="notifBox">
<p>📢 New campaign request</p>
<p>📅 Event updated</p>
<p>✅ Attendance submitted</p>
</div>

</div>

<!-- PROFILE -->
<div class="profile">
<img src="https://ui-avatars.com/api/?name=<?php echo $_SESSION['name']; ?>">

<div class="dropdown">
<a href="#">👤 Profile</a>
<a href="#">⚙ Settings</a>
<a href="logout.php">🚪 Logout</a>
</div>

</div>

</div>
</div>

<!-- MENU BUTTON -->
<button class="menu-btn" onclick="openMenu()">☰</button>

<!-- OVERLAY -->
<div class="overlay" id="overlay" onclick="closeMenu()"></div>

<!-- SIDEBAR -->

<div class="sidebar" id="sidebar">

<div class="profile-box">
<div class="profile-circle">
<?php echo strtoupper(substr($_SESSION['name'],0,2)); ?>
</div>
<h3><?php echo $_SESSION['name']; ?></h3>
<p>Faculty Portal</p>
</div>

<div class="menu">
<a href="#"><i class="fa fa-user"></i> Profile</a>
<a href="camp_req.php"><i class="fa fa-clipboard"></i> Campaign Requests</a>
<a href="ongoing_event.php"><i class="fa fa-play"></i> Ongoing Events</a>
<a href="upcoming_event.php"><i class="fa fa-calendar"></i> Upcoming Events</a>
<a href="student_details.php"><i class="fa fa-users"></i> Student Details</a>
<a href="message_students.php"><i class="fa fa-envelope"></i> Message Students</a>
<a href="mark_attendance.php"><i class="fa fa-check"></i> Attendance</a>
<a href="manage_equipment.php"><i class="fa fa-tools"></i> Manage Equipment</a>
</div>

<div class="logout">
<form action="logout.php" method="post">
<button>Logout</button>
</form>
</div>

</div>

<!-- MAIN -->

<div class="main">

<div class="header">
<h1>Welcome back, <?php echo $_SESSION['name']; ?> 👋</h1>
<p>Manage academic and event activities</p>
</div>

<div class="stats">
<div class="stat"><h2>8</h2><p>Requests</p></div>
<div class="stat"><h2>3</h2><p>Ongoing</p></div>
<div class="stat"><h2>450+</h2><p>Students</p></div>
<div class="stat"><h2>12</h2><p>Reports</p></div>
</div>

<div class="grid">

<a href="camp_req.php" class="card">
<i class="fas fa-bullhorn"></i>
<h3>Campaigns</h3>
</a>

<a href="ongoing_event.php" class="card">
<i class="fas fa-tasks"></i>
<h3>Monitor Events</h3>
</a>

<a href="student_details.php" class="card">
<i class="fas fa-users"></i>
<h3>Student Database</h3>
</a>

<a href="message_students.php" class="card">
<i class="fas fa-paper-plane"></i>
<h3>Broadcast</h3>
</a>

</div>

</div>

<script>

/* SIDEBAR */
function openMenu(){
document.getElementById("sidebar").classList.add("active");
document.getElementById("overlay").classList.add("active");
}

function closeMenu(){
document.getElementById("sidebar").classList.remove("active");
document.getElementById("overlay").classList.remove("active");
}

/* NOTIFICATIONS */
function toggleNotifications(){
document.getElementById("notifBox").classList.toggle("active");
}

/* CLICK OUTSIDE CLOSE */
document.addEventListener("click", function(e){
let bell = document.querySelector(".bell");
let box = document.getElementById("notifBox");

if(!bell.contains(e.target)){
box.classList.remove("active");
}
});

</script>

</body>
</html>