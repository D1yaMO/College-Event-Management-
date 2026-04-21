<?php
session_start();

$conn = new mysqli("localhost","root","","event_management");

if ($conn->connect_error) {
    die("Connection failed");
}

if (!isset($_SESSION['email'])) {
    header("Location: login.html");
    exit();
}

$email = $_SESSION['email'];

$stmt = $conn->prepare("
    SELECT name, email, role, department 
    FROM users 
    WHERE email=?
");

$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

$user = $result->fetch_assoc();

// fallback safety
$dept = $user['department'] ?? 'Not Set';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Student Profile</title>

  <link rel="stylesheet" href="assets/globals.css">

  <style>
    body {
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      background: var(--bg-dark);
      padding: 2rem;
      font-family: Inter;
    }

    .card {
      width: 500px;
      padding: 2.5rem;
    }

    .title {
      text-align: center;
      margin-bottom: 2rem;
      font-size: 1.5rem;
      font-weight: 800;
    }

    .grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 1rem;
    }

    .item {
      padding: 1rem;
      border: 1px solid var(--border-color);
      border-radius: 10px;
      background: rgba(255,255,255,0.03);
    }

    .label {
      font-size: 0.7rem;
      color: var(--text-muted);
      text-transform: uppercase;
    }

    .value {
      font-weight: 600;
      margin-top: 5px;
    }

    .full {
      grid-column: span 2;
    }
  </style>
</head>

<body>

<div class="glass-card card">

  <div class="title">Student Profile</div>

  <div class="grid">

    <div class="item full">
      <div class="label">Name</div>
      <div class="value"><?= htmlspecialchars($user['name']) ?></div>
    </div>

    <div class="item full">
      <div class="label">Email</div>
      <div class="value"><?= htmlspecialchars($user['email']) ?></div>
    </div>

    <div class="item">
      <div class="label">Role</div>
      <div class="value"><?= htmlspecialchars($user['role']) ?></div>
    </div>

    <div class="item">
      <div class="label">Department</div>
      <div class="value"><?= htmlspecialchars($dept) ?></div>
    </div>

  </div>

</div>

</body>
</html>
