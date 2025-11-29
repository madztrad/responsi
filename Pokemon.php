<?php
// KONSEP 1: ABSTRACTION (Seperti Modul Hal 21 - abstract class bentuk2D)
// Kita buat kerangka dasar yang tidak bisa dibuat objeknya langsung.
abstract class PokemonDasar {
    // KONSEP 2: ENCAPSULATION (Seperti Modul Hal 7 - private String Nama)
    // Data dilindungi (protected/private) agar tidak diubah sembarangan dari luar.
    protected $nama;
    protected $tipe;
    protected $level;
    protected $darah; // HP
    protected $serangan; // Attack
    protected $pertahanan; // Defense
    protected $kecepatan; // Speed

    // Constructor (Seperti Modul Hal 7 - public Mahasiswa(...))
    public function __construct($nama, $tipe, $level, $darah, $serangan, $pertahanan, $kecepatan) {
        $this->nama = $nama;
        $this->tipe = $tipe;
        $this->level = $level;
        $this->darah = $darah;
        $this->serangan = $serangan;
        $this->pertahanan = $pertahanan;
        $this->kecepatan = $kecepatan;
    }

    // Abstract Method (Seperti Modul Hal 21 - public abstract void cetakLuas())
    // Wajib dibuat ulang oleh class anak
    abstract public function aksiSpesial();

    // Getter Methods (Encapsulation - untuk mengambil data)
    public function getNama() { return $this->nama; }
    public function getTipe() { return $this->tipe; }
    public function getLevel() { return $this->level; }
    public function getDarah() { return $this->darah; }
    public function getSerangan() { return $this->serangan; }
    public function getPertahanan() { return $this->pertahanan; }
    public function getKecepatan() { return $this->kecepatan; }
}

// KONSEP 3: INHERITANCE (Seperti Modul Hal 13 - class SepedaGunung extends Sepeda)
// Pidgeot mewarisi semua sifat dari PokemonDasar
class Pidgeot extends PokemonDasar {
    private $jurus;

    public function __construct($nama, $tipe, $level, $darah, $serangan, $pertahanan, $kecepatan, $jurus) {
        // Memanggil Constructor Induk (Seperti Modul Hal 17 - super(...))
        parent::__construct($nama, $tipe, $level, $darah, $serangan, $pertahanan, $kecepatan);
        $this->jurus = $jurus;
    }

    // KONSEP 4: POLYMORPHISM (Seperti Modul Hal 19 - Method Overriding)
    // Implementasi method abstract dengan cara unik Pidgeot
    public function aksiSpesial() {
        return "{$this->nama} menggunakan jurus andalan **{$this->jurus}**! Angin ribut menerjang!";
    }

    // Method Latihan Sederhana (Logic tambah-tambah nilai seperti Modul Hal 3)
    public function latihan($jenis) {
        if ($jenis == "Terbang") {
            $this->kecepatan = $this->kecepatan + 5; // Tambah speed
            $this->level = $this->level + 1;
        } 
        elseif ($jenis == "Bertarung") {
            $this->serangan = $this->serangan + 5; // Tambah attack
            $this->level = $this->level + 1;
        }
        elseif ($jenis == "Bertahan") {
            $this->pertahanan = $this->pertahanan + 5; // Tambah defense
            $this->darah = $this->darah + 20; // Tambah HP
            $this->level = $this->level + 1;
        }

        // Kembalikan pesan sederhana
        return "Latihan $jenis selesai. Level naik menjadi {$this->level}!";
    }

    public function getJurus() { return $this->jurus; }
}
?>