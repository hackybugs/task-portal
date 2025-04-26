<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Task Portal</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <?php if ($_SESSION['role'] === 'admin'): ?>
                    <li class="nav-item"><a class="nav-link" href="?page=admin_dashboard">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="?page=create_user">Create User</a></li>
                    <li class="nav-item"><a class="nav-link" href="?page=user_list">Users</a></li>
                    <li class="nav-item"><a class="nav-link" href="?page=task_list">Task List</a></li>
                    <li class="nav-item"><a class="nav-link" href="?page=report">Download Report</a></li>
                <?php elseif ($_SESSION['role'] === 'user'): ?>
                    <li class="nav-item"><a class="nav-link" href="?page=user_dashboard">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="?page=create_task">Create Task</a></li>
                <?php endif; ?>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="?page=logout">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>
