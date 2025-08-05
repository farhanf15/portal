<div class="row">
    <?php while($row = mysqli_fetch_assoc($latest_news)): ?>
    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <?php if($row['gambar']): ?>
                <img src="uploads/<?= htmlspecialchars($row['gambar']) ?>" class="card-img-top" alt="<?= htmlspecialchars($row['judul']) ?>">
            <?php endif; ?>
            <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($row['judul']) ?></h5>
                <p class="card-text"><?= substr(htmlspecialchars($row['isi']), 0, 100) ?>...</p>
                <a href="berita_detail.php?id=<?= $row['id'] ?>" class="btn btn-primary">Baca Selengkapnya</a>
            </div>
            <div class="card-footer text-muted">
                <?= date('d M Y', strtotime($row['tanggal_publikasi'])) ?>
            </div>
        </div>
    </div>
    <?php endwhile; ?>
</div>