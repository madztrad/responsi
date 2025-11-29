<?php
require_once 'Pokemon.php';
session_start();

date_default_timezone_set('Asia/Jakarta');

$d = $_SESSION['pidgeot_data'] ?? [
    'nama' => 'Pidgeot', 'tipe' => 'Normal', 'level' => 36, 
    'hp' => 1200, 'atk' => 2800, 'def' => 2650, 'spd' => 3100
];

$burung = new Pidgeot($d['nama'], $d['tipe'], $d['level'], $d['hp'], $d['atk'], $d['def'], $d['spd'], "Hurricane");
$pesan = "";
$efek_visual = "";

if (isset($_POST['tombol_latih'])) {
    $jenis = $_POST['jenis_latihan'];
    
    $sebelum = [
        'lvl' => $burung->getLevel(),
        'hp' => $burung->getDarah(),
        'atk' => $burung->getSerangan(),
        'def' => $burung->getPertahanan(),
        'spd' => $burung->getKecepatan()
    ];

    $pesan = $burung->latihan($jenis);
    
    if($jenis == "Terbang") $efek_visual = "⚡ Speed Up!";
    if($jenis == "Bertarung") $efek_visual = "⚔️ Attack Up!";
    if($jenis == "Bertahan") $efek_visual = "🛡️ Defense Up!";

    $_SESSION['pidgeot_data'] = [
        'nama' => $burung->getNama(),
        'tipe' => $burung->getTipe(),
        'level' => $burung->getLevel(),
        'hp' => $burung->getDarah(),
        'atk' => $burung->getSerangan(),
        'def' => $burung->getPertahanan(),
        'spd' => $burung->getKecepatan()
    ];

    $_SESSION['riwayat'][] = [
        'waktu' => date("H:i:s"),
        'ket' => "Latihan $jenis (Lvl {$sebelum['lvl']} -> {$burung->getLevel()})",
        'aksi' => $burung->aksiSpesial()
    ];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Training Center</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="<?php echo ($burung->getLevel() > 100) ? 'mode-dewa' : ''; ?>">
    <header style="display: flex; justify-content: space-between; align-items: center;">
        <h1><i class="fas fa-dumbbell"></i> Training Center</h1>
        
        <div id="jam-digital" class="realtime-clock">--:--:--</div>
    </header>

    <main class="container">
        <?php if($pesan != ""): ?>
        <div class="card" style="background: #d4edda; border-color: #c3e6cb; margin-bottom: 20px;">
            <div style="color: #155724;">
                <h3><i class="fas fa-check-circle"></i> Latihan Selesai!</h3>
                <p><strong><?php echo $efek_visual; ?></strong> - <?php echo $pesan; ?></p>
            </div>
        </div>
        <?php endif; ?>

        <div class="training-grid">
            <div class="card">
                <h3><i class="fas fa-clipboard-list"></i> Program Latihan</h3>
                <p style="color:#666; margin-bottom:20px;">Pilih fokus latihan.</p>
                <form method="POST">
                    <div class="form-group" style="margin-bottom: 20px;">
                        <select name="jenis_latihan" class="form-control" style="width:100%; padding:12px;">
                            <option value="Terbang">🌪️ Latihan Terbang (+Speed)</option>
                            <option value="Bertarung">⚔️ Latihan Tarung (+Attack)</option>
                            <option value="Bertahan">🛡️ Latihan Fisik (+Def & HP)</option>
                        </select>
                    </div>
                    <button type="submit" name="tombol_latih" class="btn btn-primary" style="width:100%; padding:15px;">
                        MULAI LATIHAN <i class="fas fa-arrow-right"></i>
                    </button>
                </form>
                <br>
                <a href="index.php" class="btn btn-secondary" style="display:block; text-align:center;">Kembali Dashboard</a>
            </div>

            <div class="card">
                <h3><i class="fas fa-chart-line"></i> Live Stats Monitor</h3>
                <div class="stat-monitor-list">
                    <div class="stat-monitor-item border-atk">
                        <span><i class="fas fa-sword" style="color:#e74c3c;"></i> Attack</span>
                        <span class="stat-value"><?php echo $burung->getSerangan(); ?> <?php if(isset($jenis) && $jenis == "Bertarung") echo "<span class='change-indicator'>(+5)</span>"; ?></span>
                    </div>
                    <div class="stat-monitor-item border-def">
                        <span><i class="fas fa-shield-alt" style="color:#3498db;"></i> Defense</span>
                        <span class="stat-value"><?php echo $burung->getPertahanan(); ?> <?php if(isset($jenis) && $jenis == "Bertahan") echo "<span class='change-indicator'>(+5)</span>"; ?></span>
                    </div>
                    <div class="stat-monitor-item border-spd">
                        <span><i class="fas fa-bolt" style="color:#f1c40f;"></i> Speed</span>
                        <span class="stat-value"><?php echo $burung->getKecepatan(); ?> <?php if(isset($jenis) && $jenis == "Terbang") echo "<span class='change-indicator'>(+5)</span>"; ?></span>
                    </div>
                    <div class="stat-monitor-item border-hp">
                        <span><i class="fas fa-heart" style="color:#2ecc71;"></i> HP</span>
                        <span class="stat-value"><?php echo $burung->getDarah(); ?> <?php if(isset($jenis) && $jenis == "Bertahan") echo "<span class='change-indicator'>(+20)</span>"; ?></span>
                    </div>
                </div>
            </div>
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