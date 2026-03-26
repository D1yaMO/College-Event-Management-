<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Notifications | CDG</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/globals.css">
  <style>
    body { padding: 40px; background: var(--bg-dark); }
    .container { max-width: 800px; margin: 60px auto; }
    .back-btn { position: fixed; top: 30px; left: 30px; color: var(--text-muted); font-size: 1.5rem; transition: 0.3s; }
    .back-btn:hover { color: var(--primary); transform: translateX(-5px); }
    .notification-card {
      margin-bottom: 1.25rem;
      border-left: 4px solid var(--primary);
      display: flex;
      align-items: flex-start;
      gap: 1.25rem;
      animation: slideIn 0.5s ease-out;
    }
    @keyframes slideIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    .icon-box {
      width: 48px;
      height: 48px;
      background: rgba(245, 158, 11, 0.1);
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--primary);
      flex-shrink: 0;
    }
    .content h4 { margin-bottom: 0.25rem; font-weight: 700; }
    .content p { color: var(--text-muted); font-size: 0.9rem; }
  </style>
</head>
<body>
  <a href="student_dashboard.php" class="back-btn"><i class="fas fa-arrow-left"></i></a>
  <div class="container">
    <h1 style="margin-bottom: 2rem; font-weight: 800;">Notifications</h1>
    
    <div class="glass-card notification-card">
      <div class="icon-box"><i class="fas fa-calendar-alt"></i></div>
      <div class="content">
        <h4>Tech Fest 2026 Registration</h4>
        <p>Registration for the annual technical symposium is now open for all departments.</p>
      </div>
    </div>

    <div class="glass-card notification-card">
      <div class="icon-box"><i class="fas fa-check-circle"></i></div>
      <div class="content">
        <h4>Registration Confirmed</h4>
        <p>Your participation for "Coding Competition" has been confirmed. See you there!</p>
      </div>
    </div>

    <div class="glass-card notification-card">
      <div class="icon-box"><i class="fas fa-users"></i></div>
      <div class="content">
        <h4>Club Meeting</h4>
        <p>A mandatory meeting for all technical club members is scheduled tomorrow at 2 PM.</p>
      </div>
    </div>
  </div>
</body>
</html>
