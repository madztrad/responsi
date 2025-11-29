# NAMA : Muhammad Faiz Mubarok
# NIM : H1H024051
# shift awal : C
# shift akhir : B

# Penjelasan

Ini adalah simulasi web sederhana untuk melatih Pokémon, yaitu **Pidgeot**. Pada simulasi ini user bisa melatih stat (Terbang, Bertarung, Bertahan), memantau perubahan status secara realtime, serta melihat riwayat dari latihan yang telah dilakukan.

Simulasi web ini menggunakan **PHP Native** dengan konsep **OOP** (Abstraction, Encapsulation, Inheritance, Polymorphism). Data disimpan sementara menggunakan **Session**.

**Terdapat 5 file utama:**

1.  **Pokemon.php**: Berisi *Abstract Class* `PokemonDasar` dan *Class Turunan* `Pidgeot` yang memuat logika OOP dan perhitungan stat.
2.  **index.php**: Halaman dashboard utama untuk melihat status visual Pidgeot saat ini.
3.  **latihan.php**: Halaman untuk memilih program latihan dan memproses logika peningkatan stat (Level, HP, Attack, dll).
4.  **riwayat.php**: Menampilkan tabel log aktivitas latihan dan fitur reset data.
5.  **style.css**: Mengatur tampilan antarmuka (UI) web termasuk fitur *Dark Mode* (Mode Dewa) saat level > 100.

---

# Cara Menjalankan Program

Karena menggunakan **Laravel Valet**, berikut langkah-langkahnya:
![Image](https://github.com/user-attachments/assets/8740db78-2657-4a21-81df-902487dfa573)
![2025-11-29 15-35-49](https://github.com/user-attachments/assets/d8cbfe2d-afc5-4c69-91f9-556bd56c4cd7)
1.  Pastikan folder project ini berada di dalam direktori "park" Valet Anda (biasanya di `~/Sites` atau `~/code`).
2.  Buka **Terminal**.
3.  Masuk ke direktori project:
    ```bash
    cd nama-folder-project
    ```
4.  Jalankan perintah link (opsional, untuk memastikan domain aktif):
    ```bash
    valet link
    ```
5.  Buka browser dan akses alamat (sesuai nama folder):
    ```
    [http://nama-folder-project.test](http://nama-folder-project.test)
    ```
     
    live preview bisa dilihat di https://responsi.athafa.my.id/
   

