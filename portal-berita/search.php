<?php
session_start();
include 'includes/config.php';
include 'includes/functions.php';

$search_query = isset($_GET['q']) ? mysqli_real_escape_string($conn, $_GET['q']) : '';
$page_title = "Hasil Pencarian: " . htmlspecialchars($search_query);
$query = "SELECT * FROM berita 
          WHERE judul LIKE '%$search_query%' 
          OR isi LIKE '%$search_query%' 
          OR penulis LIKE '%$search_query%'
          ORDER BY tanggal_publikasi DESC";
$search_results = mysqli_query($conn, $query);
$total_results = mysqli_num_rows($search_results);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .search-highlight {
            background-color: yellow;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <?php include 'includes/navbar.php'; ?>
    
    <div class="container mt-4">
        <h2 class="mb-4"><?= $page_title ?></h2>
        
        <?php if($total_results > 0): ?>
            <p class="text-muted">Ditemukan <?= $total_results ?> hasil</p>
            
            <div class="list-group">
                <?php while($row = mysqli_fetch_assoc($search_results)): 
                    $highlighted_judul = preg_replace("/($search_query)/i", "<span class='search-highlight'>$1</span>", htmlspecialchars($row['judul']));
                    $highlighted_isi = preg_replace("/($search_query)/i", "<span class='search-highlight'>$1</span>", htmlspecialchars(substr($row['isi'], 0, 200)));
                ?>
                <a href="berita_detail.php?id=<?= $row['id'] ?>" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1"><?= $highlighted_judul ?></h5>
                        <small class="text-muted"><?= date('d M Y', strtotime($row['tanggal_publikasi'])) ?></small>
                    </div>
                    <p class="mb-1"><?= $highlighted_isi ?>...</p>
                    <small class="text-muted">Oleh: <?= htmlspecialchars($row['penulis']) ?></small>
                    <?php if($row['gambar']): ?>
                        <img src="uploads/<?= htmlspecialchars($row['gambar']) ?>" class="img-thumbnail mt-2" style="max-height: 100px;">
                    <?php endif; ?>
                </a>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <div class="alert alert-warning">
                Tidak ditemukan hasil untuk "<?= htmlspecialchars($search_query) ?>". Coba dengan kata kunci lain.
            </div>
            <div class="mt-4">
                <h4>Berita Terbaru</h4>
                <?php 
                $latest_news = getBerita();
                include 'includes/news_grid.php'; 
                ?>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</body>
<?php include 'includes/footer.php'; ?>
</html>