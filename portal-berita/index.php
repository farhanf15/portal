<?php
session_start();
include 'includes/config.php';
include 'includes/functions.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Berita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
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
                    </div>

                    <form class="d-flex me-3" action="search.php" method="get">
                        <div class="input-group">
                            <input type="text" class="form-control" name="q" placeholder="Cari berita..." aria-label="Search">
                            <button class="btn btn-outline-light" type="submit">Cari</button>
                        </div>
                    </form>
        </div>
    </div>
</nav>
    <div class="container mt-4">
        <h1 class="text-center mb-4">Berita Terkini</h1>
        
        <div class="row">
            <?php
            $berita = getBerita();
            if (mysqli_num_rows($berita) > 0):
                while ($row = mysqli_fetch_assoc($berita)):
            ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <?php if ($row['gambar']): ?>
                            <img src="uploads/<?= htmlspecialchars($row['gambar']) ?>" class="card-img-top" alt="<?= htmlspecialchars($row['judul']) ?>">
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($row['judul']) ?></h5>
                            <p class="card-text"><?= substr(htmlspecialchars($row['isi']), 0, 100) ?>...</p>
                            <a href="berita_detail.php?id=<?= $row['id'] ?>" class="btn btn-primary">Baca Selengkapnya</a>
                        </div>
                        <div class="card-footer text-muted">
                            Dipublikasikan pada <?= date('d M Y H:i', strtotime($row['tanggal_publikasi'])) ?> oleh <?= htmlspecialchars($row['penulis']) ?>
                        </div>
                    </div>
                </div>
            <?php
                endwhile;
            else:
            ?>
                <div class="col-12">
                    <div class="alert alert-info">Tidak ada berita yang tersedia.</div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</body>
<?php include 'includes/footer.php'; ?>
</html>