<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Achievements | CDG</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/globals.css">
  <style>
    body { padding: 40px; background: var(--bg-dark); }
    .container { max-width: 900px; margin: 60px auto; }
    .back-btn { position: fixed; top: 30px; left: 30px; color: var(--text-muted); font-size: 1.5rem; transition: 0.3s; }
    .back-btn:hover { color: var(--primary); transform: translateX(-5px); }
    .achievement-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 1.5rem; }
    .achievement-card { display: flex; gap: 1.5rem; align-items: center; }
    .trophy-box { 
      width: 70px; height: 70px; background: rgba(245, 158, 11, 0.1); 
      border-radius: 15px; display: flex; align-items: center; justify-content: center;
      font-size: 1.75rem; color: var(--primary); flex-shrink: 0;
    }
    .achievement-info h3 { margin-bottom: 0.25rem; font-weight: 700; }
    .achievement-info p { color: var(--text-muted); font-size: 0.9rem; margin-bottom: 0.5rem; }
    .badge { 
      font-size: 0.75rem; font-weight: 700; background: var(--surface-light); 
      padding: 0.25rem 0.75rem; border-radius: 50px; text-transform: uppercase;
    }
  </style>
</head>
<body>
  <a href="student_dashboard.php" class="back-btn"><i class="fas fa-arrow-left"></i></a>
  <div class="container">
    <h1 style="margin-bottom: 2rem; font-weight: 800;">My Achievements</h1>
    
    <div class="achievement-grid">
      <div class="glass-card achievement-card">
        <div class="trophy-box"><i class="fas fa-trophy"></i></div>
        <div class="achievement-info">
          <h3>First Place - CodeWar 2025</h3>
          <p>Winner of the national level hackathon conducted by IEEE.</p>
          <span class="badge">Technical</span>
        </div>
      </div>

      <div class="glass-card achievement-card">
        <div class="trophy-box"><i class="fas fa-medal"></i></div>
        <div class="achievement-info">
          <h3>Runner Up - Inter-College Cricket</h3>
          <p>Represented college team in the state level tournament.</p>
          <span class="badge">Sports</span>
        </div>
      </div>

      <div class="glass-card achievement-card">
        <div class="trophy-box"><i class="fas fa-star"></i></div>
        <div class="achievement-info">
          <h3>Outstanding Performer</h3>
          <p>Acknowledged for contributing to the college cultural fest.</p>
          <span class="badge">Cultural</span>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
