<?php
session_start();

/* DB CONNECTION */
$conn = new mysqli("localhost", "root", "", "event_management");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

/* HANDLE APPROVE / REJECT */
if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $action = $_GET['action'];

    if ($action == "approve") {
        $conn->query("UPDATE campaign_requests SET status='approved' WHERE id=$id");
    } elseif ($action == "reject") {
        $conn->query("UPDATE campaign_requests SET status='rejected' WHERE id=$id");
    }

    header("Location: camp_req.php");
    exit();
}

/* FILTER */
$status = isset($_GET['status']) ? $_GET['status'] : 'pending';

/* FETCH DATA */
$result = $conn->query("SELECT * FROM campaign_requests WHERE status='$status'");

if (!$result) {
    die("Query Error: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Campaign Requests</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>

body{
margin:0;
font-family:'Segoe UI';
background:#0f172a;
color:white;
}

/* BACK BUTTON */
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

/* TITLE */
h2{
text-align:center;
margin-bottom:25px;
}

/* FILTER BUTTONS */
.filters{
text-align:center;
margin-bottom:20px;
}

.filters a{
margin:5px;
padding:8px 14px;
border-radius:6px;
text-decoration:none;
font-weight:bold;
}

.pending{background:#f59e0b; color:black;}
.approved{background:#22c55e; color:white;}
.rejected{background:#ef4444; color:white;}

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
table-layout:fixed;
}

th,td{
padding:14px;
text-align:center;
}

th{
background:#f59e0b;
color:black;
}

tr{
border-bottom:1px solid #334155;
}

/* COLUMN WIDTH */
th:nth-child(1), td:nth-child(1){ width:30%; }
th:nth-child(2), td:nth-child(2){ width:25%; }
th:nth-child(3), td:nth-child(3){ width:20%; }
th:nth-child(4), td:nth-child(4){ width:25%; }

/* ACTION BUTTONS */
.actions{
display:flex;
justify-content:center;
gap:10px;
}

.approve-btn{
background:#22c55e;
padding:6px 12px;
border-radius:6px;
color:white;
text-decoration:none;
}

.reject-btn{
background:#ef4444;
padding:6px 12px;
border-radius:6px;
color:white;
text-decoration:none;
}

/* STATUS BADGE */
.status{
padding:5px 10px;
border-radius:6px;
font-size:13px;
}

.status.pending{background:#f59e0b;}
.status.approved{background:#22c55e;}
.status.rejected{background:#ef4444;}

/* EMPTY */
.message{
padding:20px;
color:#9ca3af;
}

</style>

</head>

<body>

<a class="back" href="faculty_dashboard.php">
<i class="fas fa-arrow-left"></i>
</a>

<div class="container">

<h2>Campaign Requests</h2>

<!-- FILTER BUTTONS -->
<div class="filters">
<a href="?status=pending" class="pending">Pending</a>
<a href="?status=approved" class="approved">Approved</a>
<a href="?status=rejected" class="rejected">Rejected</a>
</div>

<div class="card">

<table>

<tr>
<th>Event</th>
<th>Club</th>
<th>Date</th>
<th>Action</th>
</tr>

<?php if($result && $result->num_rows > 0): ?>

<?php while($row = $result->fetch_assoc()): ?>

<tr>
<td><?php echo htmlspecialchars($row['event_name']); ?></td>
<td><?php echo htmlspecialchars($row['club_name']); ?></td>
<td><?php echo htmlspecialchars($row['event_date']); ?></td>

<td>
<?php if($status == 'pending'): ?>
<div class="actions">
<a class="approve-btn" href="?action=approve&id=<?php echo $row['id']; ?>">Approve</a>
<a class="reject-btn" href="?action=reject&id=<?php echo $row['id']; ?>">Reject</a>
</div>
<?php else: ?>
<span class="status <?php echo $row['status']; ?>">
<?php echo ucfirst($row['status']); ?>
</span>
<?php endif; ?>
</td>
</tr>

<?php endwhile; ?>

<?php else: ?>

<tr>
<td colspan="4" class="message">No records found 🎉</td>
</tr>

<?php endif; ?>

</table>

</div>

</div>

</body>
</html>