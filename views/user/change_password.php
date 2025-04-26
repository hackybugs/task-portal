<h2>Change Password</h2>
<?php if (!empty($error)): ?>
    <p style="color: red;"><?= $error ?></p>
<?php endif; ?>
<form method="POST" action="?page=change_password">
    <label>New Password</label><br>
    <input type="password" name="new_password" required><br><br>

    <label>Confirm Password</label><br>
    <input type="password" name="confirm_password" required><br><br>

    <button type="submit">Change Password</button>
</form>