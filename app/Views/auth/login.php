<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <?php if (isset($error)): ?>
        <p style="color: red;"><?= $error ?></p>
    <?php endif; ?>

   <form id="loginForm" method="post" action="<?= site_url('login') ?>">
        <label for="role">Role:</label>
        <select id="role" name="role" onchange="updateFormAction()">
            <option value="">Select Role</option>
            <option value="admin">Admin</option>
            <option value="agent">Agent</option>
        </select>
        <br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>

        <button type="submit">Login</button>
    </form>

    <script>
       function updateFormAction() {
    const roleSelect = document.getElementById('role');
    const loginForm = document.getElementById('loginForm');
    const role = roleSelect.value;

    if (role === 'admin') {
        loginForm.action = '<?= site_url('login/admin') ?>';
    } else if (role === 'agent') {
        loginForm.action = '<?= site_url('login/agent') ?>';
    } else {
        loginForm.action = '<?= site_url('login') ?>'; // Mengembalikan ke action default
    }
}
    </script>
</body>
</html>