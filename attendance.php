<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Attendance | CDG</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/globals.css">
  <style>
    body { padding: 40px; background: var(--bg-dark); }
    .container { max-width: 900px; margin: 60px auto; }
    .back-btn { position: fixed; top: 30px; left: 30px; color: var(--text-muted); font-size: 1.5rem; transition: 0.3s; }
    .back-btn:hover { color: var(--primary); transform: translateX(-5px); }
    .subject-card { margin-bottom: 1.5rem; }
    .subject-header { display: flex; justify-content: space-between; margin-bottom: 1rem; }
    .subject-name { font-weight: 700; font-size: 1.1rem; }
    .percentage { color: var(--primary); font-weight: 800; }
    .progress-bg { background: rgba(255,255,255,0.05); height: 12px; border-radius: 6px; overflow: hidden; }
    .progress-bar { height: 100%; border-radius: 6px; transition: width 1s ease-in-out; }
    .good { background: linear-gradient(90deg, #10b981, #34d399); }
    .warning { background: linear-gradient(90deg, #f59e0b, #fbbf24); }
    .danger { background: linear-gradient(90deg, #ef4444, #f87171); }
    .details { display: flex; justify-content: space-between; margin-top: 0.75rem; font-size: 0.85rem; color: var(--text-muted); }
  </style>
</head>
<body>
  <a href="student_dashboard.php" class="back-btn"><i class="fas fa-arrow-left"></i></a>
  <div class="container">
    <h1 style="margin-bottom: 2rem; font-weight: 800;">Subject Attendance</h1>
    
    <div class="glass-card subject-card">
      <div class="subject-header">
        <span class="subject-name">Data Structures & Algorithms</span>
        <span class="percentage">85%</span>
      </div>
      <div class="progress-bg"><div class="progress-bar good" style="width: 85%"></div></div>
      <div class="details"><span>Attended: 34</span><span>Total Classes: 40</span></div>
    </div>

    <div class="glass-card subject-card">
      <div class="subject-header">
        <span class="subject-name">Machine Learning</span>
        <span class="percentage">74%</span>
      </div>
      <div class="progress-bg"><div class="progress-bar warning" style="width: 74%"></div></div>
      <div class="details"><span>Attended: 26</span><span>Total Classes: 35</span></div>
    </div>

    <div class="glass-card subject-card">
      <div class="subject-header">
        <span class="subject-name">Cloud Computing</span>
        <span class="percentage">66%</span>
      </div>
      <div class="progress-bg"><div class="progress-bar danger" style="width: 66%"></div></div>
      <div class="details"><span>Attended: 20</span><span>Total Classes: 30</span></div>
    </div>

    <div class="glass-card subject-card">
      <div class="subject-header">
        <span class="subject-name">Software Engineering</span>
        <span class="percentage">87%</span>
      </div>
      <div class="progress-bg"><div class="progress-bar good" style="width: 87%"></div></div>
      <div class="details"><span>Attended: 28</span><span>Total Classes: 32</span></div>
    </div>
  </div>
</body>
</html>
