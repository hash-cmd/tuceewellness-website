<!-- Sidebar HTML -->
<div class="sidebar">
    <div class="logo">
        <img src="assets/images/TUCEE-Institute-logo.png" alt="Company Logo">
        <h4>Website Controller</h4>
    </div>

    <div class="nav-links">
        <ul>
            <li><a href="/tucee/dashboard" class="nav-item active"><i class="fas fa-home"></i><span>Dashboard</span></a></li>
            <li><a href="/tucee/website" class="nav-item"><i class="fas fa-user"></i><span>Website Controller</span></a></li>
            <li><a href="/tucee/livechat" class="nav-item"><i class="fas fa-user"></i><span>Live Chat</span></a></li>
            <li><a href="/tucee/newuser" class="nav-item"><i class="fas fa-user"></i><span>Users</span></a></li>
            <li><a href="/settings" class="nav-item"><i class="fas fa-cog"></i><span>Settings</span></a></li>
            <li><a href="/auth/logout" class="nav-item logout"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a></li>
        </ul>
    </div>
</div>

<!-- Sidebar CSS -->
<style>
.sidebar {
    position: fixed;
    top: 0;
    left: 0;
    height: 100vh;
    width: 260px;
    background-color: #fff;
    display: flex;
    flex-direction: column;
    z-index: 1000;
    border-right: 1px solid var(--primary);
}

.logo {
    padding: 16px;
    display: flex;
    align-items: center;
    border-bottom: 1px solid #eee;
}

.logo img {
    width: 40px;
    height: auto;
    margin-right: 12px;
}

.logo h4 {
    font-size: 16px;
    font-weight: 600;
    color: #333;
    margin: 0;
}

.nav-links {
    flex: 1;
}

.nav-links ul {
    list-style: none;
    margin: 0;
    padding: 0;
}

.nav-links ul li {
    border-bottom: 1px solid #f2f2f2;
}

.nav-links ul li a {
    display: flex;
    align-items: center;
    padding: 14px 20px;
    color: #333;
    text-decoration: none;
    transition: background 0.3s, color 0.3s;
}

.nav-links ul li a i {
    margin-right: 12px;
    font-size: 16px;
    color: #666;
}

.nav-links ul li a span {
    font-size: 15px;
}

.nav-links ul li a:hover {
    background-color: var(--primary-light);
    color: #fff;
}

.nav-links ul li a:hover i {
    color: #fff;
}

/* Active item */
.nav-links ul li a.active {
    background-color: var(--primary);
    color: #fff;
    font-weight: 600;
}

.nav-links ul li a.active i {
    color: #fff;
}

/* Logout link styling */
.nav-links .logout {
    color: #d9534f;
}

.nav-links .logout:hover {
    background-color: #d9534f;
    color: #fff;
}
</style>

<!-- Font Awesome for Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
