# 🍄 SISTEM PAKAR DIAGNOSIS HAMA PENYAKIT JAMUR TIRAM
## Expert System for Oyster Mushroom Disease Diagnosis

---

## 📋 BAB 4: HASIL DAN PEMBAHASAN

### 4.1 Analisis Permasalahan

**Latar Belakang:**
Petani jamur tiram menghadapi kesulitan dalam mendapatkan informasi terkait hama dan penyakit karena:
- Sulitnya akses komunikasi dengan pakar/ahli jamur tiram
- Biaya konsultasi yang cukup mahal
- Diperlukan penanganan cepat dan tepat tanpa harus konsultasi ke ahli
- Perlunya cara pencegahan untuk setiap hama atau penyakit

**Kendala Utama:**
1. ❌ Sulitnya mendapat informasi dari pakar karena biaya yang mahal
2. ❌ Membutuhkan penanganan langsung yang cepat dan tepat
3. ❌ Perlu cara pencegahan untuk setiap hama/penyakit yang menyerang



### 4.2 Analisis Data

#### 4.2.1 Deskripsi Analisis Data

Sistem akan memproses data masukan berupa **gejala-gejala yang diamati** pada jamur tiram yang terinfeksi hama atau penyakit.

**Variabel yang Digunakan:**
- Data gejala hama dan penyakit jamur tiram
- Hasil wawancara dengan pakar budidaya jamur tiram
- Studi literatur terkait
- Data latih dan data uji untuk sistem

---

## 📊 DATA SISTEM

### 📑 Tabel Data Gejala (Symptoms)

**Total Gejala: 25**

| ID  | Nama Gejala |
|-----|------------|
| G01 | Jamur tiram terlihat membusuk |
| G02 | Jamur tiram terlihat keriput |
| G04 | Batang jamur tiram terlihat berlubang |
| G05 | Jamur tiram hanya tumbuh kecil |
| G06 | Pertumbuhan jamur tiram lambat |
| G07 | Jamur tiram tidak tumbuh |
| G08 | Plastik baglog terlihat berlubang |
| G09 | Baglog/media jamur tiram rusak |
| G10 | Bau Jamur tiram menyengat |
| G11 | Pada media baglog terdapat noda warna hitam |
| G12 | Pada media baglog terdapat bintik-bintik noda hijau |
| G13 | Pada permukaan baglog terdapat tepung warna orange |
| G14 | Jamur terdapat bintik-bintik kuning coklat pada jamur tiram |
| G15 | Terdapat warna biru pada ujung jamur tiram |
| G16 | Jamur tiram terdapat bekas luka |
| G17 | Perubahan aroma dan rasa |
| G18 | Terdapat noda hijau di daun jamur |
| G19 | Perakaran jamur tiram lembek |
| G20 | Jamur tiram rontok |
| G21 | Ukuran dan bentuk spora tidak normal |
| G22 | Perubahan tekstur jamur lembek |
| G23 | Pada miselium terdapat warna coklat atau merah tua |
| G24 | Kerusakan pada tubuh buah jamur tiram |
| G25 | Batang jamur tiram terlihat berlubang |

---

### 🦠 Tabel Penyakit/Hama (Diseases/Pests)

**Total Penyakit/Hama: 10**

| ID  | Nama Penyakit/Hama | Tipe |
|-----|----|------|
| P01 | Trichoderma spp | Jamur |
| P02 | Neurospora spp | Jamur |
| P03 | Mucor spp | Jamur |
| P04 | Penicilium spp | Jamur |
| P05 | Pseudomonas tolasii | Bakteri |
| P06 | Chaetomium spp | Jamur |
| P07 | Coprinus spp | Jamur |
| P08 | Tikus | Hama Binatang |
| P09 | Lalat | Hama Serangga |
| P10 | Tunggu (Gurem) | Hama Serangga |

---

### 📌 Tabel Bobot Nilai CF Pakar (Expert's Certainty Factor)

#### **P01 - Trichoderma spp (Jamur Hijau)**

| Gejala | ID | CF Pakar |
|--------|-------|----------|
| Pada media baglog terdapat bintik-bintik noda hijau | G12 | 1.0 |
| Terdapat noda hijau di daun jamur | G18 | 0.8 |
| Pertumbuhan jamur tiram lambat | G06 | 0.6 |
| Jamur tiram tidak tumbuh | G07 | 0.8 |

#### **P02 - Neurospora spp**

| Gejala | ID | CF Pakar |
|--------|-------|----------|
| Pada permukaan baglog terdapat tepung warna orange | G13 | 1.0 |
| Pertumbuhan jamur tiram lambat | G06 | 0.6 |
| Jamur tiram tidak tumbuh | G07 | 0.8 |

#### **P03 - Mucor spp**

| Gejala | ID | CF Pakar |
|--------|-------|----------|
| Pada media baglog terdapat noda warna hitam | G11 | 1.0 |
| Pertumbuhan jamur tiram lambat | G06 | 0.6 |
| Jamur tiram tidak tumbuh | G07 | 0.8 |

#### **P04 - Penicilium spp**

| Gejala | ID | CF Pakar |
|--------|-------|----------|
| Pada media baglog terdapat bintik-bintik noda hijau | G12 | 1.0 |
| Pertumbuhan jamur tiram lambat | G06 | 0.6 |
| Pada miselium terdapat warna coklat atau merah tua | G23 | 0.8 |

#### **P05 - Pseudomonas tolasii (Bakteri)**

| Gejala | ID | CF Pakar |
|--------|-------|----------|
| Jamur tiram terlihat membusuk | G01 | 1.0 |
| Bau jamur tiram menyengat | G10 | 0.8 |
| Terdapat bintik-bintik kuning coklat pada jamur tiram | G14 | 0.8 |
| Jamur tiram terdapat bekas luka | G16 | 0.4 |
| Perubahan aroma dan rasa | G17 | 0.6 |
| Perubahan tekstur jamur lembek | G22 | 0.8 |

#### **P06 - Chaetomium spp**

| Gejala | ID | CF Pakar |
|--------|-------|----------|
| Pada miselium terdapat warna coklat atau merah tua | G23 | 1.0 |
| Pertumbuhan jamur tiram lambat | G06 | 0.6 |
| Baglog/media jamur tiram rusak | G09 | 0.6 |

#### **P07 - Coprinus spp**

| Gejala | ID | CF Pakar |
|--------|-------|----------|
| Terdapat warna biru pada ujung jamur tiram | G15 | 1.0 |
| Kerusakan pada tubuh buah jamur tiram | G24 | 0.6 |
| Jamur tiram rontok | G20 | 0.6 |

#### **P08 - Tikus**

| Gejala | ID | CF Pakar |
|--------|-------|----------|
| Baglog/media jamur tiram rusak | G09 | 0.8 |
| Kerusakan pada tubuh buah jamur tiram | G24 | 0.8 |
| Jamur tiram rontok | G20 | 0.6 |

#### **P09 - Lalat**

| Gejala | ID | CF Pakar |
|--------|-------|----------|
| Jamur tiram terlihat membusuk | G01 | 0.6 |
| Jamur tiram terlihat keriput | G02 | 0.6 |
| Batang jamur tiram terlihat berlubang | G25 | 0.8 |

#### **P10 - Tunggu (Gurem)**

| Gejala | ID | CF Pakar |
|--------|-------|----------|
| Jamur tiram hanya tumbuh kecil | G05 | 0.8 |
| Perakaran jamur tiram lembek | G19 | 0.8 |
| Batang jamur tiram terlihat berlubang | G25 | 0.6 |

---

### 📋 Tabel Keterangan Nilai CF (Certainty Factor Scale)

| NO | Keterangan | Nilai |
|----|-----------|-------|
| 1  | Sangat Yakin (Very Certain) | 1.0 |
| 2  | Yakin (Certain) | 0.8 |
| 3  | Cukup Yakin (Somewhat Certain) | 0.6 |
| 4  | Sedikit Yakin (Slightly Certain) | 0.4 |
| 5  | Tidak Tahu (Unknown) | 0.2 |

---

## 🔍 RULE BASE & DECISION TREE

### 4.2.2 Rule Base (Basis Aturan)

**Deskripsi:**
Basis aturan (Rule Base) berisi hubungan antara gejala dengan kemungkinan hama atau penyakit pada jamur tiram.

**Sumber Data:**
- Hasil wawancara dengan pakar budidaya jamur tiram
- Studi literatur yang relevan
- Metode Pencocokan: **Forward Chaining**
- Perhitungan Tingkat Keyakinan: **Certainty Factor (CF)**

**Format Aturan:** `IF (Gejala1 AND Gejala2 AND ...) THEN (Diagnosa)`

---

### 📌 Tabel Rule Base Diagnosis

| Kode | Rule (IF) | Diagnosa (THEN) | Jumlah Gejala |
|------|-----------|-----------------|---------|
| R1 | G12 AND G18 AND G06 AND G07 | P01 (Trichoderma spp) | 4 |
| R2 | G13 AND G06 AND G07 | P02 (Neurospora spp) | 3 |
| R3 | G11 AND G06 AND G07 | P03 (Mucor spp) | 3 |
| R4 | G12 AND G23 AND G06 | P04 (Penicilium spp) | 3 |
| R5 | G01 AND G10 AND G14 AND G22 | P05 (Pseudomonas tolasii) | 4 |
| R6 | G23 AND G06 AND G09 | P06 (Chaetomium spp) | 3 |
| R7 | G15 AND G24 AND G20 | P07 (Coprinus spp) | 3 |
| R8 | G09 AND G24 AND G20 | P08 (Tikus) | 3 |
| R9 | G01 AND G02 AND G25 | P09 (Lalat) | 3 |
| R10 | G05 AND G19 AND G25 | P10 (Tunggu/Gurem) | 3 |

---

### 4.2.3 Decision Tree

*(Pohon keputusan menggambarkan alur pencocokan gejala dengan rule base untuk menghasilkan diagnosa)*

---

## 🧮 PERHITUNGAN CERTAINTY FACTOR

### 4.2.4 Perhitungan CF

**Rumus yang Digunakan:**

#### 1. **Jika hanya 1 gejala:**
```
CF[H,E] × 100%
```

#### 2. **Jika lebih dari 1 gejala (Kombinasi):**
```
CF_combine = CF[H,E]₁ + CF[H,E]₂ × (1 − CF[H,E]₁)
```

**Dimana:**
- CF[H,E] = CF Pakar × CF User
- CF_combine di-update secara iteratif untuk setiap gejala tambahan

---

### 📊 Contoh Perhitungan untuk Setiap Penyakit

#### **P01 - Trichoderma spp (Jamur Hijau) ✅ 93.76%**

**Rule:** `IF G12 AND G18 AND G06 AND G07 THEN P01`

| Gejala | CF User | CF Pakar | CF Hasil |
|--------|---------|----------|----------|
| G12 | 0.8 | 0.6 | 0.48 |
| G18 | 0.6 | 0.6 | 0.36 |
| G06 | 0.8 | 0.6 | 0.48 |
| G07 | 0.8 | 0.8 | 0.64 |

**Perhitungan Kombinasi:**
```
CF₁ = 0.48

CF₁₂ = 0.48 + 0.36(1 − 0.48)
     = 0.48 + 0.36(0.52)
     = 0.48 + 0.1872
     = 0.6672

CF₁₂₃ = 0.6672 + 0.48(1 − 0.6672)
      = 0.6672 + 0.48(0.3328)
      = 0.6672 + 0.1597
      = 0.8269

CF₁₂₃₄ = 0.8269 + 0.64(1 − 0.8269)
       = 0.8269 + 0.64(0.1731)
       = 0.8269 + 0.1108
       = 0.9377
```

**Hasil: 93.77% ✅**

---

#### **P02 - Neurospora spp ✅ 88.02%**

**Rule:** `IF G13 AND G06 AND G07 THEN P02`

| Gejala | CF User | CF Pakar | CF Hasil |
|--------|---------|----------|----------|
| G13 | 0.8 | 0.6 | 0.48 |
| G06 | 0.6 | 0.6 | 0.36 |
| G07 | 0.8 | 0.8 | 0.64 |

**Perhitungan:**
```
CF₁ = 0.48

CF₁₂ = 0.48 + 0.36(1 − 0.48)
     = 0.48 + 0.1872
     = 0.6672

CF₁₂₃ = 0.6672 + 0.64(1 − 0.6672)
      = 0.6672 + 0.64(0.3328)
      = 0.6672 + 0.2130
      = 0.8802
```

**Hasil: 88.02% ✅**

---

#### **P03 - Mucor spp ✅ 91.70%**

**Rule:** `IF G11 AND G06 AND G07 THEN P03`

| Gejala | CF User | CF Pakar | CF Hasil |
|--------|---------|----------|----------|
| G11 | 0.8 | 0.8 | 0.64 |
| G06 | 0.6 | 0.6 | 0.36 |
| G07 | 0.8 | 0.8 | 0.64 |

**Perhitungan:**
```
CF₁ = 0.64

CF₁₂ = 0.64 + 0.36(1 − 0.64)
     = 0.64 + 0.36(0.36)
     = 0.64 + 0.1296
     = 0.7696

CF₁₂₃ = 0.7696 + 0.64(1 − 0.7696)
      = 0.7696 + 0.64(0.2304)
      = 0.7696 + 0.1474
      = 0.9170
```

**Hasil: 91.70% ✅**

---

#### **P04 - Penicilium spp ✅ 82.69%**

**Rule:** `IF G12 AND G23 AND G06 THEN P04`

| Gejala | CF User | CF Pakar | CF Hasil |
|--------|---------|----------|----------|
| G12 | 0.8 | 0.6 | 0.48 |
| G23 | 0.8 | 0.6 | 0.48 |
| G06 | 0.6 | 0.6 | 0.36 |

**Perhitungan:**
```
CF₁ = 0.48

CF₁₂ = 0.48 + 0.48(1 − 0.48)
     = 0.48 + 0.48(0.52)
     = 0.48 + 0.2496
     = 0.7296

CF₁₂₃ = 0.7296 + 0.36(1 − 0.7296)
      = 0.7296 + 0.36(0.2704)
      = 0.7296 + 0.0973
      = 0.8269
```

**Hasil: 82.69% ✅**

---

#### **P05 - Pseudomonas tolasii ✅ 93.77%**

**Rule:** `IF G01 AND G10 AND G14 AND G22 THEN P05`

| Gejala | CF User | CF Pakar | CF Hasil |
|--------|---------|----------|----------|
| G01 | 0.8 | 0.8 | 0.64 |
| G10 | 0.8 | 0.6 | 0.48 |
| G14 | 0.6 | 0.6 | 0.36 |
| G22 | 0.8 | 0.6 | 0.48 |

**Perhitungan:**
```
CF₁ = 0.64

CF₁₂ = 0.64 + 0.48(1 − 0.64)
     = 0.64 + 0.48(0.36)
     = 0.64 + 0.1728
     = 0.8128

CF₁₂₃ = 0.8128 + 0.36(1 − 0.8128)
      = 0.8128 + 0.36(0.1872)
      = 0.8128 + 0.0674
      = 0.8802

CF₁₂₃₄ = 0.8802 + 0.48(1 − 0.8802)
       = 0.8802 + 0.48(0.1198)
       = 0.8802 + 0.0575
       = 0.9377
```

**Hasil: 93.77% ✅**

---

#### **P06 - Chaetomium spp ✅ 88.02%**

**Rule:** `IF G23 AND G06 AND G09 THEN P06`

| Gejala | CF User | CF Pakar | CF Hasil |
|--------|---------|----------|----------|
| G23 | 0.8 | 0.6 | 0.48 |
| G06 | 0.6 | 0.6 | 0.36 |
| G09 | 0.8 | 0.8 | 0.64 |

**Perhitungan:**
```
CF₁ = 0.48

CF₁₂ = 0.48 + 0.36(1 − 0.48)
     = 0.48 + 0.36(0.52)
     = 0.48 + 0.1872
     = 0.6672

CF₁₂₃ = 0.6672 + 0.64(1 − 0.6672)
      = 0.6672 + 0.64(0.3328)
      = 0.6672 + 0.2130
      = 0.8802
```

**Hasil: 88.02% ✅**

---

#### **P07 - Coprinus spp ✅ 93.32%**

**Rule:** `IF G15 AND G24 AND G20 THEN P07`

| Gejala | CF User | CF Pakar | CF Hasil |
|--------|---------|----------|----------|
| G15 | 0.8 | 0.8 | 0.64 |
| G24 | 0.8 | 0.6 | 0.48 |
| G20 | 0.8 | 0.8 | 0.64 |

**Perhitungan:**
```
CF₁ = 0.64

CF₁₂ = 0.64 + 0.48(1 − 0.64)
     = 0.64 + 0.48(0.36)
     = 0.64 + 0.1728
     = 0.8128

CF₁₂₃ = 0.8128 + 0.64(1 − 0.8128)
      = 0.8128 + 0.64(0.1872)
      = 0.8128 + 0.1204
      = 0.9332
```

**Hasil: 93.32% ✅**

---

#### **P08 - Tikus ✅ 93.32%**

**Rule:** `IF G09 AND G24 AND G20 THEN P08`

| Gejala | CF User | CF Pakar | CF Hasil |
|--------|---------|----------|----------|
| G09 | 0.8 | 0.8 | 0.64 |
| G24 | 0.8 | 0.6 | 0.48 |
| G20 | 0.8 | 0.8 | 0.64 |

**Perhitungan:**
```
CF₁ = 0.64

CF₁₂ = 0.64 + 0.48(1 − 0.64)
     = 0.64 + 0.1728
     = 0.8128

CF₁₂₃ = 0.8128 + 0.64(1 − 0.8128)
      = 0.8128 + 0.1204
      = 0.9332
```

**Hasil: 93.32% ✅**

---

#### **P09 - Lalat ✅ 91.76%**

**Rule:** `IF G01 AND G02 AND G25 THEN P09`

| Gejala | CF User | CF Pakar | CF Hasil |
|--------|---------|----------|----------|
| G01 | 0.8 | 0.7 | 0.56 |
| G02 | 0.8 | 0.6 | 0.48 |
| G25 | 0.8 | 0.8 | 0.64 |

**Perhitungan:**
```
CF₁ = 0.56

CF₁₂ = 0.56 + 0.48(1 − 0.56)
     = 0.56 + 0.48(0.44)
     = 0.56 + 0.2112
     = 0.7712

CF₁₂₃ = 0.7712 + 0.64(1 − 0.7712)
      = 0.7712 + 0.64(0.2288)
      = 0.7712 + 0.1464
      = 0.9176
```

**Hasil: 91.76% ✅**

---

#### **P10 - Tunggu (Gurem) ✅ 93.26%**

**Rule:** `IF G05 AND G19 AND G25 THEN P10`

| Gejala | CF User | CF Pakar | CF Hasil |
|--------|---------|----------|----------|
| G05 | 0.8 | 0.8 | 0.64 |
| G19 | 0.8 | 0.8 | 0.64 |
| G25 | 0.8 | 0.6 | 0.48 |

**Perhitungan:**
```
CF₁ = 0.64

CF₁₂ = 0.64 + 0.64(1 − 0.64)
     = 0.64 + 0.64(0.36)
     = 0.64 + 0.2304
     = 0.8704

CF₁₂₃ = 0.8704 + 0.48(1 − 0.8704)
      = 0.8704 + 0.48(0.1296)
      = 0.8704 + 0.0622
      = 0.9326
```

**Hasil: 93.26% ✅**

---

## 📊 RINGKASAN SISTEM

### Statistik Keseluruhan

| Aspek | Jumlah |
|-------|--------|
| Total Gejala (Symptoms) | 25 |
| Total Penyakit/Hama (Diseases) | 10 |
| Total Rule Base | 10 |
| Rata-rata CF Hasil | 90.59% |
| Metode | Forward Chaining + Certainty Factor |

### Daftar Penyakit Berdasarkan Confidence Level

| Urutan | Penyakit | CF | Status |
|--------|----------|-----|--------|
| 1 | P01 - Trichoderma spp | 93.77% | 🟢 Sangat Yakin |
| 2 | P05 - Pseudomonas tolasii | 93.77% | 🟢 Sangat Yakin |
| 3 | P07 - Coprinus spp | 93.32% | 🟢 Sangat Yakin |
| 4 | P08 - Tikus | 93.32% | 🟢 Sangat Yakin |
| 5 | P10 - Tunggu (Gurem) | 93.26% | 🟢 Sangat Yakin |
| 6 | P03 - Mucor spp | 91.70% | 🟢 Sangat Yakin |
| 7 | P09 - Lalat | 91.76% | 🟢 Sangat Yakin |
| 8 | P02 - Neurospora spp | 88.02% | 🟢 Yakin |
| 9 | P06 - Chaetomium spp | 88.02% | 🟢 Yakin |
| 10 | P04 - Penicilium spp | 82.69% | 🟢 Yakin |

---

## 🎯 ALUR SISTEM

### Forward Chaining Process
1. User memilih gejala-gejala yang diamati
2. Sistem mencocokkan gejala dengan Rule Base (R1-R10)
3. Untuk setiap rule yang match, hitung CF menggunakan formula
4. Tampilkan hasil dengan confidence level tertinggi
5. Berikan rekomendasi/saran penanganan

### Keluaran Sistem
- **Diagnosa**: Nama penyakit/hama yang dideteksi
- **Confidence Level**: Persentase akurasi (0-100%)
- **Rekomendasi**: Cara penanganan dan pencegahan

---

**Dokumentasi: v1.0 | Tanggal: 2026**
