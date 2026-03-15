# 🏗️ SYSTEM DESIGN - SISTEM PAKAR DIAGNOSIS JAMUR TIRAM

**Project Name:** Sistem Pakar Diagnosis Hama & Penyakit Jamur Tiram Berbasis Website  
**Framework:** Laravel 12  
**Database:** MySQL  
**Status:** Backend Development (Frontend sudah selesai)  
**Version:** 1.0  
**Date:** 15 Maret 2026

---

## 📋 EXECUTIVE SUMMARY

Sistem ini adalah aplikasi web untuk diagnosis otomatis penyakit jamur tiram menggunakan:
- **Forward Chaining** - Metode pencocokan gejala dengan rule base
- **Certainty Factor** - Perhitungan tingkat keyakinan diagnosis

**Output:** Nama penyakit + persentase keyakinan + saran penanganan

---

## 🎯 TUJUAN SISTEM

1. ✅ Membantu petani jamur tiram mendiagnosis penyakit secara mandiri
2. ✅ Mengurangi ketergantungan pada konsultasi dengan pakar (expensive)
3. ✅ Memberikan informasi penanganan cepat dan akurat
4. ✅ Tersedia via web (cross-platform, mudah diakses)

---

## 📊 DATA MASTER

### 1. GEJALA (Symptoms)
**Total:** 25 gejala  
**Range:** G01 - G25

| Kategori | Jumlah | Contoh |
|----------|--------|---------|
| Warna & Kondisi Fisik | 10 | Bintik hijau, noda hitam, tekstur lembek |
| Pertumbuhan & Kerusakan | 8 | Lambat tumbuh, tidak tumbuh, rontok |
| Aroma & Perubahan | 3 | Perubahan aroma, bekas luka |
| Kerusakan Media | 4 | Baglog rusak, plastik berlubang |

### 2. PENYAKIT/HAMA (Diseases)
**Total:** 10 penyakit/hama

| ID | Nama | Tipe | Gejala |
|----|------|------|--------|
| P01 | Trichoderma spp | Jamur | 4 |
| P02 | Neurospora spp | Jamur | 3 |
| P03 | Mucor spp | Jamur | 3 |
| P04 | Penicilium spp | Jamur | 3 |
| P05 | Pseudomonas tolasii | Bakteri | 6 |
| P06 | Chaetomium spp | Jamur | 3 |
| P07 | Coprinus spp | Jamur | 3 |
| P08 | Tikus | Hama | 3 |
| P09 | Lalat | Serangga | 3 |
| P10 | Tunggu (Gurem) | Serangga | 3 |

### 3. RULE BASE
**Total:** 10 rules (R1 - R10)
- Format: `IF (G1 AND G2 AND ...) THEN P_X`
- Gejala per rule: 3-6 gejala

### 4. CERTAINTY FACTOR
**Pakar CF Scale:** 0.2 - 1.0
- 1.0 = Sangat Yakin
- 0.8 = Yakin
- 0.6 = Cukup Yakin
- 0.4 = Sedikit Yakin
- 0.2 = Tidak Tahu

---

## 🏛️ ARSITEKTUR SISTEM

```
┌─────────────────────────────────────────────────────────┐
│                    USER INTERFACE                       │
│        (Frontend - Sudah Selesai - Vue/Blade)          │
└────────────┬────────────────────────────────┬───────────┘
             │                                 │
    ┌────────▼──────────┐         ┌───────────▼──────────┐
    │   HTTP Request    │         │   HTTP Response      │
    │   (JSON/Form)     │         │   (JSON/HTML)        │
    └────────┬──────────┘         └───────────▲──────────┘
             │                                 │
┌────────────▼─────────────────────────────────┴──────────┐
│                   BACKEND (Laravel 12)                  │
│                                                          │
│  ┌──────────────────────────────────────────────────┐  │
│  │         ROUTES & CONTROLLERS                     │  │
│  │  - DiagnosisController menghandle form diagnosis │  │
│  │  - HasilController menampilkan hasil             │  │
│  └──────────────────────────────────────────────────┘  │
│                                                          │
│  ┌──────────────────────────────────────────────────┐  │
│  │      BUSINESS LOGIC (Services)                   │  │
│  │  - ForwardChainingService                        │  │
│  │    * Cocokkan gejala dengan rule base            │  │
│  │    * Return matching diseases                    │  │
│  │  - CertaintyFactorService                        │  │
│  │    * Hitung CF untuk setiap penyakit             │  │
│  │    * Sort by confidence level                    │  │
│  └──────────────────────────────────────────────────┘  │
│                                                          │
│  ┌──────────────────────────────────────────────────┐  │
│  │         MODELS (Database Entities)               │  │
│  │  - Gejala (25 records)                           │  │
│  │  - Penyakit (10 records)                         │  │
│  │  - Rule (10 records)                             │  │
│  │  - RuleDetail (30+ records, M:N)                 │  │
│  │  - PenyakitDetail (CF values)                    │  │
│  └──────────────────────────────────────────────────┘  │
│                                                          │
│  ┌──────────────────────────────────────────────────┐  │
│  │       KNOWLEDGE BASE (Database)                  │  │
│  │  - Gejala master data                            │  │
│  │  - Penyakit dengan deskripsi & solusi            │  │
│  │  - CF Pakar per gejala per penyakit              │  │
│  │  - Rule IF-THEN relationships                    │  │
│  └──────────────────────────────────────────────────┘  │
│                                                          │
└──────────────────────┬───────────────────────────────────┘
                       │
┌──────────────────────▼──────────────────────────────────┐
│              DATABASE (MySQL)                           │
│                                                          │
│  Tables:                                                │
│  - gejala (id, nama, deskripsi)                        │
│  - penyakit (id, nama, deskripsi, solusi, tipe)        │
│  - rule (id, nama, kondisi_format, penyakit_id)        │
│  - rule_detail (id, rule_id, gejala_id, order)         │
│  - penyakit_gejala (id, penyakit_id, gejala_id, cf)    │
│  - diagnosis_history (id, gejala_terpilih, hasil, cf%) │
│                                                          │
└─────────────────────────────────────────────────────────┘
```

---

## 🔄 ALUR SISTEM (User Flow)

```
1. USER MEMBUKA APLIKASI
   ↓
2. PILIH HALAMAN DIAGNOSIS
   ↓
3. TAMPILKAN FORM CHECKBOX 25 GEJALA
   ↓
4. USER PILIH GEJALA-GEJALA YANG DIAMATI
   ↓
5. SUBMIT FORM (POST /diagnosis/proses)
   ↓
6. BACKEND: FORWARD CHAINING
   - Loop setiap rule (R1-R10)
   - Cek apakah semua gejala dalam rule cocok dengan pilihan user
   - Collect penyakit yang match
   ↓
7. BACKEND: CERTAINTY FACTOR
   - Untuk setiap penyakit yang match:
     * Hitung CF setiap gejala: CF[H,E] = CF_pakar × CF_user
     * Kombinasi CF iteratif
     * Hasilkan confidence level (0-100%)
   ↓
8. SORT HASIL
   - Urutkan penyakit by confidence level (descending)
   ↓
9. TAMPILKAN HASIL
   - Nama penyakit (ranking)
   - Confidence level (%)
   - Deskripsi penyakit
   - Saran/solusi penanganan
   ↓
10. USER BISA:
    - Lihat detail penyakit lain
    - Coba diagnosis lagi
    - Simpan hasil (optional)
```

---

## 💾 DATABASE SCHEMA

### Table: `gejala`
```sql
CREATE TABLE gejala (
  id INT PRIMARY KEY AUTO_INCREMENT,
  kode VARCHAR(5) UNIQUE,        -- G01-G25
  nama VARCHAR(255),
  deskripsi TEXT,
  kategori VARCHAR(100),         -- Warna, Pertumbuhan, Aroma, Kerusakan
  created_at TIMESTAMP
);
```

### Table: `penyakit`
```sql
CREATE TABLE penyakit (
  id INT PRIMARY KEY AUTO_INCREMENT,
  kode VARCHAR(5) UNIQUE,        -- P01-P10
  nama VARCHAR(100),
  tipe VARCHAR(50),              -- Jamur, Bakteri, Hama, Serangga
  deskripsi TEXT,
  solusi JSON,                   -- Array of handling solutions
  image_url VARCHAR(500),        -- Optional, path to disease image
  created_at TIMESTAMP
);
```

### Table: `rule`
```sql
CREATE TABLE rule (
  id INT PRIMARY KEY AUTO_INCREMENT,
  kode VARCHAR(5) UNIQUE,        -- R1-R10
  penyakit_id INT,
  kondisi_format VARCHAR(500),   -- "G12 AND G18 AND G06 AND G07"
  jumlah_gejala INT,
  FOREIGN KEY (penyakit_id) REFERENCES penyakit(id)
);
```

### Table: `rule_detail` (Many-to-Many)
```sql
CREATE TABLE rule_detail (
  id INT PRIMARY KEY AUTO_INCREMENT,
  rule_id INT,
  gejala_id INT,
  urutan INT,
  FOREIGN KEY (rule_id) REFERENCES rule(id),
  FOREIGN KEY (gejala_id) REFERENCES gejala(id)
);
```

### Table: `penyakit_gejala` (CF Mapping)
```sql
CREATE TABLE penyakit_gejala (
  id INT PRIMARY KEY AUTO_INCREMENT,
  penyakit_id INT,
  gejala_id INT,
  cf_pakar DECIMAL(3,2),         -- 0.1-1.0
  deskripsi TEXT,
  FOREIGN KEY (penyakit_id) REFERENCES penyakit(id),
  FOREIGN KEY (gejala_id) REFERENCES gejala(id),
  UNIQUE KEY unique_mapping (penyakit_id, gejala_id)
);
```

### Table: `diagnosis_history` (Optional - untuk tracking)
```sql
CREATE TABLE diagnosis_history (
  id INT PRIMARY KEY AUTO_INCREMENT,
  gejala_terpilih JSON,          -- Array of selected gejala IDs
  hasil_penyakit_id INT,
  confidence_level DECIMAL(5,2), -- 0-100%
  created_at TIMESTAMP,
  FOREIGN KEY (hasil_penyakit_id) REFERENCES penyakit(id)
);
```

---

## 🛠️ TEKNOLOGI STACK

### Backend
- **Framework:** Laravel 12
- **PHP Version:** 8.2+
- **Database:** MySQL 8.0+
- **Server:** Apache (via XAMPP)

### Frontend (Sudah Selesai)
- **Templates:** Blade PHP / Vue.js
- **CSS:** Tailwind / Bootstrap
- **JavaScript:** VueJS / Vanilla JS

### Development Tools
- **IDE:** VS Code
- **Version Control:** Git
- **Package Manager:** Composer

---

## 📁 STRUKTUR FOLDER BACKEND

```
app/
├── Http/
│   └── Controllers/
│       ├── DiagnosisController.php     (form diagnosis, proses input)
│       ├── HasilController.php         (tampilkan hasil)
│       ├── PenyakitController.php      (CRUD penyakit - admin)
│       ├── GejalaController.php        (CRUD gejala - admin)
│       └── RuleController.php          (CRUD rule - admin)
├── Models/
│   ├── Gejala.php
│   ├── Penyakit.php
│   ├── Rule.php
│   ├── RuleDetail.php
│   ├── PenyakitGejala.php
│   └── DiagnosisHistory.php
├── Services/
│   ├── ForwardChainingService.php      (logic pencocokan)
│   ├── CertaintyFactorService.php      (logic perhitungan CF)
│   └── DiagnosisService.php            (orchestrator)
└── Traits/
    └── HasDiagnosis.php                (helper traits)

database/
├── migrations/
│   ├── create_gejala_table.php
│   ├── create_penyakit_table.php
│   ├── create_rule_table.php
│   ├── create_rule_detail_table.php
│   ├── create_penyakit_gejala_table.php
│   └── create_diagnosis_history_table.php
└── seeders/
    ├── GejalaSeeder.php               (seed 25 gejala)
    ├── PenyakitSeeder.php             (seed 10 penyakit)
    ├── RuleSeeder.php                 (seed 10 rules)
    ├── RuleDetailSeeder.php           (seed rule details)
    └── PenyakitGejalaSeeder.php        (seed CF values)

routes/
└── web.php                             (routes untuk diagnosis)

resources/
└── views/
    └── diagnosis/
        ├── form.blade.php              (form gejala - frontend sudah ada)
        └── hasil.blade.php             (hasil diagnosis - frontend sudah ada)
```

---

## 🔌 API ENDPOINTS

### Diagnosis Flow

**POST /diagnosis**
- Input: Checkbox gejala yang dipilih
- Output: Daftar penyakit dengan CF%
- Logic: Forward Chaining + Certainty Factor

**GET /diagnosis**
- Input: None
- Output: Form dengan 25 checkbox gejala

**POST /api/diagnosis/proses** (JSON)
- Input: `{ gejala_ids: [1, 2, 3, ...] }`
- Output: `{ success: true, data: { penyakit: [...], confidence: [...] } }`

### Master Data (CRUD - Admin)

**GET /admin/gejala** - List gejala
**POST /admin/gejala** - Tambah gejala
**PUT /admin/gejala/{id}** - Edit gejala
**DELETE /admin/gejala/{id}** - Hapus gejala

**GET /admin/penyakit** - List penyakit
**POST /admin/penyakit** - Tambah penyakit
**PUT /admin/penyakit/{id}** - Edit penyakit
**DELETE /admin/penyakit/{id}** - Hapus penyakit

**GET /admin/rule** - List rule
**POST /admin/rule** - Tambah rule
**PUT /admin/rule/{id}** - Edit rule
**DELETE /admin/rule/{id}** - Hapus rule

---

## 🧮 LOGIKA DIAGNOSIS (Pseudo Code)

### Forward Chaining
```
Input: user_gejala_ids = [1, 5, 12, 18]

matched_diseases = []

FOR setiap rule R in rules:
    rule_gejala = get_gejala_for_rule(R)
    
    IF all(gejala in user_gejala_ids for gejala in rule_gejala):
        matched_diseases.append(R.penyakit_id)

RETURN matched_diseases
```

### Certainty Factor Calculation
```
Input: 
- disease_id
- user_gejala_ids dengan CF_user (default 0.8)

cf_results = {}

FOR setiap matched_disease:
    gejala_untuk_penyakit = get_gejala_for_penyakit(disease_id)
    
    cf_value = 0
    FOR i, gejala in gejala_untuk_penyakit:
        cf_pakar = get_cf_pakar(disease_id, gejala_id)
        cf_user = get_cf_user(gejala_id)  // default 0.8
        
        cf_hasil = cf_pakar * cf_user
        
        IF i == 0:
            cf_value = cf_hasil
        ELSE:
            cf_value = cf_value + cf_hasil * (1 - cf_value)
    
    confidence_percent = cf_value * 100
    cf_results[disease_id] = confidence_percent

SORT cf_results DESC
RETURN cf_results
```

---

## ⚡ PERFORMA & OPTIMASI

### Query Optimization
- ✅ Use eager loading untuk relations (Model::with())
- ✅ Index pada kolom foreign key
- ✅ Cache rule base di Redis (optional)

### Caching Strategy
- Cache gejala master data (jarang berubah)
- Cache penyakit master data (jarang berubah)
- Cache rule base di aplikasi memory

### Response Time Target
- Form gejala load: < 500ms
- Diagnosis process: < 1000ms
- Hasil display: < 300ms

---

## 🔐 SECURITY

- ✅ Input validation (Laravel Validator)
- ✅ CSRF protection
- ✅ SQL injection prevention (Eloquent ORM)
- ✅ Rate limiting untuk API (optional)
- ✅ User authentication (jika diperlukan admin panel)

---

## 📱 RESPONSIVENESS

Sistem harus berjalan di:
- ✅ Desktop (1920x1080)
- ✅ Tablet (768px+)
- ✅ Mobile (320px+) - terutama untuk petani

---

## 🎓 TESTING STRATEGY

### Unit Testing
- Test ForwardChainingService
- Test CertaintyFactorService
- Test Model relationships

### Integration Testing
- Test diagnosis flow end-to-end
- Test CRUD operations
- Test database migrations

### Manual Testing (Blackbox)
- Test dengan semua kombinasi gejala
- Validasi hasil diagnosis
- Compare dengan expert diagnosis

---

## 📈 SCALABILITY FUTURE

Potensi pengembangan:
1. ✏️ Machine Learning untuk improve CF values
2. ✏️ Image recognition untuk identifikasi gejala
3. ✏️ Mobile app native (Android/iOS)
4. ✏️ Multi-bahasa support
5. ✏️ Community feedback & rating

---

**END OF SYSTEM DESIGN DOCUMENT**
