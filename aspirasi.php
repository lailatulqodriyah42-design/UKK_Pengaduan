<div class="card p-4">
    <h3 class="mb-3">Laporan Aspirasi</h3>
    
    <form method="get" class="row g-2 mb-4">
        <input type="hidden" name="page" value="aspirasi">
        <div class="col-md-4">
            <input type="date" name="tgl" class="form-control" value="<?php echo isset($_GET['tgl']) ? $_GET['tgl'] : ''; ?>">
        </div>
        <div class="col-md-4">
            <select name="kat_cari" class="form-select">
                <option value="">Semua Kategori</option>
                <?php 
                $kc = q("SELECT * FROM kategori"); 
                while($rk = mysqli_fetch_assoc($kc)) {
                    $selected = (isset($_GET['kat_cari']) && $_GET['kat_cari'] == $rk['id_kategori']) ? 'selected' : '';
                    echo "<option value='$rk[id_kategori]' $selected>$rk[ket_kategori]</option>"; 
                }
                ?>
            </select>
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary w-100">Filter</button>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Tgl/NIS</th>
                    <th>Aspirasi</th>
                    <th>Tanggapan & Status</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $where = " WHERE 1=1 ";
                if(!empty($_GET['tgl'])) {
                    $tgl = mysqli_real_escape_string($conn, $_GET['tgl']);
                    $where .= " AND DATE(ia.waktu) = '$tgl' ";
                }
                if(!empty($_GET['kat_cari'])) {
                    $kat = mysqli_real_escape_string($conn, $_GET['kat_cari']);
                    $where .= " AND ia.id_kategori = '$kat' ";
                }

                $res = q("SELECT ia.*, ap.status, ap.feedback 
                          FROM input_aspirasi ia 
                          LEFT JOIN aspirasi ap ON ia.id_pelaporan = ap.id_pelaporan 
                          $where 
                          ORDER BY ia.id_pelaporan DESC");

                if(mysqli_num_rows($res) > 0) {
                    while($rh = mysqli_fetch_assoc($res)): 
                ?>
                <tr>
                    <td>
                        <small class="text-muted"><?php echo $rh['waktu']; ?></small><br>
                        <strong>NIS: <?php echo $rh['nis']; ?></strong>
                    </td>
                    <td>
                        <span class="badge bg-info text-dark mb-1"><?php echo $rh['lokasi']; ?></span><br>
                        <?php echo $rh['ket']; ?>
                    </td>
                    <td>
                        <form method="post" class="bg-light p-2 rounded">
                            <input type="hidden" name="id_pelaporan" value="<?php echo $rh['id_pelaporan']; ?>">
                            <input name="feedback" class="form-control form-control-sm mb-1" 
                                   placeholder="Feedback" value="<?php echo isset($rh['feedback']) ? $rh['feedback'] : ''; ?>">
                            <div class="input-group">
                                <select name="status" class="form-select form-select-sm">
                                    <option value="Menunggu" <?php echo ($rh['status'] == 'Menunggu' || is_null($rh['status'])) ? 'selected' : ''; ?>>Menunggu</option>
                                    <option value="Proses" <?php echo ($rh['status'] == 'Proses') ? 'selected' : ''; ?>>Proses</option>
                                    <option value="Selesai" <?php echo ($rh['status'] == 'Selesai') ? 'selected' : ''; ?>>Selesai</option>
                                </select>
                                <button name="proses" class="btn btn-sm btn-success">Update</button>
                            </div>
                        </form>
                    </td>
                </tr>
                <?php 
                    endwhile; 
                } else {
                    echo "<tr><td colspan='3' class='text-center'>Tidak ada data ditemukan</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>