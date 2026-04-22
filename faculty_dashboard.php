<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'faculty') {
    header("Location: login.html");
    exit();
}

$conn = new mysqli("localhost", "root", "", "event_management");

$faculty_email = $_SESSION['email'] ?? '';

// 🔥 COUNT PENDING REQUESTS
$countQuery = $conn->query("
SELECT COUNT(*) as total 
FROM faculty_requests 
WHERE faculty_email='$faculty_email' AND status='pending'
");

$countData = $countQuery->fetch_assoc();
$pendingCount = $countData['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Faculty Dashboard</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
/* (UNCHANGED CSS - kept exactly same as yours) */

body{
margin:0;
font-family:'Segoe UI';
background:#0f172a;
color:white;
display:flex;
}

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

.notif-dropdown{
display:none;
position:absolute;
right:0;
top:35px;
background:#1e293b;
padding:10px;
border-radius:8px;
width:220px;
box-shadow:0 5px 15px rgba(0,0,0,0.4);
}

.notif-dropdown.active{
display:block;
}

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

.profile:hover .dropdown{
display:block;
}

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
position:relative;
}

.menu a:hover{
background:#334155;
}

/* 🔴 BADGE */
.badge{
position:absolute;
right:10px;
top:10px;
background:red;
color:white;
font-size:10px;
padding:2px 6px;
border-radius:50%;
}

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
}

.main{
flex:1;
padding:80px 40px 40px 40px;
max-width:1200px;
margin:auto;
}

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
}

.card i{
font-size:28px;
color:#f59e0b;
}

/* 🔥 ATTENDANCE BOX */
.request-box{
background:#1e293b;
padding:20px;
border-radius:12px;
margin-top:30px;
}

.request-item{
border-bottom:1px solid #334155;
padding:10px 0;
}

.btn{
padding:5px 10px;
border-radius:6px;
text-decoration:none;
color:white;
font-size:12px;
}

.approve{background:#10b981;}
.reject{background:#ef4444;}

</style>
</head>

<body>

<!-- TOPBAR -->
<div class="topbar">
<div class="top-icons">

<div class="bell" onclick="toggleNotifications()">
<i class="fas fa-bell"></i>

<?php if($pendingCount > 0): ?>
<span><?php echo $pendingCount; ?></span>
<?php endif; ?>

<div class="notif-dropdown" id="notifBox">
<?php if($pendingCount > 0): ?>
<p><?php echo $pendingCount; ?> Attendance Requests</p>
<?php else: ?>
<p>No new notifications</p>
<?php endif; ?>
</div>

</div>

<div class="profile">
<img src="https://ui-avatars.com/api/?name=<?php echo $_SESSION['name']; ?>">
<div class="dropdown">
<a href="#">Profile</a>
<a href="logout.php">Logout</a>
</div>
</div>

</div>
</div>

<!-- SIDEBAR -->
<button class="menu-btn" onclick="openMenu()">☰</button>
<div class="overlay" id="overlay" onclick="closeMenu()"></div>

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

<!-- 🔴 ATTENDANCE -->
<a href="#attendance">
<i class="fa fa-check"></i> Attendance
<?php if($pendingCount > 0): ?>
<span class="badge"><?php echo $pendingCount; ?></span>
<?php endif; ?>
</a>

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

<!-- KEEP YOUR ORIGINAL STATS -->
<div class="stats">
<div class="stat"><h2>8</h2><p>Requests</p></div>
<div class="stat"><h2>3</h2><p>Ongoing</p></div>
<div class="stat"><h2>450+</h2><p>Students</p></div>
<div class="stat"><h2>12</h2><p>Reports</p></div>
</div>

<!-- KEEP YOUR ORIGINAL GRID -->
<div class="grid">
<a href="camp_req.php" class="card"><i class="fas fa-bullhorn"></i><h3>Campaigns</h3></a>
<a href="ongoing_event.php" class="card"><i class="fas fa-tasks"></i><h3>Monitor Events</h3></a>
<a href="student_details.php" class="card"><i class="fas fa-users"></i><h3>Student Database</h3></a>
<a href="message_students.php" class="card"><i class="fas fa-paper-plane"></i><h3>Broadcast</h3></a>
</div>

<!-- 🔥 ATTENDANCE SECTION -->
<div id="attendance" class="request-box">

<h2>Attendance Requests</h2>

<?php
$result = $conn->query("
SELECT * FROM faculty_requests 
WHERE faculty_email='$faculty_email' 
ORDER BY id DESC
");

if($result && $result->num_rows > 0){
while($row = $result->fetch_assoc()){
?>

<div class="request-item">
<b><?php echo $row['event_name']; ?></b><br>
Time: <?php echo $row['from_time']; ?> → <?php echo $row['to_time']; ?><br>
Status: <?php echo strtoupper($row['status']); ?><br><br>

<?php if($row['status']=='pending'): ?>
<a href="approve_request.php?id=<?php echo $row['id']; ?>" class="btn approve">Approve</a>
<a href="reject_request.php?id=<?php echo $row['id']; ?>" class="btn reject">Reject</a>
<?php endif; ?>
</div>

<?php
}
}else{
echo "<p>No requests assigned to you</p>";
}
?>

</div>

</div>

<script>
function openMenu(){
document.getElementById("sidebar").classList.add("active");
document.getElementById("overlay").classList.add("active");
}
function closeMenu(){
document.getElementById("sidebar").classList.remove("active");
document.getElementById("overlay").classList.remove("active");
}
function toggleNotifications(){
document.getElementById("notifBox").classList.toggle("active");
}
</script>

</body>
</html>