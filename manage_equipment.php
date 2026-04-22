<?php
session_start();

$conn = new mysqli("localhost", "root", "", "event_management");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

/* HANDLE ACTIONS */
if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $action = $_GET['action'];

    if ($action == "approve") {
        $conn->query("UPDATE equipment_requests SET status='approved' WHERE id=$id");
    } elseif ($action == "reject") {
        $conn->query("UPDATE equipment_requests SET status='rejected' WHERE id=$id");
    }
}

/* HANDLE STATUS UPDATE */
if (isset($_POST['update_status'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];

    $conn->query("UPDATE equipment_requests SET status='$status' WHERE id=$id");
}

/* FETCH DATA */
$result = $conn->query("SELECT * FROM equipment_requests");
?>

<!DOCTYPE html>
<html>
<head>

<title>Manage Equipment</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>

body{
margin:0;
font-family:'Segoe UI';
background:#0f172a;
color:white;
}

/* BACK */
.back{
position:fixed;
top:20px;
left:20px;
color:white;
background:#1e293b;
padding:8px 12px;
border-radius:8px;
text-decoration:none;
}

/* CONTAINER */
.container{
max-width:1000px;
margin:80px auto;
}

/* CARD */
.card{
background:#1e293b;
padding:20px;
border-radius:12px;
}

/* TABLE */
table{
width:100%;
border-collapse:collapse;
}

th,td{
padding:12px;
text-align:center;
border-bottom:1px solid #334155;
}

th{
background:#f59e0b;
color:black;
}

/* BUTTONS */
.approve{
background:#22c55e;
padding:6px 10px;
color:white;
border-radius:5px;
text-decoration:none;
}

.reject{
background:#ef4444;
padding:6px 10px;
color:white;
border-radius:5px;
text-decoration:none;
}

select{
padding:5px;
border-radius:5px;
}

button{
padding:6px 10px;
background:#f59e0b;
border:none;
border-radius:5px;
cursor:pointer;
}

</style>

</head>

<body>

<a href="faculty_dashboard.php" class="back">
<i class="fa fa-arrow-left"></i>
</a>

<div class="container">

<h2 style="text-align:center;">Manage Equipment</h2>

<div class="card">

<table>

<tr>
<th>Club</th>
<th>Equipment</th>
<th>Qty</th>
<th>Status</th>
<th>Action</th>
<th>Update</th>
</tr>

<?php while($row = $result->fetch_assoc()): ?>

<tr>
<td><?php echo $row['club_name']; ?></td>
<td><?php echo $row['equipment_name']; ?></td>
<td><?php echo $row['quantity']; ?></td>
<td><?php echo $row['status']; ?></td>

<td>
<a class="approve" href="?action=approve&id=<?php echo $row['id']; ?>">Approve</a>
<a class="reject" href="?action=reject&id=<?php echo $row['id']; ?>">Reject</a>
</td>

<td>
<form method="post">
<input type="hidden" name="id" value="<?php echo $row['id']; ?>">

<select name="status">
<option>pending</option>
<option>approved</option>
<option>issued</option>
<option>returned</option>
</select>

<button name="update_status">Update</button>
</form>
</td>

</tr>

<?php endwhile; ?>

</table>

</div>

</div>

</body>
</html>