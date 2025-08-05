document.addEventListener('DOMContentLoaded', function() {
    // Preview gambar sebelum upload
    const gambarInput = document.getElementById('gambar');
    const imagePreview = document.createElement('div');
    imagePreview.id = 'imagePreview';
    imagePreview.innerHTML = '<p>Preview:</p><img src="" alt="Preview Gambar" class="img-thumbnail">';
    gambarInput.parentNode.appendChild(imagePreview);
    
    gambarInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.style.display = 'block';
                imagePreview.querySelector('img').src = e.target.result;
                
                // Jika ada gambar lama, sembunyikan checkbox hapus
                const hapusCheckbox = document.getElementById('hapus_gambar');
                if (hapusCheckbox) {
                    hapusCheckbox.checked = false;
                }
            }
            reader.readAsDataURL(file);
        } else {
            imagePreview.style.display = 'none';
        }
    });
    
    // Validasi form sebelum submit
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function(e) {
            const gambar = document.getElementById('gambar');
            const hapusGambar = document.getElementById('hapus_gambar');
            
            // Jika tidak ada gambar baru dan ingin menghapus yang lama
            if (hapusGambar && hapusGambar.checked && gambar.files.length === 0) {
                if (!confirm('Anda yakin ingin menghapus gambar ini?')) {
                    e.preventDefault();
                    return false;
                }
            }
            
            // Validasi ukuran file
            if (gambar.files.length > 0) {
                const fileSize = gambar.files[0].size / 1024 / 1024; // in MB
                if (fileSize > 2) {
                    alert('Ukuran file terlalu besar (maksimal 2MB)');
                    e.preventDefault();
                    return false;
                }
            }
        });
    }
});