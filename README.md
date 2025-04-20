# 📦 Laravel Livewire Project

Proyek ini merupakan pencatatan PNS dengan berbagai fitur, di antaranya:

-   Pendataan PNS
-   Upload foto
-   Pengelompokan unit kerja
-   Menampilkan pegawai berdasarkan unit kerja dan jabatan
-   Export data ke Excel
-   Print data

---

## 🧰 Fitur

-   🔄 Komponen dinamis menggunakan Livewire
-   📥 Export data ke file Excel (menggunakan Laravel Excel)
-   📂 Upload dan akses file dengan `storage:link`
-   🌱 Seeder untuk generate data awal ke database

---

## ⚙️ Requirements

-   PHP >= 8.0
-   Composer
-   MySQL / MariaDB
-   Laravel CLI

---

## 🚀 Instalasi

Langkah-langkah untuk setup project:

```bash
# 1. Clone repositori
git clone https://github.com/fadliabdilah99/Test-Teknis.git
cd Test-Teknis

# 2. Install dependency PHP
composer install

# 3. Salin file .env
cp .env.example .env

# 4. Generate app key
php artisan key:generate

# 5. Setup database (atur konfigurasi DB di file .env)
php artisan migrate --seed

# 6. Buat storage link agar file dapat diakses publik
php artisan storage:link
```


## 👉 Cara Menggunakan Aplikasi

### 1. Login

- Buka browser dan akses [http://localhost:8000](http://localhost:8000)
- Masukkan username dan password yang telah disediakan:
  - **Username:** `admin@admin.com`
  - **Password:** `password`

### 2. Halaman Pegawai

Pada halaman ini, Anda akan disuguhkan data pegawai secara keseluruhan dengan beberapa fitur:
- CRUD pegawai
- Export Excel
- Print Data

### 3. Komponen Tree

Di sisi kiri sidebar, terdapat tombol dropdown unit kerja. Ketika diklik, Anda bisa menambahkan unit kerja maupun jabatan secara fleksibel. Contoh struktur unit kerja dan jabatan:

- **Disnaker**
  - **Sekretariat**
    - Sekretariat Provinsi
    - Sekretariat Kabupaten
    - *Sekretaris Pusat*
  - **Bidang Pelatihan**
    - *Kepala Biro Umum*

**Catatan:**
- `-` = Unit Kerja
- `*` = Jabatan

### Penjelasan:

Admin dapat menambahkan unit kerja di dalam unit kerja sebanyak yang diperlukan, dan di setiap unit kerja terdapat jabatan untuk user. Ketika jabatan diklik, pegawai dengan unit kerja dan jabatan terkait akan ditampilkan.
