<?php
session_start();
require '../includes/config.php';
require '../includes/functions.php';

if (!isAdmin()) {
    header("Location: login.php");
    exit();
}

$error = '';
$edit_mode = false;
$berita = [
    'judul' => '',
    'isi' => '',
    'penulis' => '',
    'gambar' => '',
    'kategori' => 'pendidikan',
    'status' => 'published',
    'is_populer' => 0,
    'is_recommended' => 0
];

if (isset($_GET['edit'])) {
    $id = intval($_GET['edit']);
    $berita = getBeritaById($id);
    
    if (!$berita) {
        $_SESSION['error'] = "Berita tidak ditemukan";
        header("Location: dashboard.php");
        exit();
    }
    $edit_mode = true;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['simpan'])) {
    $judul = trim(mysqli_real_escape_string($conn, $_POST['judul']));
    $isi = trim(mysqli_real_escape_string($conn, $_POST['isi']));
    $penulis = trim(mysqli_real_escape_string($conn, $_POST['penulis']));
    $kategori = isset($_POST['kategori']) ? mysqli_real_escape_string($conn, $_POST['kategori']) : 'pendidikan';
    $status = isset($_POST['status']) ? mysqli_real_escape_string($conn, $_POST['status']) : 'published';
    $is_populer = isset($_POST['is_populer']) ? 1 : 0;
    $is_recommended = isset($_POST['is_recommended']) ? 1 : 0;
    

    if (empty($judul) || empty($isi) || empty($penulis)) {
        $error = "Judul, isi, dan penulis tidak boleh kosong!";
    } else {
        $gambar = $edit_mode ? $berita['gambar'] : null;
        if ($edit_mode && isset($_POST['hapus_gambar']) && !empty($berita['gambar'])) {
            $old_image_path = "../uploads/" . $berita['gambar'];
            if (file_exists($old_image_path)) {
                unlink($old_image_path);
            }
            $gambar = null;
        }
        
        if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
            $upload_dir = "../uploads/";
            $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
            $max_size = 2 * 1024 * 1024; // 2MB
            
            $file_info = $_FILES['gambar'];
            
            if (!in_array($file_info['type'], $allowed_types)) {
                $error = "Hanya file JPG, PNG, atau GIF yang diperbolehkan.";
            } 
            elseif ($file_info['size'] > $max_size) {
                $error = "Ukuran file terlalu besar (maksimal 2MB).";
            } 
            else {
                $ext = pathinfo($file_info['name'], PATHINFO_EXTENSION);
                $filename = uniqid('img_') . '.' . $ext;
                $target_path = $upload_dir . $filename;
                
                if (move_uploaded_file($file_info['tmp_name'], $target_path)) {
                    if ($edit_mode && !empty($berita['gambar']) && file_exists($upload_dir . $berita['gambar'])) {
                        unlink($upload_dir . $berita['gambar']);
                    }
                    $gambar = $filename;
                } else {
                    $error = "Gagal mengupload gambar.";
                }
            }
        }
        
        if (empty($error)) {
            if ($edit_mode) {
                $query = "UPDATE berita SET 
                          judul = '$judul', 
                          isi = '$isi', 
                          penulis = '$penulis',
                          kategori = '$kategori',
                          status = '$status',
                          is_populer = $is_populer,
                          is_recommended = $is_recommended,
                          gambar = " . ($gambar ? "'$gambar'" : "NULL") . "
                          WHERE id = " . $berita['id'];
            } else {
                $query = "INSERT INTO berita 
                          (judul, isi, gambar, penulis, kategori, status, is_populer, is_recommended) 
                          VALUES 
                          ('$judul', '$isi', " . ($gambar ? "'$gambar'" : "NULL") . ", '$penulis', '$kategori', '$status', $is_populer, $is_recommended)";
            }
            
            if (mysqli_query($conn, $query)) {
                $_SESSION['success'] = "Berita berhasil " . ($edit_mode ? 'diperbarui' : 'ditambahkan');
                header("Location: dashboard.php");
                exit();
            } else {
                $error = "Error database: " . mysqli_error($conn);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $edit_mode ? 'Edit' : 'Tambah' ?> Berita | Admin Portal Berita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
    <?php include '../includes/admin_navbar.php'; ?>
    
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0"><?= $edit_mode ? 'Edit Berita' : 'Tambah Berita Baru' ?></h3>
                    </div>
                    
                    <div class="card-body">
                        <?php if (!empty($error)): ?>
                            <div class="alert alert-danger"><?= $error ?></div>
                        <?php endif; ?>
                        
                        <form method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="judul" class="form-label">Judul Berita <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="judul" name="judul" 
                                       value="<?= htmlspecialchars($berita['judul']) ?>" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="isi" class="form-label">Isi Berita <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="isi" name="isi" rows="8" 
                                          required><?= htmlspecialchars($berita['isi']) ?></textarea>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="penulis" class="form-label">Penulis <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="penulis" name="penulis" 
                                           value="<?= htmlspecialchars($berita['penulis']) ?>" required>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="kategori" class="form-label">Kategori</label>
                                    <select class="form-select" id="kategori" name="kategori">
                                        <option value="pendidikan" <?= $berita['kategori'] === 'pendidikan' ? 'selected' : '' ?>>Pendidikan</option>
                                        <option value="teknologi" <?= $berita['kategori'] === 'teknologi' ? 'selected' : '' ?>>Teknologi</option>
                                        <option value="ekonomi" <?= $berita['kategori'] === 'ekonomi' ? 'selected' : '' ?>>Ekonomi</option>
                                        <option value="olahraga" <?= $berita['kategori'] === 'olahraga' ? 'selected' : '' ?>>Olahraga</option>
                                        <option value="kesehatan" <?= $berita['kategori'] === 'kesehatan' ? 'selected' : '' ?>>Kesehatan</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select" id="status" name="status">
                                        <option value="published" <?= $berita['status'] === 'published' ? 'selected' : '' ?>>Published</option>
                                        <option value="draft" <?= $berita['status'] === 'draft' ? 'selected' : '' ?>>Draft</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="gambar" class="form-label">Gambar</label>
                                    <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*">
                                    <small class="text-muted">Format: JPG, PNG, GIF (Maks 2MB)</small>
                                </div>
                            </div>
                            
                            <?php if ($edit_mode && !empty($berita['gambar'])): ?>
                                <div class="mb-3">
                                    <label class="form-label">Gambar Saat Ini</label>
                                    <div class="d-flex align-items-center">
                                        <img src="../uploads/<?= htmlspecialchars($berita['gambar']) ?>" 
                                             class="img-thumbnail me-3" style="max-height: 200px;">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="hapus_gambar" name="hapus_gambar">
                                            <label class="form-check-label text-danger" for="hapus_gambar">
                                                Hapus gambar ini
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            
                            <div class="row mt-3">
                                <div class="col-md-6 mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="is_populer" name="is_populer" 
                                               <?= $berita['is_populer'] ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="is_populer">Tandai sebagai Populer</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="is_recommended" name="is_recommended"
                                               <?= $berita['is_recommended'] ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="is_recommended">Tandai sebagai Rekomendasi</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-between mt-4">
                                <a href="dashboard.php" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-left"></i> Kembali
                                </a>
                                <button type="submit" name="simpan" class="btn btn-primary">
                                    <i class="bi bi-save"></i> <?= $edit_mode ? 'Update Berita' : 'Simpan Berita' ?>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/admin.js"></script>
</body>
</html>