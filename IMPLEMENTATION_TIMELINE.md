# 📋 IMPLEMENTATION CHECKLIST - JAMUR TIRAM DIAGNOSIS SYSTEM

**Project:** Backend Implementation untuk Diagnosis Jamur Tiram  
**Status:** Ready for Development  
**Referensi Perhitungan:** docs/sistem.md  
**Fokus:** Backend Code ONLY (UI tidak diubah)
**Catatan:** Jika implementasi sudah selesai maka centang yang sudah dikerjakan

---

## 📊 DATA STRUCTURE

## � DATA STRUCTURE

### Gejala (Symptoms)
> 25 Gejala dari G01-G25 (lihat docs/sistem.md - Tabel Data Gejala) 

### Penyakit (Diseases/Pests) 
> 10 Penyakit: P01-P10 (Trichoderma, Neurospora, Mucor, dsb) 

### Rule Base 
> 10 Rules dengan formasi IF...THEN (lihat tabel Rule Base) 
> Rule mappings dengan gejala (3-4 gejala per rule) 

### Certainty Factor Mapping
> CF Pakar untuk setiap kombinasi Penyakit+Gejala (lihat Tabel Bobot Nilai CF Pakar) 
> CF Scale: 1.0 (Sangat Yakin), 0.8 (Yakin), 0.6 (Cukup Yakin), 0.4 (Sedikit Yakin), 0.2 (Tidak Tahu) 

---

## 🗄️ PHASE 1: DATABASE SETUP ✅ COMPLETED

### Environment Configuration [✓]
> Konfigurasi .env untuk MySQL connection [✓]
> Jalankan `php artisan serve` untuk verify installasi [✓]

### Create Migrations [✓]
> Database seeder untuk 25 gejala (G01-G25) [✓] - Actually 24 gejala (G03 skip)
> Database seeder untuk 10 penyakit (P01-P10) dengan solusi JSON [✓]
> Database seeder untuk CF mapping (penyakit_gejala) [✓]
> Database seeder untuk 10 rules dengan detail gejala [✓]
> Jalankan `php artisan migrate` [✓]

### Verify Database [✓]
> Pastikan semua tables terbuat dengan benar [✓]
> Verify foreign keys dan relationships [✓]

**Database Verification Results:**
- ✅ Gejala: 24 records (G01-G25, skip G03)
- ✅ Penyakit: 10 records (P01-P10)
- ✅ Rule: 10 records (R1-R10)
- ✅ RuleDetail: 32 records (master-detail)
- ✅ PenyakitGejala: 34 records (CF mappings)
- ✅ P01 CF Values: G06=0.6, G07=0.8, G12=1.0, G18=0.8 ✓

---

## 🔗 PHASE 2: MODELS & RELATIONSHIPS

### Create Eloquent Models [ ]
> Model: Gejala (with relationships to penyakit, rules) [ ]
> Model: Penyakit (with relationships to gejala, rules, history) [ ]
> Model: Rule (with relationships to penyakit, gejala) [ ]
> Model: RuleDetail (pivot table untuk rule-gejala mapping) [ ]
> Model: PenyakitGejala (pivot table untuk CF mapping) [ ]
> Model: DiagnosisHistory (untuk tracking history diagnosis) [ ]

### Define Relationships [ ]
> Gejala belongsToMany Penyakit (via penyakit_gejala) [ ]
> Gejala belongsToMany Rule (via rule_detail) [ ]
> Penyakit hasMany Rule [ ]
> Penyakit hasMany DiagnosisHistory [ ]
> Rule belongsTo Penyakit [ ]
> Rule belongsToMany Gejala (via rule_detail) [ ]

### Add Model Methods [ ]
> Tambah methods untuk query optimization (eager loading) [ ]
> Tambah helper methods untuk business logic [ ]

---

## 🌱 PHASE 3: DATABASE SEEDING

### Seed Gejala (25 records) [ ]
> Insert semua 25 gejala dari G01-G25 [ ]
> Setiap gejala: kode, nama, kategori, deskripsi [ ]

### Seed Penyakit (10 records) [ ]
> Insert 10 penyakit: P01-P10 [ ]
> Setiap penyakit: kode, nama, tipe (Jamur/Bakteri/Hama), deskripsi, solusi (JSON array) [ ]

### Seed Rule & RuleDetail [ ]
> Insert 10 rules dengan format kondisi (R1-R10) [ ]
> Insert rule_detail untuk mappings gejala dalam setiap rule [ ]
  > R1: G12 AND G18 AND G06 AND G07 (untuk P01) [ ]
  > R2: G13 AND G06 AND G07 (untuk P02) [ ]
  > R3: G11 AND G06 AND G07 (untuk P03) [ ]
  > R4: G12 AND G23 AND G06 (untuk P04) [ ]
  > R5: G01 AND G10 AND G14 AND G22 (untuk P05) [ ]
  > R6: G23 AND G06 AND G09 (untuk P06) [ ]
  > R7: G15 AND G24 AND G20 (untuk P07) [ ]
  > R8: G09 AND G24 AND G20 (untuk P08) [ ]
  > R9: G01 AND G02 AND G25 (untuk P09) [ ]
  > R10: G05 AND G19 AND G25 (untuk P10) [ ]

### Seed CF Mapping (PenyakitGejala) [ ]
> Insert semua CF Pakar values dari tabel "Bobot Nilai CF Pakar" [ ]
> P01 (Trichoderma): CF mapping untuk G12(1.0), G18(0.8), G06(0.6), G07(0.8) [ ]
> P02 (Neurospora): CF mapping untuk G13(1.0), G06(0.6), G07(0.8) [ ]
> P03 (Mucor): CF mapping untuk G11(1.0), G06(0.6), G07(0.8) [ ]
> P04 (Penicilium): CF mapping untuk G12(1.0), G06(0.6), G23(0.8) [ ]
> P05 (Pseudomonas): CF mapping untuk G01(1.0), G10(0.8), G14(0.8), G16(0.4), G17(0.6), G22(0.8) [ ]
> P06 (Chaetomium): CF mapping untuk G23(1.0), G06(0.6), G09(0.6) [ ]
> P07 (Coprinus): CF mapping untuk G15(1.0), G24(0.6), G20(0.6) [ ]
> P08 (Tikus): CF mapping untuk G09(0.8), G24(0.8), G20(0.6) [ ]
> P09 (Lalat): CF mapping untuk G01(0.6), G02(0.6), G25(0.8) [ ]
> P10 (Tunggu): CF mapping untuk G05(0.8), G19(0.8), G25(0.6) [ ]

### Run DatabaseSeeder [ ]
> Execute `php artisan db:seed` [ ]
> Verify dengan `php artisan tinker`: Gejala::count() => 25, Penyakit::count() => 10, Rule::count() => 10 [ ]

---

## 🧠 PHASE 4: BUSINESS LOGIC SERVICES

### ForwardChainingService [ ]
> Create `app/Services/ForwardChainingService.php` [ ]
> Implement method `findMatchingDiseases(array $gejalaIds): array` [ ]
  > Logic: Cocokkan gejala dengan semua rules [ ]
  > Return: Array penyakit yang cocok dengan rules [ ]
  > Contoh: Jika user pilih G12, G18, G06, G07 => match dengan R1 => return P01 [ ]

### CertaintyFactorService [ ]
> Create `app/Services/CertaintyFactorService.php` [ ]
> Implement method `calculateCF(int $penyakitId, array $gejalaIds): float` [ ]
  > Formula 1 (1 gejala): CF = CF_pakar × CF_user [ ]
  > Formula 2 (>1 gejala): CF_combine = CF₁ + CF₂(1 - CF₁) iteratif [ ]
  > CF_user default: 0.8 (user confidence level default) [ ]
  > Return: CF value (0-1) [ ]
> Implement method `toPercentage(float $cf): float` untuk konversi ke persen [ ]
> Test calculation dengan data dari docs/sistem.md (P01 harus = 93.77%, P02 harus = 88.02%) [ ]

### DiagnosisService (Orchestrator) [ ]
> Create `app/Services/DiagnosisService.php` [ ]
> Implement method `diagnose(array $gejalaIds): array` [ ]
  > Step 1: Call ForwardChainingService untuk find matching diseases [ ]
  > Step 2: Call CertaintyFactorService untuk calculate CF setiap disease [ ]
  > Step 3: Sort hasil by CF percentage (descending) [ ]
  > Step 4: Return formatted results [ ]
> Implement method `getConfidenceStatus(float $cf): string` [ ]
  > CF >= 0.9: "Sangat Yakin" [ ]
  > CF >= 0.8: "Yakin" [ ]
  > CF >= 0.6: "Cukup Yakin" [ ]
  > CF >= 0.4: "Sedikit Yakin" [ ]
  > CF < 0.4: "Tidak Yakin" [ ]

---

## 🎛️ PHASE 5: CONTROLLERS & ROUTES

### DiagnosisController [ ]
> Create `app/Http/Controllers/DiagnosisController.php` [ ]
> Implement `showForm()` method [ ]
  > Get semua gejala (25) dari database [ ]
  > Pass ke view 'diagnosis.form' [ ]
> Implement `process(Request $request)` method [ ]
  > Validate: gejala array (min 1, must exist in gejala table) [ ]
  > Call DiagnosisService::diagnose() [ ]
  > If no match: return back with error message [ ]
  > If match: pass results ke view 'diagnosis.hasil' [ ]
> Implement `apiProcess(Request $request)` method (JSON response) [ ]
  > Accept gejala_ids dari request [ ]
  > Return diagnosis results as JSON [ ]

### Update Routes (routes/web.php) [ ]
> Route GET /diagnosis => showForm() [ ]
> Route POST /diagnosis => process() [ ]
> Route POST /api/diagnosis => apiProcess() [ ]
> Test routes dengan browser dan curl [ ]

---

## 🧪 PHASE 6: INTEGRATION & TESTING

### Manual Testing [ ]
> Test Case 1: P01 (Trichoderma) [ ]
  > Pilih G12, G18, G06, G07 => Expected: ~93.77% confidence [ ]
> Test Case 2: P02 (Neurospora) [ ]
  > Pilih G13, G06, G07 => Expected: ~88.02% confidence [ ]
> Test Case 3: P05 (Pseudomonas) [ ]
  > Pilih G01, G10, G14, G22 => Expected hasil dengan confidence [ ]
> Test Case 4: Multiple results [ ]
  > Pilih gejala yang match multiple diseases => Verify sorting by confidence [ ]
> Test Case 5: No match [ ]
  > Pilih gejala yang tidak match any rule => Get "no match" error [ ]

### Database Query Optimization [ ]
> Add eager loading di services (with relationships) [ ]
> Add indexes pada foreign keys (penyakit_id, gejala_id) [ ]
> Test query performance [ ]

### Error Handling [ ]
> Add try-catch blocks untuk database errors [ ]
> Add validation error messages [ ]
> Add logging untuk diagnosis attempts [ ]

### UI Integration (Existing Frontend) [ ]
> Update diagnosis form route di navbar/menu untuk point ke /diagnosis [ ]
> Verify hasil diagnosis tampil di existing hasil template [ ]
> Test form submission dengan berbagai input [ ]

---

## ✅ PHASE 7: VERIFICATION & FINAL TESTING

### Unit Testing [ ]
> Test ForwardChainingService methods [ ]
> Test CertaintyFactorService CF calculations [ ]
> Test DiagnosisService orchestration [ ]

### Integration Testing [ ]
> End-to-end diagnosis flow (form => process => hasil) [ ]
> API endpoint testing [ ]

### CF Calculation Verification [ ]
> Bandingkan hasil perhitungan dengan manual calculation dari docs/sistem.md [ ]
> P01: 93.77% ✓ [ ]
> P02: 88.02% ✓ [ ]
> P05: 93.77% ✓ (sesuai contoh) [ ]
> Penyakit lain: Verify dengan pakar jika perlu [ ]

### Performance Testing [ ]
> Test dengan input 1-25 gejala [ ]
> Verify response time < 1 second [ ]
> Check database queries (use Laravel Debugbar) [ ]

### Bug Fixes [ ]
> Fix any issues found during testing [ ]
> Optimize code jika ada performance bottleneck [ ]

---

## 📦 PHASE 8: CODE CLEANUP & DOCUMENTATION

### Code Quality [ ]
> Add PHPDoc comments ke semua methods [ ]
> Format code sesuai PSR-2 standard [ ]
> Remove debug code / dd() statements [ ]
> Add inline comments untuk business logic kompleks [ ]

### Service Documentation [ ]
> Document ForwardChainingService: cara kerja, input, output [ ]
> Document CertaintyFactorService: formula, example calculation [ ]
> Document DiagnosisService: orchestration flow [ ]

### Database Documentation [ ]
> Document semua table schema dan relationships [ ]
> Document seeder data source dan mappings [ ]

---

## 🚀 PHASE 9: DEPLOYMENT CHECKLIST

### Pre-Deployment [ ]
> Database backup created [ ]
> .env configuration verified (DB credentials) [ ]
> Laravel cache cleared (`php artisan cache:clear`) [ ]
> Routes cached (`php artisan route:cache`) [ ]

### Deployment [ ]
> Deploy code ke server/production environment [ ]
> Run migrations on production [ ]
> Run seeders on production [ ]

### Post-Deployment [ ]
> Test diagnosis flow di production [ ]
> Monitor error logs [ ]
> Verify database connections [ ]
> Test dengan real data dari users [ ]

---

## 📋 SUMMARY BY PHASE

| Fase | Task | Durasi Est | Status |
|------|------|----------|--------|
| 1 | Database Setup | 2-3h | [ ] |
| 2 | Models & Relationships | 2-3h | [ ] |
| 3 | Database Seeding | 3-4h | [ ] |
| 4 | Business Logic Services | 5-6h | [ ] |
| 5 | Controllers & Routes | 3-4h | [ ] |
| 6 | Integration & Testing | 4-5h | [ ] |
| 7 | Verification & Testing | 3-4h | [ ] |
| 8 | Code Cleanup | 1-2h | [ ] |
| 9 | Deployment | 1-2h | [ ] |
| | **TOTAL** | **~25-33 jam** | |

---

## 🎯 SUCCESS CRITERIA

✓ Semua gejala (25), penyakit (10), rules (10), CF mappings terseed  
✓ Diagnosis logic berfungsi dengan benar  
✓ CF calculation verified sesuai docs/sistem.md  
✓ Confidence levels: P01=93.77%, P02=88.02%, P05=93.77%, dsb  
✓ Frontend form berfungsi dengan backend  
✓ No critical bugs  
✓ Performance acceptable (<1s response time)  
✓ Code documented & clean  

---

## 📝 NOTES

- Referensi perhitungan: `docs/sistem.md` - Lihat section "Perhitungan CF"
- UI tidak diubah - hanya backend code
- Tidak ada admin panel (as requested)
- All data seeding dari docs/sistem.md tables
- CF User default: 0.8 (jika user tidak input confidence level)

---

**Last Updated:** 15 Maret 2026  
**Ready for Development** ✅
