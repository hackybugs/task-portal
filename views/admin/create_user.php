<h2>Create User</h2>
<form method="POST" action="?page=create_user">
    <label>First Name</label><br>
    <input type="text" name="first_name" required><br><br>

    <label>Last Name</label><br>
    <input type="text" name="last_name" required><br><br>

    <label>Email</label><br>
    <input type="email" name="email" required><br><br>

    <label>Phone</label><br>
    <input type="text" name="phone" required><br><br>

    <label>Password</label><br>
    <div style="position: relative; display: inline-block;">
        <input type="password" name="password" id="manualPassword" required>
        <span id="togglePassword" style="position: absolute; right: 10px; top: 8px; cursor: pointer;">view</span>
    </div>
    <br><br>
    <input type="checkbox" id="autoGenerate"> Auto-generate password<br><br>

    <button type="submit">Create User</button>
</form>
<script>
 const passwordField = document.getElementById('manualPassword');
    const togglePassword = document.getElementById('togglePassword');
    const autoCheckbox = document.getElementById('autoGenerate');

    togglePassword.addEventListener('click', function () {
        const type = passwordField.type === 'password' ? 'text' : 'password';
        passwordField.type = type;
        this.textContent = type === 'password' ? '👁️' : '🙈';
    });

    autoCheckbox.addEventListener('change', function () {
        if (this.checked) {
            const autoPassword = Math.random().toString(36).slice(-8);
            passwordField.value = autoPassword;
            passwordField.readOnly = true;
        } else {
            passwordField.value = '';
            passwordField.readOnly = false;
        }
    });

</script>