<?php
require_once 'Pokemon.php';
session_start();
date_default_timezone_set('Asia/Jakarta'); 

$d = $_SESSION['pidgeot_data'] ?? [
    'nama' => 'Pidgeot', 'tipe' => 'Normal', 'level' => 36, 
    'hp' => 1200, 'atk' => 2800, 'def' => 2650, 'spd' => 3100
];

$burung = new Pidgeot($d['nama'], $d['tipe'], $d['level'], $d['hp'], $d['atk'], $d['def'], $d['spd'], "Hurricane");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Dashboard Pidgeot</title>
    <link rel="stylesheet" href="style.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="<?php echo ($burung->getLevel() > 100) ? 'mode-dewa' : ''; ?>">
    
    <header style="display: flex; justify-content: space-between; align-items: center;">
        <h1><i class="fas fa-feather-alt"></i> Pidgeot Training</h1>
        <div id="jam-digital" class="realtime-clock">--:--:--</div>
    </header>

    <main class="container">
        <div class="card">
            <div class="profile-grid">
                <div class="pokemon-avatar">
                    <img src="https://img.pokemondb.net/sprites/home/normal/pidgeot.png" alt="Pidgeot">
                    <h2><?php echo $burung->getNama(); ?></h2>
                    <span class="badge"><?php echo $burung->getTipe(); ?></span>
                </div>

                <div class="pokemon-stats">
                    <div class="section-title">Status Utama</div>
                    
                    <div class="stat-row">
                        <div class="stat-label">Level <?php echo $burung->getLevel(); ?></div>
                        <div class="progress-bg">
                            <div class="progress-fill exp-fill" style="width: <?php echo min($burung->getLevel(), 100); ?>%;"></div>
                        </div>
                    </div>

                    <div class="stat-row">
                        <div class="stat-label">HP <?php echo $burung->getDarah(); ?></div>
                        <div class="progress-bg">
                            <div class="progress-fill hp-fill" style="width: <?php echo min(($burung->getDarah()/2000)*100, 100); ?>%;"></div>
                        </div>
                    </div>

                    <div class="combat-grid">
                        <div class="stat-box"><div><h4>Attack</h4><p><?php echo $burung->getSerangan(); ?></p></div><i class="fas fa-sword"></i></div>
                        <div class="stat-box"><div><h4>Defense</h4><p><?php echo $burung->getPertahanan(); ?></p></div><i class="fas fa-shield-alt"></i></div>
                        <div class="stat-box"><div><h4>Speed</h4><p><?php echo $burung->getKecepatan(); ?></p></div><i class="fas fa-bolt"></i></div>
                        <div class="stat-box"><div><h4>Skill</h4><p style="font-size:0.9rem"><?php echo $burung->getJurus(); ?></p></div><i class="fas fa-star"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="navigation-buttons">
            <a href="latihan.php" class="btn btn-primary">Latih Pidgeot</a>
            <a href="riwayat.php" class="btn btn-secondary">Lihat Riwayat</a>
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