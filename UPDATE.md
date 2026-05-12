# 📋 Catatan Pembaruan Sistem Pakar Jamur Tiram

**Tanggal**: April 28, 2026

## 🎯 Ringkasan Perubahan

Sistem telah diperbarui untuk mengimplementasikan metode **Certainty Factor (CF)** dengan kombinasi gejala dan menambahkan validasi diagnosis yang lebih ketat.

---

## 📝 Detail Perubahan

### 1. **Metode Certainty Factor dengan Kombinasi Gejala**

#### File: `app/Services/CertaintyFactorService.php`
**Ditambahkan:**
- Method `calculateCFWithDetails()` - Menghitung CF dengan detail lengkap perhitungan
  - Mengembalikan: `cf_value`, `cf_percentage`, `cf_percentage_float`, `symptoms_detail`, `combine_steps`
  - Menampilkan setiap gejala yang cocok beserta CF-nya
  - Menampilkan proses kombinasi CF secara iteratif

- Method `toPercentageInt()` - Konversi CF ke persentase integer dengan pembulatan otomatis
  - Contoh: 87.2 → 87, 93.344 → 93

**Formula yang Diimplementasikan:**
```
Single Symptom:
CF(H,E) × 100% = CF_pakar × CF_user × 100%

Multiple Symptoms:
CF_combine = CF1 + CF2 × (1 - CF1)
Untuk > 2 gejala: Terapkan rumus secara iteratif
```

---

### 2. **Validasi Diagnosis Spesifik**

#### File: `app/Http/Controllers/DiagnosisController.php`
**Perubahan Logika:**

**Kondisi 1: Tidak ada penyakit cocok (0 hasil)**
- Tampilkan pesan error di form
- Tidak disimpan ke riwayat

**Kondisi 2: Satu penyakit cocok (1 hasil) ✅**
- Tampilkan halaman hasil dengan detail diagnosis
- Simpan ke riwayat

**Kondisi 3: Banyak penyakit cocok (> 1 hasil) ⚠️**
- Tampilkan halaman hasil dengan pesan error
- **Tampilkan daftar penyakit yang cocok**
- **Tampilkan gejala yang kurang** untuk setiap penyakit
- **TIDAK disimpan ke riwayat**
- Arahkan user untuk memilih gejala yang lebih spesifik

**Contoh Pesan Error Multiple Diseases:**
```
Gejala yang dipilih cocok dengan lebih dari satu penyakit:

• P01 - Trichoderma spp (85%)
  Gejala kurang: G12 (Umbi Membusuk), G23 (Bau Menyengat)

• P04 - Penicilium spp (78%)
  Gejala kurang: G06 (Substrat Basah), G09 (Kepala Susu Berlendir)

Silakan tambahkan gejala yang sesuai untuk mendapatkan diagnosis yang lebih akurat.
```

---

### 3. **Tampilan Perhitungan Diagnosis**

#### File: `resources/views/diagnosis/hasil.blade.php`
**Ditambahkan:**

1. **Bagian Perhitungan Certainty Factor** (Biru)
   - Menampilkan setiap gejala yang dipilih
   - Menampilkan CF pakar, CF user, dan hasil CF masing-masing gejala
   - Menampilkan proses kombinasi CF dengan formula lengkap
   - Menampilkan hasil akhir dengan pembulatan

2. **Pesan Error untuk Multiple Diseases** (Kuning)
   - Tampilan khusus dengan icon ⚠️
   - Menampilkan daftar penyakit dengan CF percentage
   - Menampilkan gejala yang kurang untuk setiap penyakit
   - Warna kuning untuk membedakan dari error normal

3. **Kondisi Tampilan:**
   - Jika `is_error = true` → Tampilkan warning box
   - Jika `is_error = false` → Tampilkan hasil diagnosis normal

---

### 4. **Tampilan Error Message di Form**

#### File: `resources/views/diagnosis/form.blade.php`
**Perubahan:**
- Menggunakan `{!! nl2br(e(...)) !!}` untuk menampilkan error dengan line breaks
- Memformat pesan error agar lebih readable dengan baris baru

---

## 🔄 Alur Diagnosis Baru

```
┌─────────────────────────────────────┐
│ User Pilih Gejala & Submit Form    │
└────────────────┬────────────────────┘
                 │
         ┌───────▼────────┐
         │ Proses Diagnosis│
         └───────┬────────┘
                 │
      ┌──────────┼──────────┐
      │          │          │
   ┌──▼─┐   ┌───▼──┐   ┌──▼──┐
   │ 0  │   │  1   │   │ >1  │
  Hasil │   │Hasil │   │Hasil│
   └──┬─┘   └───┬──┘   └──┬──┘
      │         │         │
      ▼         ▼         ▼
   Error     Success   Warning
   Form      + Save    + Display
   Page      History   Results
             ✅        ⚠️
```

---

## 📊 Tabel Perbandingan Kondisi Diagnosis

| Kondisi | Penyakit Cocok | Tampilan | Pesan | Simpan History |
|---------|---|---|---|---|
| Tidak cocok | 0 | Form | Error merah | ❌ |
| Spesifik | 1 | Hasil | Sukses hijau | ✅ |
| Ambigu | > 1 | Hasil | Warning kuning | ❌ |

---

## 📁 File yang Dimodifikasi

| File | Tipe | Perubahan |
|------|------|----------|
| `app/Services/CertaintyFactorService.php` | Update | +2 method baru |
| `app/Services/DiagnosisService.php` | Update | Gunakan CF details |
| `app/Http/Controllers/DiagnosisController.php` | Update | +Validasi multiple |
| `resources/views/diagnosis/hasil.blade.php` | Update | +CF breakdown, error display |
| `resources/views/diagnosis/form.blade.php` | Update | +nl2br formatting |

---

## ✨ Fitur Baru

### 1. **Transparansi Perhitungan**
- Setiap langkah CF calculation ditampilkan dengan jelas
- User dapat memahami bagaimana hasil diagnosis dihitung

### 2. **Validasi Spesifisitas Diagnosis**
- Sistem memaksa user memilih gejala yang cukup spesifik
- Mencegah ambiguitas diagnosis

### 3. **Panduan Interaktif**
- Pesan error menunjukkan gejala apa yang perlu ditambahkan
- User tidak perlu bingung memilih gejala selanjutnya

### 4. **Pembersihan Riwayat**
- Hanya diagnosis yang spesifik dan jelas yang disimpan
- Riwayat lebih akurat dan relevan

---

## 🧪 Scenario Testing

### Scenario 1: User memilih gejala umum
```
Input: G01, G05
Output: 3 penyakit cocok
Result: ⚠️ Error page - Gejala kurang ditampilkan
Save: ❌ Tidak disimpan
```

### Scenario 2: User memilih gejala spesifik
```
Input: G23, G06, G09
Output: 1 penyakit cocok (P06)
Result: ✅ Hasil diagnosis - CF breakdown ditampilkan
Save: ✅ Disimpan ke riwayat
```

### Scenario 3: User memilih gejala yang tidak cocok
```
Input: G01, G02, G03
Output: 0 penyakit cocok
Result: ❌ Error di form
Save: ❌ Tidak disimpan
```

---

## 📈 Keuntungan Pembaruan

✅ **Akurasi Diagnosis**: Hanya menampilkan hasil yang spesifik
✅ **Transparansi**: User bisa lihat perhitungan detail
✅ **User Experience**: Panduan jelas untuk memilih gejala
✅ **Data Quality**: Riwayat hanya menyimpan diagnosis yang akurat
✅ **Maintainability**: Kode lebih terstruktur dan mudah dipahami

---

## 🔧 Catatan Teknis

- Method `gejala()` digunakan untuk relasi Many-to-Many dengan Penyakit
- Gejala yang kurang dihitung dengan `array_diff()` antara gejala penyakit dan gejala terpilih
- CF calculation menggunakan iterasi untuk > 2 gejala
- Persentase selalu dibulatkan ke integer terdekat

---

**Status**: ✅ Siap untuk Testing & Deployment
**Versi**: 1.1.0 (CF Implementation Update)
**Last Updated**: April 28, 2026
