# SPESIFIKASI KEBUTUHAN PERANGKAT LUNAK SKRIPDOWN

**Versi 0.2**

**Universitas Muhammadiyah Malang**

**Dipersiapkan oleh Malik Pajar Lapele**

**19 Oktober 2020**



## Pendahuluan

Dokumen ini berisi Spesifikasi Kebutuhan Perangkat Lunak (SKPL) atau *Software Requirement Specification* (SRS) untuk **Skripdown** versi 0.2.

Dokumen ini dibuat untuk membantu membuat spesifikasi perangkat lunak yang dikembangkan dengan rancangan berorientasi objek. Pada prinsipnya, hasil analisis sistem perangkat lunak ini sebagai kumpulan diagram dalam bentuk *Unified Modeling Language* (UML) yang tersusun mulai dari rancangan paling umum hingga rancangan detail.

### Tujuan Penulisan Dokumen

Tujuan penulisan dokumen ini yaitu sebagai dokumentasi dari segala aktifitas yang dilakukan selama pengembangan proyek perangkat lunak berbasis web dimulai dari beberapa tahap yaitu tahap penggalian kebutuhan, analisis dan desain, implementasi sampai tahap pengujian. Adapun jabaran tujuan yaitu sebagai berikut :

1. Mendefinisikan dan menjelaskan hal-hal yang diperlukan dalam pengembangan aplikasi **Skripdown** sesuai dengan informasi yang terdapat dalam **KAK** (*Kerangka Acuan Kerja*).
2. Memperjelas detail spesifikasi kebutuhan dan ruang lingkup kerja yang akan dilakukan dalam pengembangan aplikasi **Skripdown** beserta kendala-kendala yang mungkin akan dihadapi.
3. Mendefinisikan dan mendeskripsikan secara global aplikasi **Skripdown** yang akan dikembangkan, yang menggambarkan fungsionalitas, performansi, batasan perancangan, atribut, serta antarmuka eksternal aplikasi yang diimplementasikan.
4. Mempermudah proses pengembangan aplikasi **Skripdown** pada tahap-tahap berikutnya.

Adapun pihak-pihak yang berkepentingan dan berhak menggunakan dokumen SKPL ini adalah :

1. *Malik Fajar Lapele* sebagai **Perancang** dan **Pengembang** aplikasi. Pihak pengembang akan menggunakan *SKPL* ini sebagai acuan dan pedoman dalam mengembangkan aplikasi *Skripdown*.
2. Mahasiswa akhir, dosen pembimbing, staff tata usaha pada jurusan dan Direktorat Penelitian dan Pengabdian Masyarakat (*DPPM*) di Universitas Muhammadiyah Malang sebagai **pengguna** aplikasi. **Pengguna** akan menggunakan dokumen *SKPL* ini untuk melakukan pengecekan atau validasi terhadap kebutuhan-kebutuhan user yang akan diimplementasikan oleh pengembang.

### Lingkup Masalah

Tugas akhir atau skripsi merupakan bagian yang penting pada perguruan tinggi khususnya pendidikan jenjang strata I dan merupakan ruh dari *Tri Dharma Perguruan Tinggi* dimana kualitas penguasaan ilmu mahasiswa di bidang tertentu dapat dilihat lewat karya tulis ilmiah.

Universitas Muhammadiyah Malang adalah salah satu universitas swasta terbaik yang ada di provinsi Jawa Timur. Universitas Muhammadiyah Malang memiliki peranan penting dalam menghasilkan generasi pemimpin yang unggul di bidangnya serta mendorong inovasi baik di lingkungan kampus maupun masyarakat.

Dengan membantu mendorong kemajuan inovasi lewat skripsi, maka Universitas Muhammadiyah Malang memerlukan data dan informasi yang berkaitan dengan penelitian yang dilakukan oleh mahasiswa secara *real-time*. Data dan informasi ini dibutuhkan dalam rangka untuk mengetahui bidang-bidang yang telah dan sedang diteliti oleh mahasiswa.

Sebagai salah satu universitas swasta yang terdepan dalam melakukan inovasi, Universitas Muhammadiyah Malang memerlukan suatu sistem untuk mengelola data dan informasi skripsi secara *real-time* dan efisien.

Dalam rangka implementasi sistem untuk mengelola data dan informasi skripsi secara *real-time* dan efisien, maka diperlukan pengembangan bahasa *Markdown* yang terintegrasi dengan manajemen skripsi baik oleh pembimbing, jurusan dan *DPPM*.

Bahasa *Markdown* dijadikan sebagai pengembangan tahap awal dari sistem ini yang akan menjadi dasar untuk pengembangan manajemen skripsi kedepannya. Pengembangan lanjutan pada sistem baik bahasa *Markdown* dan sistem manajemen ini dilakukan untuk melengkapi kekurangan-kekurangan yang ada pada sistem yang sekarang diterapkan oleh *DPPM*.

Selain itu juga diperlukan pengembangan *proses bisnis* dan aliran data pada *DPPM* khususnya pada siklus manajemen skripsi secara umum, untuk menjamin proses integrasi tersebut berjalan, integrasi data dan informasi tersebut diwujudkan dengan pengembangan basis data terpusat baik internal *DPPM* maupun entitas lain yang berkaitan.



## Defenisi, Istilah dan Singkatan

Adapun definisi, istilah dan singkatan yang digunakan dalam dokumen *SKPL* ini adalah sebagai berikut :

| **Istilah** | **Definisi**                                           |
| ----------- | ------------------------------------------------------ |
| SKPL        | Spesifikasi Kebutuhan Perangkat Lunak                  |
| DPPM        | Direktorat Penelitian dan Pengabdian kepada Masyarakat |
| DBMS        | Database Management System                             |
| GUI         | Graphical User Interface                               |
| UML         | Unified Modeling Language                              |



## Referensi

Daftar dokumen yang digunakan sebagai acuan atau rujukan dalam penyusunan dokumen **SKPL** ini adalah Kerangka dokumen SKPL IEEE.



## Deskripsi Umum Dokumen

Dokumen **SKPL** ini dibuat untuk memberikan informasi mengenai spesifikasi **Skripdown**. Dokumen ini berisikan informasi sebagai berikut :

1. **Deskripsi Umum Aplikasi**
Deskripsi umum aplikasi meliputi deskripsi umum **Skripdown** yang dikembangkan, fungsi utama **Skripdown** yang akan diberikan kepada pengguna serta karakteristik pengguna yang meliputi pembagian kelompok pengguna seperti jenis pekerjaan dan hak akses aplikasi.
2. **Deskripsi Umum Kebutuhan Aplikasi Yang Akan Diimplementasikan**
   Deskripsi umum kebutuhan aplikasi yang akan diimplementasikan meliputi semua informasi yang bersifat teknsi yang menjadi acuan dalam pengembangan aplikasi.

Informasi dalam dokumen *SKPL* ini disajikan dan diorganisasikan sesuai standar *IEEE* 830-1998 dengan struktur sebagai berikut :

1. **BAB I**
   Berisi informasi umum yang merupakan pendahuluan, yang meliputi tujuan penulisan dokumen, lingkup masalah, definisi, istilah dan akronim, referensi, serta deskripsi umum dokumen.
2. **BAB II**
   Berisi informasi umum dari **Skripdown** yang akan dikembangkan, yang meliputi deskripsi umum sistem **Skripdown**, fungsi **Skripdown** dan karakteristik pengguna.
3. **BAB III**
   Berisi informasi mengenai deskripsi umum kebutuhan perangkat lunak yang akan dikembangkan. Bagian ini meliputi informasi yang mengenai kebutuhan antarmuka eksternal, deskripsi fungsional, *data requirement*, *non-functional requirement*, batasan perancangan, keruntunan (*traceability*) dan ringkasan kebutuhan.



## Deskripsi Umum Skripdown

### Deskripsi Umum Skripdown

Pengembangan **Skripdown** merupakan terobosan inovasi terbaru pada perguruan tinggi di Indonesia. Secara garis besar **Skripdown** adalah sistem manajemen skripsi yang mengimplementasikan bahasa *Markdown* sebagai pemformat otomatis dan sebagai input data skripsi dan mengolahnya menjadi informasi untuk berbagai keperluan universitas.

Berikut di bawah adalah gambaran umum rancangan sistem **Skripdown**



<img src="C:\Users\bagus\Downloads\skripdown-Page-2.png" alt="S" style="zoom:120%;" />

- **SD_** adalah komponen **Skripdown**.

- **L** adalah komponen-komponen lain pada sistem.

  1. Sistem mengambil dan mengembalikan data dengan database.
  2. Komponen **Skripdown** menganalisis masukan informasi *markdown* dari Author dan mengembalikan notifikasi kepada AUTHOR.
  3. LECTURER, DEPARTMENT, SUPER mengelola informasi lewat komponen-komponen lain pada sistem.

  Adapun sistem **Skripdown** yang dikembangkan secara umum disyaratkan memiliki spesifikasi teknis sebagai berikut :

  1. Menggunakan Konsep Open System,
  2. Berbasis Relational Database Management System *(RDBMS*),
  3. Menggunakan konsep *live-preview* dan *autosave* pada editor,

  Sistem **Skripdown** menerapkan sistem keamanan yang bekerja pada tiga tingkatan yaitu :

  - Tingkat Sistem Operasi
  - Tingkat Basis Data
  - Tingkat Aplikasi

  Sistem **Skripdown** dibangun berbasiskan web dan dirancang agar bisa dijalankan menggunakan berbagai tingkat akses pengguna sesuai dengan kewenangannya, antara lain : Penulis, dosen, jurusan, dan super (DPPM).

  Sistem **Skripdown** dirancang secara terpusat dan dapat diakses melalui jaringan internet menggunakan browser.

  ### Fungsi Skripdown

  Fungsi utama sistem **Skripdown** yang dibangun adalah :

  1. Menyediakan pengolah format penulisan skripsi dan validator secara otomatis
  2. Pengolahan data skripsi, bimbingan dan ujian skripsi terstruktur secara *real-time*
  3. Menangani pengolahan basis data dan hak akses (baca, tulis, eksekusi)
  
  ### Lingkungan Operasi
  
  #### Server Site
  
  Perangkat lunak yang digunakan adalah sebagai berikut :
  
  1. Limux sebagai sistem operasi.
  2. MySQL sebagai server *RDBMS*.
  3. Apache Web Server.
  4. Laravel 8 sebagai kerangka web.
  
  #### Client Site
  
  Perangkat lunak diusulkan adalah sebagai berikut :
  
  1. Windows / Linux sebagai sistem operasi.
  2. Firefox, Chrome dan Opera sebagai Web Browser.
  
  #### Development Tools
  
  Perangkat lunak yang akan digunakan adalah sebagai berikut :
  
  1. PHPStorm versi 2020.1
  2. WebStorm versi 2020.1
  3. XAMPP
  4. NGrok
  5. Composer sebagai manajemen library PHP
  6. Nodejs sebagai manajemen library Javascript
  7. Git sebagai kontrol versi pengembangan
  
  ### Karakteristik Pengguna
  
  | **Kategori** | Tugas                                                        | Hak Akses Ke Aplikasi                                        |
  | :----------- | ------------------------------------------------------------ | ------------------------------------------------------------ |
  | Super        | Melihat dan mengambil data skripsi yang dimasukkan.<br />Menambahkan pengguna baru. | Mempunyai hak akses penuh terhadap data pengguna dan aplikasi sistem. |
  | Department   | Mengelola data skripsi pada seputar jurusan.<br />Melakukan pengecekan plagiasi.<br />Memilih penguji skripsi. | Mempunyai hak akses penuh terhadap data skripsi seputar jurusan. |
  | Lecturer     | Menyetujui dan menolak proposal skripsi.<br />Membuat revisi bimbingan skripsi.<br />Menyetujui submit repositori ujian skripsi. | Mempunyai hak akses melihat seputar data skripsi mahasiswa bimbingan dan mahasiswa yang sedang diuji. |
  | Author       | Mengajukan penulisan skripsi kepada pembimbing.<br />Mengajukan revisi.<br />Mengajukan submit.<br />Menulis skripsi. | Mempunyai hak akses penuh terhadap data skripsi yang sedang ditulis. |
  
  

## Deskripsi Umum Kebutuhan

### Kebutuhan Antarmuka Eksternal

Sistem **Skripdown** ini dibangun di atas aplikasi internet berbasis web. Dalam deskripsi kebutuhan antarmuka eksternal akan dideskripsikan kebutuhan antarmuka perangkat lunak dengan perangkat lain yang berada di luar cakupan perangkat lunak yang akan dikembangkan tetapi mempunyai keterkaitan dalam proses yang dilakukan.

Dalam operasionalnya, perangkat lunak yang akan dikembangkan memerlukan adanya interaksi dengan komponen-komponen lain di luar perangkat lunak itu sendiri, seperti : perangkat keras dimana perangkat lunak ini akan dijalankan, perangkat komunikasi dimana perangkat lunak ini akan saling berkomunikasi dalam jaringan internet.

#### Antarmuka Pengguna

Perangkat lunak yang akan dikembangkan membutuhkan interaksi dengan pengguna sebagai pemakai aplikasi perangkat lunak. Dalam melakukan interaksi dengan pengguna perangkat lunak ini membutuhkan proses transformasi *input* dan *output* dari dan ke pengguna. Perangkat tersebut adalah sebagai berikut :

1. **Perangkat *Keyboard***
   *Keyboard* diperlukan sebagai sarana bagi pengguna untuk mengetikkan data masukan yang akan diproses oleh perangkat lunak.
2. **Perangkat *Mouse***
   Perangkat *mouse* digunakan sebagai sarana bagi pengguna untuk memasukkan data input bagi perangkat lunak. Meskipun sebagian besar fungsi *mouse* dapat digantikan dengan *keyboard* tetapi akan lebih ergonomis apabila pada jenis input tertentu menggunakan mouse sebagai salah satu perangkat yang dibutuhkan sebagai antarmuka dengan pengguna.
3. **Perangkat *Monitor***
   *Monitor* sebagai sarana untuk menampilkan aplikasi kepada pengguna mempunyai spesifikasi diantaranya *monitor* mampu menampilkan grafis dengan kualitas warna yang baik untuk menampilkan tampilan *live-preview* pada editor.

#### Antarmuka Perangkat Keras

Antarmuka perangkat keras yang dibutuhkan dalam perangkat lunak ini meliputi :

1. ***Graphic Card / VGA Card***
   Kartu grafik yang dibutuhkan dalam mengoperasikan perangkat lunak ini diharapkan mempunyai kepasitas 4 Mbute ke atas. Apabila menggunakan kartu grafik dengan kemampuan dibawah tersebut maka perangkat lunak akan berjalan dengan tampilan yang kurang maksimal.
2. ***Ethernet Card* atau *Modem***
   *Ethernet card* atau modem dibutuhkan untuk menghubungkan komputer yang menjalankan perangkat lunak dengan jaringan internet.

#### Antarmuka Perangkat Lunak

Tidak ada antarmuka perangkat lain yang dibutuhkan dalam pengembangan **Skripdown** ini.

#### Antarmuka Komunikasi

Antarmuka komunikasi yang dibutuhkan dalam perangkat lunak ini merupakan antarmuka untuk melakukan koneksi dalam jaringan internet yang meliputi :

1. **Antarmuka Komunikasi pada Sisi Server **
   Aplikasi pada sisi *server* merupakan aplikasi yang melayani semua *request* yang dikirimkan oleh *client* yang meminta layanan dengan protokol *http*. Oleh karena itu pada sisi *server* dibutuhkan adanya sebuah *web server* yang terhubung dalam jaringan internet. *Web server* tersebut harus mempunyai alamat IP dan *domain* yang dapat dikenali dalam jaringan internet.
2. **Antarmuka Komunikasi pada Sisi *Client***
   Pada sisi *client* proses yang dilakukan adalah melakukan *request* kepada *server* untuk meminta layanan *http*. Oleh karena itu antarmuka yang dibutuhkan pada sisi *client* adalah perangkat komunikasi yang memungkinkan komputer *client* terhubung dengan jaringan internet.

### Deskripsi Kebutuhan Fungsional

Sistem **Skripdown** menyediakan data sebagai berikut :

1. Pengguna (keseluruhan)
   - id
   - name
   - role = [lecturer, department, super, student]
   - email
   - password
2. 