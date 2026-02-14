<div class="card p-4">
    <h3>Data Admin</h3>
    <form method="post" class="row g-2 mb-3">
        <div class="col"><input name="username" class="form-control" placeholder="Username" required></div>
        <div class="col"><input name="password" class="form-control" placeholder="Password" required></div>
        <div class="col-auto"><button name="add_admin" class="btn btn-primary">Tambah</button></div>
    </form>
    <table class="table">
        <?php $a=q("SELECT * FROM admin"); while($r=mysqli_fetch_assoc($a)): ?>
        <tr>
            <td><?= $r['username'] ?></td>
            <td>
                <form method="post" class="input-group">
                    <input type="hidden" name="id_admin" value="<?= $r['id_admin'] ?>">
                    <input name="password" class="form-control form-control-sm" value="<?= $r['password'] ?>">
                    <button name="edit_admin" class="btn btn-sm btn-warning">Update</button>
                </form>
            </td>
            <td><a href="?page=user_admin&del_admin=<?= $r['id_admin'] ?>" class="btn btn-danger btn-sm">Hapus</a></td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>