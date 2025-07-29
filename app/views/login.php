<main>
    <div class="login-page">
        <form class="login-form" method="POST" action="auth">
            <div class="logo-container">
                <img src="/tucee/assets/images/favicon.ico" alt="TUCEE Logo">
            </div>

            <h4>TUCEE Website Data Center</h4>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>

            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>

            <button type="submit">Login</button>
        </form>
    </div>
</main>

<style>
header,
footer {
  display: none;
}
</style>
