<aside class="sidebar" id="sidebar">

  <div class="sidebar-header">
    <img src="assets/club_dash_pic.jpeg"
      onerror="this.src='https://ui-avatars.com/api/?name=<?php echo urlencode($_SESSION['name']); ?>'">

    <h3><?php echo htmlspecialchars($_SESSION['name']); ?></h3>

    <p style="font-size:0.8rem; color:var(--text-muted);">
      Club Administrator
    </p>
  </div>

  <nav class="sidebar-nav">

    <a href="clubhead_dashboard.php" class="nav-link">
      <i class="fas fa-home"></i> Dashboard
    </a>

    <a href="create_event.php" class="nav-link">
      <i class="fas fa-plus-circle"></i> Create Event
    </a>

    <a href="manage_events.php" class="nav-link">
      <i class="fas fa-edit"></i> Manage Events
    </a>

    <a href="registrations.php" class="nav-link">
      <i class="fas fa-users"></i> Registrations
    </a>

   <a href="equipment.php" class="nav-link">
  <i class="fas fa-tools"></i> Equipment
    </a>

    <a href="manage_queries.php" class="nav-link">
  <i class="fas fa-question-circle"></i> Queries
</a>

  </nav>

  <div class="sidebar-footer">
    <form action="logout.php" method="post">
      <button type="submit" class="btn btn-outline"
        style="width:100%; border-color:red; color:red;">
        <i class="fas fa-sign-out-alt"></i> Logout
      </button>
    </form>
  </div>

</aside>