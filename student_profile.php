<?php
session_start();
if (!isset($_SESSION['name'])) {
    header("Location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Profile | CDG</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/globals.css">
  <style>
    body {
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 2rem;
      background: radial-gradient(circle at top right, rgba(245, 158, 11, 0.1), transparent), var(--bg-dark);
    }

    .profile-card {
      width: 100%;
      max-width: 500px;
      padding: 3rem;
      position: relative;
    }

    .back-btn {
      position: absolute;
      top: 1.5rem;
      left: 1.5rem;
      color: var(--text-muted);
      font-size: 1.25rem;
    }

    .back-btn:hover {
      color: var(--primary);
    }

    .profile-header {
      text-align: center;
      margin-bottom: 2.5rem;
    }

    .profile-header img {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      border: 4px solid var(--primary);
      margin-bottom: 1rem;
      box-shadow: 0 0 20px rgba(245, 158, 11, 0.2);
    }

    .profile-header h2 {
      font-size: 1.75rem;
      font-weight: 800;
      margin-bottom: 0.25rem;
    }

    .profile-header p {
      color: var(--primary);
      font-weight: 600;
      font-size: 0.9rem;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    .info-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 1.25rem;
    }

    .info-item {
      background: rgba(255, 255, 255, 0.03);
      padding: 1rem;
      border-radius: 12px;
      border: 1px solid var(--border-color);
    }

    .info-label {
      font-size: 0.75rem;
      font-weight: 700;
      color: var(--text-muted);
      text-transform: uppercase;
      letter-spacing: 0.5px;
      display: block;
      margin-bottom: 0.25rem;
    }

    .info-value {
      font-size: 1rem;
      font-weight: 600;
      color: var(--text-main);
    }

    .edit-profile {
      margin-top: 2.5rem;
      width: 100%;
    }
  </style>
</head>
<body>

<div class="glass-card profile-card">
  <a href="student_dashboard.php" class="back-btn">
    <i class="fas fa-arrow-left"></i>
  </a>

  <div class="profile-header">
    <img src="assets/student.png" alt="Profile" onerror="this.src='https://ui-avatars.com/api/?name=<?php echo $_SESSION['name']; ?>&background=f59e0b&color=fff'">
    <h2><?php echo htmlspecialchars($_SESSION['name']); ?></h2>
    <p>Engineering Student</p>
  </div>

  <div class="info-grid">
    <div class="info-item">
      <span class="info-label">USN / ID</span>
      <span class="info-value">1MV23CS001</span>
    </div>
    <div class="info-item">
      <span class="info-label">Phone</span>
      <span class="info-value">+91 98765 43210</span>
    </div>
    <div class="info-item">
      <span class="info-label">Department</span>
      <span class="info-value">CSE</span>
    </div>
    <div class="info-item">
      <span class="info-label">Section</span>
      <span class="info-value">A</span>
    </div>
    <div class="info-item">
      <span class="info-label">Year</span>
      <span class="info-value">3rd Year</span>
    </div>
    <div class="info-item">
      <span class="info-label">Location</span>
      <span class="info-value">Bangalore</span>
    </div>
  </div>

  <button class="btn btn-primary edit-profile" onclick="editProfile()">
    <i class="fas fa-edit"></i> Edit Profile
  </button>
</div>

<script>
  function editProfile() {
    const newName = prompt("Enter your new name:", "<?php echo htmlspecialchars($_SESSION['name']); ?>");
    if (newName && newName !== "<?php echo $_SESSION['name']; ?>") {
      alert("Profile update functionality would go here. Name: " + newName);
    }
  }
</script>

</body>
</html>
