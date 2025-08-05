<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">Portal Berita</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : '' ?>" href="index.php">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'populer.php' ? 'active' : '' ?>" href="populer.php">Populer</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'rekomendasi.php' ? 'active' : '' ?>" href="rekomendasi.php">Rekomendasi</a>
                </li>
            </ul>
            <div class="navbar-nav">
                <?php if (isAdmin()): ?>
                    <a class="nav-link" href="admin/dashboard.php">Dashboard Admin</a>
                    <a class="nav-link" href="admin/logout.php">Logout</a>
                    <?php else: ?>
                        <a class="nav-link" href="admin/login.php">Login Admin</a>
                        <?php endif; ?>
            <form class="d-flex me-3" action="search.php" method="get">
                <div class="input-group">
                    <input type="text" class="form-control" name="q" placeholder="Cari berita..." aria-label="Search">
                        <button class="btn btn-outline-light" type="submit">Cari</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</nav>