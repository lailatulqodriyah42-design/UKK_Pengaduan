<div class="card p-4">
    <h3>Kelola Kategori</h3>
    <form method="post" class="input-group mb-3">
        <input name="nama" class="form-control" placeholder="Nama Kategori Baru" required>
        <button name="add_kat" class="btn btn-primary">Tambah</button>
    </form>
    <table class="table">
        <?php $k=q("SELECT * FROM kategori"); while($r=mysqli_fetch_assoc($k)): ?>
        <tr><td><?= $r['ket_kategori'] ?></td><td><a href="?page=kategori&del_kat=<?= $r['id_kategori'] ?>" class="btn btn-danger btn-sm">Hapus</a></td></tr>
        <?php endwhile; ?>
    </table>
</div>