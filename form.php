<div class="card p-4">
    <h3>Input Aspirasi Baru</h3>
    <form method="post">
        <div class="mb-3">
            <label>Kategori</label>
            <select name="id_kategori" class="form-select">
                <?php $k=q("SELECT * FROM kategori"); while($r=mysqli_fetch_assoc($k)) echo "<option value='$r[id_kategori]'>$r[ket_kategori]</option>"; ?>
            </select>
        </div>
        <input name="lokasi" class="form-control mb-3" placeholder="Lokasi Kejadian" required>
        <textarea name="ket" class="form-control mb-3" placeholder="Detail Aspirasi" rows="4" required></textarea>
        <button name="kirim" class="btn btn-primary">Kirim</button>
    </form>
</div>