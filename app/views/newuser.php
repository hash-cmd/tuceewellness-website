<?php
$error = $error ?? null;
$success = $success ?? null;
$users = $users ?? [];
$editUser = $editUser ?? null;
?>

<main>
  <div class="dashboard">
    <div class="sidebar">
      <?php include "layouts/sidebar.php" ?>
    </div>

    <div class="main-content">
      <div class="dashboard-header">
        <div class="header-content">
          <div class="user-info">
            <span class="username">John Doe</span>
            <img src="assets/images/profile.jpg" alt="User Image" class="user-image">
          </div>
        </div>
      </div>

      <div class="page-name">
        <h2>Website Content</h2>
      </div>

      <?php if (!empty($error)): ?>
        <div class="error-message"><?= htmlspecialchars($error) ?></div>
      <?php endif; ?>

      <?php if (!empty($success)): ?>
        <div class="success-message"><?= htmlspecialchars($success) ?></div>
      <?php endif; ?>

      <div class="content-wrapper">
        <!-- USERS TABLE -->
        <div class="users-table">
          <h2>All Users</h2>
          <input type="text" id="searchInput" placeholder="Search users..." class="search-box" />

          <table>
            <thead>
              <tr>
                <th>Full Name</th>
                <th>Email</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($users as $user): ?>
              <tr>
                <td><?= htmlspecialchars($user['name']) ?></td>
                <td><?= htmlspecialchars($user['email']) ?></td>
                <td>
                  <a href="?edit=<?= urlencode($user['email']) ?>" class="edit-btn">Edit</a>
                  <a href="?delete=<?= urlencode($user['email']) ?>" class="delete-btn" onclick="return confirm('Delete user?')">Delete</a>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>

        <!-- FORM -->
        <div class="form">
          <h2><?= $editUser ? 'Edit User' : 'Add New User' ?></h2>

          

          <form action="" method="POST" class="signup-form">
            <div class="form-group">
              <label for="name">Full Name</label>
              <input type="text" id="name" name="name" required value="<?= $editUser ? htmlspecialchars($editUser['name']) : '' ?>">
            </div>

            <div class="form-group">
              <label for="email">Email Address</label>
              <input type="email" id="email" name="email" required value="<?= $editUser ? htmlspecialchars($editUser['email']) : '' ?>" <?= $editUser ? 'readonly' : '' ?>>
            </div>

            <?php if (!$editUser): ?>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
              <label for="confirm_password">Confirm Password</label>
              <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <?php endif; ?>

            <button type="submit"><?= $editUser ? 'Update User' : 'Register' ?></button>
          </form>
        </div>
      </div>
    </div>
  </div>
</main>

<!-- JS -->
<script>
document.getElementById("searchInput").addEventListener("keyup", function () {
  const filter = this.value.toLowerCase();
  const rows = document.querySelectorAll(".users-table tbody tr");
  rows.forEach(row => {
    const text = row.innerText.toLowerCase();
    row.style.display = text.includes(filter) ? "" : "none";
  });
});
</script>

<!-- CSS -->
<style>
header, footer {
  display: none;
}

.content-wrapper {
  display: flex;
  gap: 30px;
  flex-wrap: wrap;
}

/* Users table */
.users-table {
  flex: 2;
  min-width: 300px;
  background-color: #fff;
  padding: 25px;
  border-radius: 10px;
  margin-bottom: 40px;
  box-shadow: 0 1px 6px rgba(0, 0, 0, 0.05);
}

.users-table h2 {
  margin-bottom: 15px;
  color: #100c35;
  font-size: 20px;
}

.search-box {
  width: 100%;
  padding: 10px;
  margin-bottom: 15px;
  border-radius: 6px;
  border: 1px solid #ccc;
  font-size: 14px;
}

.users-table table {
  width: 100%;
  border-collapse: collapse;
  font-size: 14px;
}

.users-table th, .users-table td {
  padding: 12px;
  text-align: left;
  border-bottom: 1px solid #eee;
}

.users-table th {
  background-color: #f4f4f4;
}

.edit-btn, .delete-btn {
  font-size: 13px;
  padding: 6px 12px;
  border-radius: 4px;
  text-decoration: none;
  margin-right: 6px;
  display: inline-block;
}

.edit-btn {
  background-color: #007bff;
  color: white;
}

.delete-btn {
  background-color: #dc3545;
  color: white;
  border: none;
}

/* User Form */
.form {
  flex: 1;
  min-width: 280px;
  background-color: #fff;
  padding: 25px;
  border-radius: 10px;
  box-shadow: 0 1px 6px rgba(0, 0, 0, 0.05);
}

.form h2 {
  font-size: 20px;
  color: #100c35;
  margin-bottom: 20px;
}

.signup-form .form-group {
  margin-bottom: 20px;
}

.signup-form label {
  display: block;
  margin-bottom: 6px;
  font-weight: 500;
  font-size: 14px;
  color: #333;
}

.signup-form input {
  width: 100%;
  padding: 10px;
  font-size: 14px;
  border-radius: 6px;
  border: 1px solid #ccc;
  background-color: #fafafa;
}

.signup-form input:focus {
  outline: none;
  border-color: #100c35;
  background-color: #fff;
}

.signup-form button {
  width: 100%;
  padding: 12px;
  background-color: #100c35;
  color: #fff;
  font-weight: 600;
  font-size: 15px;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  transition: background-color 0.3s ease;
  margin-top: 10px;
}

.signup-form button:hover {
  background-color: #1a1459;
}
</style>
