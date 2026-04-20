<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'club_admin') {
    header("Location: login.html");
    exit();
}

$conn = new mysqli("localhost", "root", "", "event_management");

if ($conn->connect_error) {
    die("DB connection failed");
}

/* ✅ HANDLE REPLY */
if (isset($_POST['reply_submit'])) {

    $id = $_POST['query_id'];
    $reply = $_POST['reply'];

    $stmt = $conn->prepare("
        UPDATE queries 
        SET reply = ?, status = 'replied'
        WHERE id = ?
    ");

    if ($stmt) {
        $stmt->bind_param("si", $reply, $id);
        $stmt->execute();
    }

    header("Location: manage_queries.php");
    exit();
}

/* ✅ FETCH QUERIES */
$queries = $conn->query("SELECT * FROM queries ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>Manage Queries</title>

<link rel="stylesheet" href="assets/globals.css">
<link rel="stylesheet" href="assets/dashboard.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
textarea {
  width: 100%;
  padding: 10px;
  border-radius: 8px;
  border: 1px solid var(--border-color);
  background: var(--surface-dark);
  color: white;
}

.query-card {
  padding: 15px;
  margin-bottom: 15px;
  border: 1px solid var(--border-color);
  border-radius: 10px;
  background: rgba(255,255,255,0.03);
}
</style>

</head>

<body>

<div class="dashboard-container">

<?php include 'sidebar.php'; ?>

<main class="main-content">

<header class="content-header">
  <h1>Queries 📩</h1>
  <p>Messages from students and faculty</p>
</header>

<section class="glass-card">

<?php if ($queries && $queries->num_rows > 0) { ?>

    <?php while ($row = $queries->fetch_assoc()) { ?>

        <div class="query-card">

            <!-- NAME + ROLE TAG -->
            <p style="display:flex; align-items:center; gap:10px;">

                <strong><?php echo htmlspecialchars($row['sender_name']); ?></strong>

                <?php if ($row['sender_role'] == 'student') { ?>
                    <span style="
                        background:#3b82f6;
                        color:white;
                        padding:3px 10px;
                        border-radius:6px;
                        font-size:12px;
                    ">
                        Student
                    </span>
                <?php } else { ?>
                    <span style="
                        background:#f59e0b;
                        color:black;
                        padding:3px 10px;
                        border-radius:6px;
                        font-size:12px;
                    ">
                        Faculty
                    </span>
                <?php } ?>

            </p>

            <!-- MESSAGE -->
            <p style="margin-top:8px;">
                <?php echo htmlspecialchars($row['message']); ?>
            </p>

            <!-- STATUS -->
            <p style="margin-top:8px; color:gray;">
                Status: <?php echo htmlspecialchars($row['status']); ?>
            </p>

            <!-- REPLY DISPLAY -->
            <?php if (!empty($row['reply'])) { ?>
                <p style="margin-top:10px; color:#10b981;">
                    <strong>Reply:</strong>
                    <?php echo htmlspecialchars($row['reply']); ?>
                </p>
            <?php } ?>

            <!-- REPLY FORM -->
            <form method="POST"
                  style="margin-top:10px; display:flex; flex-direction:column; gap:10px;">

                <input type="hidden" name="query_id"
                       value="<?php echo $row['id']; ?>">

                <textarea name="reply"
                          placeholder="Write your reply..."
                          required></textarea>

                <button type="submit" name="reply_submit"
                        class="btn btn-primary">
                    Send Reply
                </button>

            </form>

        </div>

    <?php } ?>

<?php } else { ?>

    <p style="color:var(--text-muted);">No queries yet</p>

<?php } ?>

</section>

</main>

</div>

</body>
</html>