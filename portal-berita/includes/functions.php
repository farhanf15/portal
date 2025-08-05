<?php
include 'config.php';

function getBerita() {
    global $conn;
    $query = "SELECT * FROM berita ORDER BY tanggal_publikasi DESC";
    $result = mysqli_query($conn, $query);
    return $result;
}

function getBeritaById($id) {
    global $conn;
    $id = intval($id);
    $query = "SELECT * FROM berita WHERE id = $id";
    $result = mysqli_query($conn, $query);
    
    if (!$result || mysqli_num_rows($result) === 0) {
        return false;
    }
    
    return mysqli_fetch_assoc($result);
}

function deleteBeritaImage($filename) {
    $upload_dir = "../uploads/";
    $file_path = $upload_dir . $filename;
    
    if (file_exists($file_path)) {
        return unlink($file_path);
    }
    
    return false;
}

function getBeritaPopuler($limit = 5) {
    global $conn;
    $query = "SELECT * FROM berita WHERE is_populer = 1 AND status = 'published' ORDER BY views DESC LIMIT $limit";
    return mysqli_query($conn, $query);
}

function getBeritarecommended($limit = 5) {
    global $conn;
    $query = "SELECT * FROM berita WHERE is_recommended = 1 AND status = 'published' ORDER BY tanggal_publikasi DESC LIMIT $limit";
    return mysqli_query($conn, $query);
}

function isAdmin() {
    return isset($_SESSION['admin']) && $_SESSION['admin'] == true;
}

function searchBerita($keyword) {
    global $conn;
    $keyword = mysqli_real_escape_string($conn, $keyword);
    $query = "SELECT * FROM berita 
              WHERE judul LIKE '%$keyword%' 
              OR isi LIKE '%$keyword%'
              OR penulis LIKE '%$keyword%'
              ORDER BY tanggal_publikasi DESC";
    return mysqli_query($conn, $query);
}

?>