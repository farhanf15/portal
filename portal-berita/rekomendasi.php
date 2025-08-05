<?php
session_start();
include 'includes/config.php';
include 'includes/functions.php';

$query = "SELECT * FROM berita WHERE is_recommended = 1 ORDER BY tanggal_publikasi DESC"; 
$berita_recommended = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita Rekomendasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'includes/navbar.php'; ?>
    
    <div class="container mt-4">
        <h2 class="mb-4">Berita Rekomendasi</h2>
        
        <div class="row">
            <?php while($row = mysqli_fetch_assoc($berita_recommended)): ?>
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="row g-0">
                        <?php if($row['gambar']): ?>
                        <div class="col-md-4">
                            <img src="uploads/<?= htmlspecialchars($row['gambar']) ?>" class="img-fluid rounded-start" alt="<?= htmlspecialchars($row['judul']) ?>">
                        </div>
                        <?php endif; ?>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($row['judul']) ?></h5>
                                <p class="card-text"><?= substr(htmlspecialchars($row['isi']), 0, 150) ?>...</p>
                                <a href="berita_detail.php?id=<?= $row['id'] ?>" class="btn btn-primary">Baca Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</body>
<?php include 'includes/footer.php'; ?>
</html>