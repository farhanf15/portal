<?php
session_start();
include '../includes/config.php';
include '../includes/functions.php';

if (!isAdmin()) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $query = "DELETE FROM berita WHERE id = $id";
    mysqli_query($conn, $query);
    header("Location: dashboard.php?success=Berita berhasil dihapus");
    exit();
}

$berita = getBerita();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="../index.php">Portal Berita</a>
            <div class="navbar-nav">
                <a class="nav-link" href="dashboard.php">Dashboard</a>
                <a class="nav-link" href="../index.php">Home</a>
                <a class="nav-link" href="tambah_berita.php">Tambah Berita</a>
                <a class="nav-link" href="logout.php">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h2>Dashboard Admin</h2>
        
        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success"><?= htmlspecialchars($_GET['success']) ?></div>
        <?php endif; ?>
        
        <div class="card mt-3">
            <div class="card-header">
                <h4>Daftar Berita</h4>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Judul</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($berita)): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= htmlspecialchars($row['judul']) ?></td>
                            <td><?= date('d M Y', strtotime($row['tanggal_publikasi'])) ?></td>
                            <td>
                                <a href="../berita_detail.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-info">Lihat</a>
                                <a href="tambah_berita.php?edit=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="dashboard.php?delete=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>