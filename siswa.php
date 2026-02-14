<div class="card p-4">
    <h3>Data Siswa</h3>
    <table class="table">
        <thead><tr><th>NIS</th><th>Kelas (Password)</th><th>Aksi</th></tr></thead>
        <?php $s=q("SELECT * FROM siswa"); while($r=mysqli_fetch_assoc($s)): ?>
        <tr>
            <td><?= $r['nis'] ?></td>
            <td>
                <form method="post" class="input-group shadow-none">
                    <input type="hidden" name="nis" value="<?= $r['nis'] ?>">
                    <input name="kelas" class="form-control form-control-sm" value="<?= $r['kelas'] ?>">
                    <button name="edit_siswa" class="btn btn-sm btn-warning">Update</button>
                </form>
            </td>
            <td><a href="?page=siswa&del_siswa=<?= $r['nis'] ?>" class="btn btn-danger btn-sm">Hapus</a></td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>