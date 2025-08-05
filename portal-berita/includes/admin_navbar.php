<nav>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin.css">
</nav>
    <div class="container">
        <a class="navbar-brand" href="../index.php">Portal Berita</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="adminNavbar">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="tambah_berita.php">Tambah Berita</a>
                </li>
            </ul>
            <div class="navbar-nav">
                <span class="nav-link">Halo, <?= $_SESSION['admin_username'] ?? 'Admin' ?></span>
                <a class="nav-link" href="logout.php">Logout</a>
            </div>
        </div>
    </div>
</nav>