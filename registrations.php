<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'club_admin') {
    header("Location: login.html");
    exit();
}

$conn = new mysqli("localhost", "root", "", "event_management");

$events = $conn->query("SELECT * FROM events");
?>

<!DOCTYPE html>
<html>
<head>
<title>Registrations</title>

<!-- 🔥 MUST HAVE SAME AS DASHBOARD -->
<link rel="stylesheet" href="assets/globals.css">
<link rel="stylesheet" href="assets/dashboard.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>

<body>

<div class="dashboard-container">

<?php include 'sidebar.php'; ?>

<!-- MAIN -->
<main class="main-content">

<header class="content-header">
  <h1><i class="fas fa-users"></i> Event Registrations</h1>
  <p>View students registered for each event</p>
</header>

<section class="glass-card">

<?php if ($events->num_rows > 0) { ?>

    <?php while ($event = $events->fetch_assoc()) { ?>

        <div style="
            margin-top:20px;
            padding:18px;
            border:1px solid var(--border-color);
            border-radius:10px;
            background: var(--surface-dark);
        ">

            <h3 style="margin-bottom:10px; color: var(--primary);">
                <i class="fas fa-calendar-alt"></i>
                <?php echo htmlspecialchars($event['name']); ?>
            </h3>

            <?php
            $event_id = $event['id'];
            $reg = $conn->query("SELECT * FROM registrations WHERE event_id=$event_id");
            ?>

            <?php if ($reg && $reg->num_rows > 0) { ?>

                <ul style="list-style:none; padding-left:0;">

                <?php while ($r = $reg->fetch_assoc()) { ?>

                    <li style="
                        padding:8px;
                        border-bottom:1px solid var(--border-color);
                        font-size:0.95rem;
                    ">

                        <i class="fas fa-user"></i>
                        <strong><?php echo htmlspecialchars($r['student_name']); ?></strong>

                        | <?php echo htmlspecialchars($r['student_email']); ?>
                        | <?php echo htmlspecialchars($r['department']); ?>

                    </li>

                <?php } ?>

                </ul>

            <?php } else { ?>

                <p style="color:var(--text-muted); margin-top:10px;">
                    No registrations yet
                </p>

            <?php } ?>

        </div>

    <?php } ?>

<?php } else { ?>

    <p>No events found</p>

<?php } ?>

</section>

</main>

</div>

</body>
</html>