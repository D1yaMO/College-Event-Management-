<?php
session_start();
$conn = new mysqli("localhost","root","","event_management");

$id = $_GET['id'];

// FETCH DATA
$result = $conn->query("SELECT * FROM events WHERE id=$id");
$row = $result->fetch_assoc();

// UPDATE EVENT
if (isset($_POST['update'])) {
    $name = $_POST['event_name'];
    $date = $_POST['event_date'];
    $venue = $_POST['venue'];
    $desc = $_POST['description'];

    $conn->query("UPDATE events 
                  SET name='$name', event_date='$date', venue='$venue', description='$desc' 
                  WHERE id=$id");

    header("Location: manage_events.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Event</title>
<link rel="stylesheet" href="assets/dashboard.css">
</head>

<body style="padding:2rem;">

<h2>Edit Event</h2>

<form method="POST" style="display:flex; flex-direction:column; gap:1rem; width:300px;">

<input type="text" name="event_name" value="<?php echo $row['name']; ?>" required>

<input type="date" name="event_date" value="<?php echo $row['event_date']; ?>" required>

<input type="text" name="venue" value="<?php echo $row['venue']; ?>" required>

<textarea name="description"><?php echo $row['description']; ?></textarea>

<button type="submit" name="update">Update Event</button>

</form>

</body>
</html>