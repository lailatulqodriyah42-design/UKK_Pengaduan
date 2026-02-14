<div class="card p-4 shadow-sm">
    <h3 class="mb-4 text-primary">Status Laporan Aspirasi</h3>
    
    <?php 
    // Query mengambil data aspirasi milik siswa yang sedang login
    $user_now = $_SESSION['user'];
    $query_histori = "SELECT ia.*, ap.status, ap.feedback 
                      FROM input_aspirasi ia 
                      LEFT JOIN aspirasi ap ON ia.id_pelaporan = ap.id_pelaporan 
                      WHERE ia.nis = '$user_now' 
                      ORDER BY ia.id_pelaporan DESC";
    
    $h = q($query_histori);
    
    if(mysqli_num_rows($h) > 0) {
        while($r = mysqli_fetch_assoc($h)){ 
            // Cek status, jika kosong beri nilai default
            $status_tampil = isset($r['status']) ? $r['status'] : 'Menunggu Antrian';
            $feedback_tampil = !empty($r['feedback']) ? $r['feedback'] : 'Admin belum memberikan tanggapan';
            
            // Menentukan warna badge berdasarkan status
            $warna_badge = 'warning';
            if($status_tampil == 'Selesai') {
                $warna_badge = 'success';
            } elseif($status_tampil == 'Proses') {
                $warna_badge = 'info text-white';
            }
    ?>
            <div class="border rounded p-3 mb-3 bg-white shadow-sm">
                <div class="d-flex justify-content-between align-items-start">
                    <h5><b>Lokasi: <?php echo $r['lokasi']; ?></b></h5>
                    <span class="badge bg-secondary"><?php echo $r['waktu']; ?></span>
                </div>
                <p class="text-muted mt-2"><?php echo $r['ket']; ?></p>
                
                <div class="mt-2 p-3 bg-light rounded border">
                    <div class="mb-2">
                        <strong>Status:</strong> 
                        <span class="badge bg-<?php echo $warna_badge; ?>">
                            <?php echo $status_tampil; ?>
                        </span>
                    </div>
                    <div>
                        <strong>Feedback dari Admin:</strong><br>
                        <span class="text-primary italic">
                            <?php echo $feedback_tampil; ?>
                        </span>
                    </div>
                </div>
            </div>
    <?php 
        } 
    } else {
        echo "<div class='alert alert-info'>Anda belum pernah mengirim aspirasi.</div>";
    }
    ?>
</div>