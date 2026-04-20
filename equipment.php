<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'club_admin') {
    header("Location: login.html");
    exit();
}

$conn = new mysqli("localhost", "root", "", "event_management");

if ($conn->connect_error) {
    die("DB Error");
}

if (isset($_POST['send_request'])) {

    $event = $_POST['event_name'];
    $item = $_POST['item_name'];
    $qty = $_POST['quantity'];
    $notes = $_POST['notes'];
    $user = $_SESSION['name'];

    $stmt = $conn->prepare("
        INSERT INTO equipment_requests
        (event_name, item_name, quantity, notes, requested_by)
        VALUES (?, ?, ?, ?, ?)
    ");

    $stmt->bind_param("ssiss", $event, $item, $qty, $notes, $user);
    $stmt->execute();

    header("Location: equipment.php?success=1");
    exit();
}

$events = $conn->query("SELECT * FROM events");
?>

<!DOCTYPE html>
<html>
<head>
<title>Equipment Requests</title>

<link rel="stylesheet" href="assets/globals.css">
<link rel="stylesheet" href="assets/dashboard.css">

<!-- Font Awesome (icons) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<!-- ✅ FIX: Inter font (this is what your dashboard uses) -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<body>

<div class="dashboard-container">

<?php include 'sidebar.php'; ?>

<main class="main-content">

<section class="glass-card" style="max-width:700px;">

<h2>
    <i class="fas fa-tools" style="color:var(--primary);"></i>
    Equipment Request
</h2>

<?php if(isset($_GET['success'])) { ?>
    <p style="color:lightgreen; margin-top:10px;">
        Request sent successfully!
    </p>
<?php } ?>

<form method="POST" style="display:flex; flex-direction:column; gap:1rem; margin-top:1rem;">

    <select name="event_name" required>
        <option value="">Select Event</option>
        <?php while($e = $events->fetch_assoc()) { ?>
            <option value="<?php echo htmlspecialchars($e['name']); ?>">
                <?php echo htmlspecialchars($e['name']); ?>
            </option>
        <?php } ?>
    </select>

    <input type="text" name="item_name" placeholder="Equipment Item" required>

    <input type="number" name="quantity" placeholder="Quantity" required>

    <textarea name="notes" placeholder="Notes (optional)"></textarea>

    <button type="submit" name="send_request" class="btn btn-primary">
        Send Request
    </button>

</form>

</section>

</main>

</div>

</body>
</html>