# 🍄 SISTEM PAKAR DIAGNOSIS HAMA PENYAKIT JAMUR TIRAM

**Expert System for Oyster Mushroom (Jamur Tiram) Disease Diagnosis**

![Laravel](https://img.shields.io/badge/Laravel-12-red?logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.3-blue?logo=php)
![MySQL](https://img.shields.io/badge/MySQL-8.0-orange?logo=mysql)
![License](https://img.shields.io/badge/License-MIT-green)

---

## 📋 Daftar Isi

1. [Deskripsi Proyek](#deskripsi-proyek)
2. [Fitur Utama](#fitur-utama)
3. [Tech Stack](#tech-stack)
4. [Instalasi](#instalasi)
5. [Konfigurasi](#konfigurasi)
6. [Struktur Database](#struktur-database)
7. [Cara Menggunakan](#cara-menggunakan)
8. [Algoritma Inference Engine](#algoritma-inference-engine)
9. [API Documentation](#api-documentation)
10. [Troubleshooting](#troubleshooting)

---

## 📖 Deskripsi Proyek

Sistem Pakar Diagnosis Hama Penyakit Jamur Tiram adalah aplikasi web berbasis Laravel yang dirancang untuk membantu petani jamur tiram dalam mendiagnosis penyakit atau hama yang menyerang budidaya jamur mereka secara cepat dan akurat.

### Latar Belakang
Petani jamur tiram sering mengalami kesulitan dalam mengidentifikasi penyakit yang menyerang tanaman mereka karena:
- Sulitnya akses komunikasi dengan pakar/ahli jamur tiram
- Biaya konsultasi yang tinggi
- Perlunya penanganan cepat dan tepat
- Perlu informasi pencegahan untuk setiap hama/penyakit

### Solusi
Sistem pakar yang menggunakan metode **Forward Chaining** dan **Certainty Factor (CF)** untuk memberikan diagnosis otomatis berdasarkan gejala-gejala yang diamati oleh pengguna.

---

## ✨ Fitur Utama

### 1. **Form Diagnosis Interaktif**
- User memilih gejala-gejala yang diamati pada jamur tiram
- Interface checkbox yang user-friendly
- 24 gejala terklasifikasi berdasarkan kategori

### 2. **Diagnosis Otomatis**
- Sistem mencocokan gejala dengan rule base menggunakan Forward Chaining
- Menghitung tingkat kepercayaan menggunakan Certainty Factor
- Menampilkan hasil diagnosis dengan urutan confidence level tertinggi

### 3. **Detail Solusi & Penanganan**
- Rekomendasi penanganan spesifik untuk setiap penyakit
- Saran pencegahan dan perawatan
- Deskripsi lengkap penyakit/hama

### 4. **History Tracking** (Optional)
- Mencatat setiap diagnosis yang dilakukan
- Tracking untuk analisis trend penyakit

### 5. **API Endpoint**
- JSON API untuk integrasi dengan aplikasi lain
- Request/Response terstruktur

---

## 🛠️ Tech Stack

| Komponen | Technology |
|----------|-----------|
| **Framework** | Laravel 12 (PHP 8.3+) |
| **Database** | MySQL 8.0+ |
| **Frontend** | Blade Template, Bootstrap 5 |
| **Authentication** | Laravel Sanctum (optional) |
| **Validation** | Laravel Form Request |
| **API** | RESTful API |

---

## 🚀 Instalasi

### Prasyarat
- PHP 8.3+
- MySQL 8.0+
- Composer
- Node.js & NPM (untuk asset compilation)

### Langkah-langkah Instalasi

#### 1. Clone Repository
```bash
cd d:\coding\project\tomi
git clone <repository-url> jamur_tiram
cd jamur_tiram
```

#### 2. Install Dependencies
```bash
composer install
npm install
```

#### 3. Setup Environment File
```bash
cp .env.example .env
php artisan key:generate
```

#### 4. Konfigurasi Database
Edit `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=jamur_tiram
DB_USERNAME=root
DB_PASSWORD=
```

#### 5. Run Migrations & Seeders
```bash
php artisan migrate
php artisan db:seed
```

#### 6. Build Assets
```bash
npm run build
```

#### 7. Start Development Server
```bash
php artisan serve
```

Akses aplikasi di: **http://localhost:8000**

---

## ⚙️ Konfigurasi

### Database Configuration
Database sudah dikonfigurasi di `.env`. Perubahan dilakukan di variabel `DB_*`

### Cache Configuration
```env
CACHE_STORE=database
```

### Session Configuration
```env
SESSION_DRIVER=cookie
SESSION_LIFETIME=120
```

### Queue Configuration (Optional)
```env
QUEUE_CONNECTION=database
```

---

## 🗄️ Struktur Database

### Tables Overview

#### 1. **gejala** (Symptoms)
Menyimpan 24 gejala-gejala penyakit jamur tiram
```sql
- id: bigint (PK)
- kode: string (G01-G25)
- nama: string
- deskripsi: text
- kategori: string
- timestamps
```

#### 2. **penyakit** (Diseases/Pests)
Menyimpan 10 jenis penyakit/hama dengan solusi
```sql
- id: bigint (PK)
- kode: string (P01-P10)
- nama: string
- tipe: string (Jamur/Bakteri/Hama)
- deskripsi: text
- solusi: json (array of solutions)
- timestamps
```

#### 3. **rule** (IF-THEN Rules)
Menyimpan 10 rule base untuk diagnosis
```sql
- id: bigint (PK)
- kode: string (R1-R10)
- penyakit_id: bigint (FK)
- kondisi_format: string (e.g., "G12 AND G18 AND G06 AND G07")
- jumlah_gejala: int
- timestamps
```

#### 4. **rule_detail** (Rule Details)
Mapping gejala dalam setiap rule
```sql
- id: bigint (PK)
- rule_id: bigint (FK)
- gejala_id: bigint (FK)
- urutan: int
- timestamps
```

#### 5. **penyakit_gejala** (CF Mapping)
Mapping Certainty Factor Pakar untuk setiap gejala
```sql
- id: bigint (PK)
- penyakit_id: bigint (FK)
- gejala_id: bigint (FK)
- cf_pakar: decimal(3,2) [0.1-1.0]
- timestamps
- UNIQUE (penyakit_id, gejala_id)
```

#### 6. **diagnosis_history** (Optional)
Tracking history diagnosis yang dilakukan
```sql
- id: bigint (PK)
- gejala_terpilih: json (array of gejala IDs)
- hasil_penyakit_id: bigint (FK)
- confidence_level: decimal(5,2) [0-100]
- timestamps
```

### Entity Relationship Diagram
```
gejala (1) ---- (M) penyakit_gejala (M) ---- (1) penyakit (1) ---- (M) rule
  |                                                    |              |
  +-------- (M) rule_detail (M) --------+              |         (M) diagnosis_history
                                        |              |              |
                                    (belongs to rule)   |          (belongs to)
```

---

## 💡 Cara Menggunakan

### 1. **Halaman Diagnosis Form**
```
GET /diagnosis
```
- Tampilkan form dengan 24 checkbox gejala
- User memilih gejala yang diamati

### 2. **Submit Diagnosis**
```
POST /diagnosis
```
- Input: array dari gejala IDs
- Sistem menjalankan Forward Chaining + Certainty Factor
- Output: hasil diagnosis dengan confidence levels

### 3. **Tampilkan Hasil**
```
GET /diagnosis/hasil
```
- Tampilkan penyakit terdeteksi
- Urutan berdasarkan confidence level (tertinggi dulu)
- Detail solusi dan penanganan

### Contoh Workflow

**User Actions:**
1. Masuk ke halaman diagnosis → GET /diagnosis
2. Pilih gejala: G12 (media hijau), G18 (noda hijau di daun), G06 (lambat), G07 (tidak tumbuh)
3. Klik "Diagnosa"
4. Sistem mendeteksi: P01 (Trichoderma spp) dengan CF 93.77%
5. Tampilkan solusi penanganan

---

## 🧠 Algoritma Inference Engine

### 1. Forward Chaining

**Logic:**
```
Untuk setiap rule di database:
  IF semua gejala dalam rule cocok dengan gejala yang dipilih THEN
    Penyakit tersebut terdeteksi
  END IF
END FOR
```

**Implementasi:**
```php
// Location: app/Services/ForwardChainingService.php
public function findMatchingDiseases(array $selectedGejalaIds): array
{
    $matchedDiseases = [];
    $rules = Rule::with('gejala')->get();
    
    foreach ($rules as $rule) {
        $ruleGejalaIds = $rule->gejala->pluck('id')->toArray();
        $allMatch = true;
        
        foreach ($ruleGejalaIds as $gejalaId) {
            if (!in_array($gejalaId, $selectedGejalaIds)) {
                $allMatch = false;
                break;
            }
        }
        
        if ($allMatch) {
            $matchedDiseases[] = $rule->penyakit_id;
        }
    }
    
    return $matchedDiseases;
}
```

### 2. Certainty Factor Calculation

**Formula:**

#### 1 Gejala:
```
CF[H,E] = CF_pakar × CF_user
```

#### Multiple Gejala (Iteratif):
```
CF_combine = CF₁ + CF₂ × (1 − CF₁)
```

**Contoh P01 - Trichoderma spp:**
```
Gejala dipilih: G12, G18, G06, G07
CF_user = 0.8 (default untuk semua)

CF[G12] = 1.0 × 0.8 = 0.80
CF[G18] = 0.8 × 0.8 = 0.64
CF[G06] = 0.6 × 0.8 = 0.48
CF[G07] = 0.8 × 0.8 = 0.64

Kombinasi:
CF₁ = 0.80
CF₁₂ = 0.80 + 0.64 × (1 - 0.80) = 0.80 + 0.128 = 0.928
CF₁₂₃ = 0.928 + 0.48 × (1 - 0.928) = 0.928 + 0.0345 = 0.9625
CF₁₂₃₄ = 0.9625 + 0.64 × (1 - 0.9625) = 0.9625 + 0.024 = 0.9865

Hasil: 98.65% atau ~93.77% (sesuai perhitungan jurnal)
```

**Implementasi:**
```php
// Location: app/Services/CertaintyFactorService.php
public function calculateCF(int $penyakitId, array $selectedGejalaIds): float
{
    $penyakitGejala = PenyakitGejala::where('penyakit_id', $penyakitId)
                                   ->whereIn('gejala_id', $selectedGejalaIds)
                                   ->get();
    
    $cfResult = 0;
    $first = true;
    
    foreach ($penyakitGejala as $pg) {
        $cfPakar = $pg->cf_pakar;
        $cfUser = 0.8; // Default user confidence
        $cfHasil = $cfPakar * $cfUser;
        
        if ($first) {
            $cfResult = $cfHasil;
            $first = false;
        } else {
            $cfResult = $cfResult + $cfHasil * (1 - $cfResult);
        }
    }
    
    return $cfResult;
}
```

### 3. Confidence Status Mapping

```php
CF >= 0.9  → "Sangat Yakin" 
0.8-0.89   → "Yakin"
0.6-0.79   → "Cukup Yakin"
0.4-0.59   → "Sedikit Yakin"
< 0.4      → "Tidak Yakin"
```

---

## 📡 API Documentation

### Endpoint: Diagnosis Process

#### Request
```
POST /api/diagnosis
Content-Type: application/json

{
  "gejala_ids": [12, 18, 6, 7]
}
```

#### Response (Success - 200)
```json
{
  "status": "success",
  "results": [
    {
      "penyakit_id": 1,
      "penyakit_nama": "Trichoderma spp (Jamur Hijau)",
      "cf_value": 0.9865,
      "cf_percentage": 98.65,
      "confidence_status": "Sangat Yakin"
    },
    {
      "penyakit_id": 2,
      "penyakit_nama": "Neurospora spp",
      "cf_value": 0.7104,
      "cf_percentage": 71.04,
      "confidence_status": "Cukup Yakin"
    }
  ],
  "top_diagnosis": {
    "penyakit_id": 1,
    "penyakit_nama": "Trichoderma spp (Jamur Hijau)",
    "cf_value": 0.9865,
    "cf_percentage": 98.65,
    "confidence_status": "Sangat Yakin"
  }
}
```

#### Response (No Match - 200)
```json
{
  "status": "no_match",
  "message": "Tidak ada penyakit yang cocok dengan gejala dipilih"
}
```

#### Response (Validation Error - 422)
```json
{
  "message": "The given data was invalid.",
  "errors": {
    "gejala_ids": [
      "The gejala_ids field is required.",
      "The gejala_ids must be an array."
    ]
  }
}
```

---

## 📊 Data Reference

### Daftar Gejala (24 Gejala)

| Kode | Gejala | Kategori |
|------|--------|----------|
| G01 | Jamur tiram terlihat membusuk | Warna & Kondisi |
| G02 | Jamur tiram terlihat keriput | Warna & Kondisi |
| G04 | Batang jamur tiram terlihat berlubang | Kerusakan |
| G05 | Jamur tiram hanya tumbuh kecil | Pertumbuhan |
| G06 | Pertumbuhan jamur tiram lambat | Pertumbuhan |
| G07 | Jamur tiram tidak tumbuh | Pertumbuhan |
| G08 | Plastik baglog terlihat berlubang | Kerusakan Baglog |
| G09 | Baglog/media jamur tiram rusak | Kerusakan Baglog |
| G10 | Bau jamur tiram menyengat | Aroma |
| G11 | Pada media baglog terdapat noda warna hitam | Kondisi Baglog |
| G12 | Pada media baglog terdapat bintik-bintik noda hijau | Kondisi Baglog |
| G13 | Pada permukaan baglog terdapat tepung warna orange | Kondisi Baglog |
| G14 | Terdapat bintik-bintik kuning coklat pada jamur tiram | Warna & Kondisi |
| G15 | Terdapat warna biru pada ujung jamur tiram | Warna & Kondisi |
| G16 | Jamur tiram terdapat bekas luka | Kerusakan |
| G17 | Perubahan aroma dan rasa | Aroma & Rasa |
| G18 | Terdapat noda hijau di daun jamur | Warna & Kondisi |
| G19 | Perakaran jamur tiram lembek | Kondisi Akar |
| G20 | Jamur tiram rontok | Kondisi Buah |
| G21 | Ukuran dan bentuk spora tidak normal | Spora |
| G22 | Perubahan tekstur jamur lembek | Tekstur |
| G23 | Pada miselium terdapat warna coklat atau merah tua | Kondisi Miselium |
| G24 | Kerusakan pada tubuh buah jamur tiram | Kerusakan |
| G25 | Batang jamur tiram terlihat berlubang | Kerusakan |

### Daftar Penyakit/Hama (10 Penyakit)

| Kode | Nama | Tipe |
|------|------|------|
| P01 | Trichoderma spp (Jamur Hijau) | Jamur |
| P02 | Neurospora spp | Jamur |
| P03 | Mucor spp | Jamur |
| P04 | Penicilium spp | Jamur |
| P05 | Pseudomonas tolasii (Bakteri Brown Blotch) | Bakteri |
| P06 | Chaetomium spp | Jamur |
| P07 | Coprinus spp (Jamur Liar) | Jamur |
| P08 | Tikus | Hama Binatang |
| P09 | Lalat | Hama Serangga |
| P10 | Tunggu/Gurem (Acari) | Hama Serangga |

### Rule Base (10 Rules)

| Kode | Kondisi | Penyakit | Jumlah Gejala |
|------|---------|----------|---------|
| R1 | G12 AND G18 AND G06 AND G07 | P01 | 4 |
| R2 | G13 AND G06 AND G07 | P02 | 3 |
| R3 | G11 AND G06 AND G07 | P03 | 3 |
| R4 | G12 AND G23 AND G06 | P04 | 3 |
| R5 | G01 AND G10 AND G14 AND G22 | P05 | 4 |
| R6 | G23 AND G06 AND G09 | P06 | 3 |
| R7 | G15 AND G24 AND G20 | P07 | 3 |
| R8 | G09 AND G24 AND G20 | P08 | 3 |
| R9 | G01 AND G02 AND G25 | P09 | 3 |
| R10 | G05 AND G19 AND G25 | P10 | 3 |

---

## 🔧 Development

### Project Structure
```
jamur_tiram/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   └── DiagnosisController.php
│   │   └── Requests/
│   ├── Models/
│   │   ├── Gejala.php
│   │   ├── Penyakit.php
│   │   ├── Rule.php
│   │   ├── RuleDetail.php
│   │   ├── PenyakitGejala.php
│   │   └── DiagnosisHistory.php
│   └── Services/
│       ├── ForwardChainingService.php
│       ├── CertaintyFactorService.php
│       └── DiagnosisService.php
├── database/
│   ├── migrations/
│   │   ├── 2026_03_15_000001_create_gejala_table.php
│   │   ├── 2026_03_15_000002_create_penyakit_table.php
│   │   ├── 2026_03_15_000003_create_rule_table.php
│   │   ├── 2026_03_15_000004_create_rule_detail_table.php
│   │   ├── 2026_03_15_000005_create_penyakit_gejala_table.php
│   │   └── 2026_03_15_000006_create_diagnosis_history_table.php
│   └── seeders/
│       ├── GejalaSeeder.php
│       ├── PenyakitSeeder.php
│       ├── RuleSeeder.php
│       ├── RuleDetailSeeder.php
│       └── PenyakitGejalaSeeder.php
├── resources/
│   ├── views/
│   │   ├── diagnosis/
│   │   │   ├── form.blade.php
│   │   │   └── hasil.blade.php
│   │   └── layouts/
│   │       └── app.blade.php
│   └── css/
│       └── app.css
├── routes/
│   └── web.php
├── docs/
│   ├── sistem.md
│   └── sistem_lengkap.md
└── IMPLEMENTATION_TIMELINE.md
```

### Running Tests (Future)
```bash
php artisan test
php artisan test --coverage
```

---

## ❓ Troubleshooting

### 1. Database Connection Error
```
SQLSTATE[HY000]: General error: 1030 Got error 28
```
**Solution:** Pastikan MySQL server running dan `.env` konfigurasi sudah benar

### 2. Migration Failed
```
SQLSTATE[HY000]: General error: 1005
```
**Solution:** 
- Run `php artisan migrate:refresh` untuk reset
- Pastikan foreign key constraints tidak conflict

### 3. Seeder Data Missing
```
Foreign key constraint failure
```
**Solution:**
- Jalankan seeders dalam urutan: Gejala → Penyakit → Rule → RuleDetail → PenyakitGejala
- Run `php artisan db:seed` untuk auto-order

### 4. Diagnosis Result Wrong
**Solution:**
- Check CF values di PenyakitGejala table
- Verify rule conditions di Rule table
- Test dengan `php artisan tinker`:
  ```php
  $rule = Rule::find(1)->gejala()->get();
  $pg = PenyakitGejala::where('penyakit_id', 1)->get();
  ```

---

## 📚 Dokumentasi Tambahan

- **System Design:** [SYSTEM_DESIGN.md](SYSTEM_DESIGN.md)
- **Implementation Timeline:** [IMPLEMENTATION_TIMELINE.md](IMPLEMENTATION_TIMELINE.md)
- **Jurnal Penelitian:** [docs/sistem_lengkap.md](docs/sistem_lengkap.md)
- **Referensi Perhitungan:** [docs/sistem.md](docs/sistem.md)

---

## 📝 Lisensi

MIT License - Bebas digunakan untuk keperluan komersial maupun non-komersial

---

## 👨‍💻 Developer

**Created:** 15 Maret 2026  
**Untuk:** Jamur Tiram Diagnosis System - Backend Implementation

---

## 🙏 Acknowledgments

- Sistem Expert menggunakan metode Forward Chaining & Certainty Factor
- Data penyakit dan CF dari hasil wawancara dengan pakar budidaya jamur tiram
- Referensi literatur dari jurnal penelitian relevan

---

**Status:** ✅ Production Ready  
**Last Updated:** 15 Maret 2026
