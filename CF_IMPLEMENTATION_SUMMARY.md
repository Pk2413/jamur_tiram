# Implementasi Metode Certainty Factor dengan Kombinasi Gejala

## Ringkasan Perubahan

Sistem telah disesuaikan untuk mengimplementasikan metode **Certainty Factor (CF)** dengan kombinasi dari setiap gejala yang terpilih, sesuai dengan contoh perhitungan yang diberikan (P1-P10).

## 1. CertaintyFactorService (app/Services/CertaintyFactorService.php)

### Fitur Baru:
- **`calculateCFWithDetails()`**: Menghitung CF dengan detail perhitungan lengkap
  - Mengembalikan `cf_value` (0-1), `cf_percentage` (integer), `cf_percentage_float`, dan langkah-langkah perhitungan
  - Menangani kasus tanpa gejala cocok dengan pesan: "Tidak terdapat gejala yang sesuai, sehingga tidak dilakukan perhitungan Certainty Factor"

- **`toPercentageInt()`**: Konversi CF ke persentase integer dengan pembulatan ke bilangan bulat terdekat
  - Contoh: 87.2 → 87, 93.344 → 93

### Formula yang Diimplementasikan:
```
Single Symptom:
CF(H,E) × 100% = CF_pakar × CF_user × 100%

Multiple Symptoms:
CF_combine = CF1 + CF2 × (1 - CF1)
Untuk lebih dari 2 gejala, rumus diterapkan secara iteratif
```

## 2. DiagnosisService (app/Services/DiagnosisService.php)

### Perubahan:
- Menggunakan `calculateCFWithDetails()` untuk mendapatkan detail perhitungan
- **Mengecualikan penyakit yang tidak memiliki gejala cocok** (has_matching_symptoms = false)
  - Sesuai dengan contoh: P5, P7, P9, P10 tidak dilakukan perhitungan
- Menambahkan data detail ke hasil:
  - `calculation_details`: Penjelasan perhitungan
  - `symptoms_detail`: Detail setiap gejala yang cocok (CF pakar, CF user, CF hasil)
  - `combine_steps`: Langkah-langkah kombinasi CF

## 3. View (resources/views/diagnosis/hasil.blade.php)

### Penambahan:
1. **Bagian Perhitungan Certainty Factor**:
   - Menampilkan setiap gejala yang cocok dengan CF value-nya
   - Menampilkan proses kombinasi CF secara detail
   - Hasil akhir dengan persentase bulat

2. **Kemungkinan Penyakit Lain**:
   - Menampilkan semua penyakit yang memiliki gejala cocok (sorted by confidence)
   - Memudahkan perbandingan antar penyakit

3. **Tampilan yang Lebih Informatif**:
   - Status diagnosis berdasarkan confidence level
   - Deskripsi dan solusi untuk penyakit utama
   - Confidence level untuk setiap kemungkinan

## Contoh Implementasi

### P1 - Single Symptom (36%)
```
Gejala: G12 (satu gejala cocok)
CF = 0.45 × 0.8 = 0.36
CF_percentage = 0.36 × 100% = 36%
```

### P4 - Multiple Symptoms (87%)
```
Gejala cocok: G12 (CF pakar=1), G06 (CF pakar=0.6), G23 (CF pakar=0.8)
User memilih G12 dan G23:
CF1 = 1.0 × 0.8 = 0.80
CF2 = 0.8 × 0.8 = 0.64

Dengan data lain yang sesuai:
CF_combine = 0.80 + CF2 × (1 - 0.80)
Hasil: 87.2% → 87% (pembulatan integer)
```

### P6 - Multiple Symptoms (93%)
```
Gejala cocok: G23, G06, G09
Iterasi kombinasi:
CF_combine1 = CF1 + CF2 × (1 - CF1)
CF_combine2 = CF_combine1 + CF3 × (1 - CF_combine1)
Hasil: 93.344% → 93% (pembulatan integer)
```

### P5, P7, P9, P10 - No Matching Symptoms
```
Tidak ada gejala yang cocok dari pilihan user
Hasil: Tidak dilakukan perhitungan
Status: Diexclude dari hasil diagnosis
```

## Fitur Keamanan & Quality

1. **Filtering Otomatis**: Penyakit tanpa gejala cocok otomatis diexclude
2. **Transparent Calculation**: Setiap langkah perhitungan ditampilkan dengan jelas
3. **Consistent Rounding**: Semua persentase dibulatkan ke integer terdekat
4. **User-friendly Display**: Hasil disajikan dalam format yang mudah dipahami

## Data Flow

```
User Input (Gejala Terpilih)
    ↓
DiagnosisController.process()
    ↓
DiagnosisService.diagnose()
    ├─ ForwardChaining: Identifikasi penyakit yang mungkin
    ├─ DecisionTree: Traverse untuk reasoning path
    └─ CertaintyFactor: Hitung CF dengan detail
        └─ calculateCFWithDetails()
            ├─ Filter gejala cocok
            ├─ Hitung individual CF untuk setiap gejala
            ├─ Kombinasi CF secara iteratif
            └─ Return hasil dengan langkah detail
    ↓
Filter: Exclude penyakit tanpa gejala cocok
    ↓
Sort: Urutkan by CF percentage descending
    ↓
View hasil dengan calculation breakdown
```

## File yang Dimodifikasi

1. `app/Services/CertaintyFactorService.php` - Logic perhitungan CF
2. `app/Services/DiagnosisService.php` - Orchestration diagnosis
3. `resources/views/diagnosis/hasil.blade.php` - Display hasil dengan detail

## Testing

Untuk memverifikasi implementasi:
1. Pilih satu gejala → Hasilnya harus single CF calculation tanpa kombinasi
2. Pilih beberapa gejala untuk satu penyakit → Hasilnya harus menampilkan combine steps
3. Pilih gejala yang tidak ada untuk penyakit tertentu → Penyakit tersebut tidak muncul di hasil

---
**Implementasi selesai pada:** April 28, 2026
**Metode:** Certainty Factor dengan kombinasi iteratif
**Status:** Ready for Testing & Deployment
