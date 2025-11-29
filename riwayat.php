<?php
session_start();

date_default_timezone_set('Asia/Jakarta');

if (isset($_GET['hapus'])) {
    unset($_SESSION['riwayat']);
    unset($_SESSION['pidgeot_data']);
    header("Location: index.php");
    exit;
}

$riwayat = $_SESSION['riwayat'] ?? [];

$data_poke = $_SESSION['pidgeot_data'] ?? ['level' => 1];
$level_saat_ini = $data_poke['level'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Log Aktivitas</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="<?php echo ($level_saat_ini > 100) ? 'mode-dewa' : ''; ?>">

    <header style="display: flex; justify-content: space-between; align-items: center;">
        <h1><i class="fas fa-file-medical-alt"></i> Log Aktivitas</h1>
        
        <div id="jam-digital" class="realtime-clock">--:--:--</div>
    </header>

    <main class="container">
        <div class="card">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h3><i class="fas fa-list"></i> Riwayat Pelatihan</h3>
                
                <?php if (!empty($riwayat)): ?>
                <a href="riwayat.php?hapus=1" class="btn btn-secondary btn-reset" style="font-size: 0.8rem; border-color: red; color: red;" onclick="return confirm('PERINGATAN: Ini akan mereset Level Pidgeot kembali ke awal juga. Lanjutkan?')">
                    <i class="fas fa-trash"></i> Reset Total (Level & Log)
                </a>
                <?php endif; ?>
            </div>

            <?php if (empty($riwayat)): ?>
                <div style="text-align: center; padding: 40px; color: #999;">
                    <i class="fas fa-wind" style="font-size: 3rem; margin-bottom: 10px; display: block;"></i>
                    <p>Belum ada data latihan.</p>
                </div>
            <?php else: ?>
            
            <div class="table-responsive">
                <table style="width:100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background:#eee;">
                            <th style="padding:10px; text-align:left;">Waktu</th>
                            <th style="padding:10px; text-align:left;">Aktivitas</th>
                            <th style="padding:10px; text-align:left;">Efek Visual</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach (array_reverse($riwayat) as $r): ?>
                        <tr style="border-bottom: 1px solid #eee;">
                            <td style="padding:10px; font-weight:bold;"><?php echo $r['waktu']; ?></td>
                            <td style="padding:10px;"><?php echo $r['ket']; ?></td>
                            <td style="padding:10px; font-style:italic;"><?php echo $r['aksi']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php endif; ?>
        </div>

        <div class="navigation-buttons">
            <a href="index.php" class="btn btn-secondary">⬅️ Dashboard</a>
            <a href="latihan.php" class="btn btn-primary">🏋️‍♂️ Latihan Lagi</a>
        </div>
    </main>

    <script>
        function updateJam() {
            const sekarang = new Date();
            const waktu = sekarang.toLocaleTimeString('id-ID', { hour12: false });
            document.getElementById('jam-digital').innerText = waktu + " WIB";
        }
        setInterval(updateJam, 1000);
        updateJam();
    </script>
</body>
</html>