<main>
  <div class="dashboard">
    <div class="sidebar">
      <?php include "layouts/sidebar.php" ?>
    </div>

    <div class="main-content">
      
      <div class="dashboard-header">
        <div class="header-content">
          <div class="user-info">
            <span class="username"><?= htmlspecialchars($_SESSION['user']['name'] ?? 'Guest') ?></span>
           <img src="assets/images/TUCEE-Institute-logo.png" alt="User Image" class="user-image">
          </div>
        </div>
      </div>

      <div class="form">
        <!-- Error message -->
        <?php if (!empty($error)): ?>
          <div class="error-message">
            <?= htmlspecialchars($error) ?>
          </div>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
          <div class="success-message">
            <?= htmlspecialchars($success) ?>
          </div>
        <?php endif; ?>

      </div>
    </div>
  </div>
</main>

<style>
  header,
  footer {
    display: none;
  }
</style>