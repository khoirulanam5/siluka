# 🏥 Sistem Rawat Luka (SILUKA)

**SILUKA (Sistem Rawat Luka)** adalah aplikasi berbasis web yang dikembangkan menggunakan **CodeIgniter 3 (CI3)** untuk membantu tenaga kesehatan dalam **mencatat, memantau, dan mengelola data perawatan luka pasien** secara digital.  
Sistem ini berfungsi layaknya sistem **rekam medis sederhana**, namun difokuskan pada pencatatan dan pengelolaan tindakan perawatan luka agar lebih efisien, akurat, dan terdokumentasi dengan baik.

---

## 🚀 Fitur Utama

### 1. **Autentikasi & Manajemen Pengguna**
- Login dan logout pengguna (admin, pasien, perawat, pemilik).
- Hak akses berdasarkan peran (role-based access control).
- Manajemen akun pengguna (tambah, edit, nonaktifkan).

### 2. **Data Pasien**
- Pencatatan data pasien baru (identitas, alamat, riwayat kesehatan dasar).
- Pencarian dan filter data pasien.
- Riwayat kunjungan dan tindakan rawat luka pasien.

### 3. **Pendaftaran & Kunjungan**
- Input kunjungan pasien baru.
- Penjadwalan rawat luka (tindakan harian atau berkala).
- Nomor registrasi otomatis.

### 4. **Rekam Rawat Luka**
- Pencatatan hasil pemeriksaan dan tindakan rawat luka.
- Upload foto luka sebelum dan sesudah perawatan (jika tersedia).
- Catatan tindakan (jenis perawatan, dressing, obat, petugas yang menangani).
- Monitoring perkembangan luka pasien.

### 5. **Laporan & Statistik**
- Laporan pasien berdasarkan periode, jenis luka, atau petugas.
- Rekap kunjungan pasien harian, mingguan, dan bulanan.
- Export laporan ke PDF/Excel.

### 6. **Manajemen Data Referensi**
- Data obat dan bahan medis.
- Data jenis luka / kategori luka.
- Data petugas dan jabatan.
- Konfigurasi sistem dasar (logo instansi, nama unit, dsb).

### 7. **Keamanan & Backup**
- Proteksi halaman berdasarkan sesi login.
- Validasi input data.
- Backup database manual melalui menu admin.

---

## 🧩 Teknologi yang Digunakan

| Komponen | Keterangan |
|-----------|-------------|
| **Framework** | CodeIgniter 3 |
| **Bahasa Pemrograman** | PHP 7.4+ |
| **Database** | MySQL |
| **Frontend** | Bootstrap 5, jQuery |
| **Library Tambahan** | DataTables, SweetAlert, Chart.js |
| **Server** | Apache |

---

## ⚙️ Instalasi & Konfigurasi

### 1. **Clone Repository**
```bash
git clone https://github.com/khoirulanam5/siluka.git
cd siluka
