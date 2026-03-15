<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penyakit extends Model
{
    protected $table = 'penyakit';
    protected $fillable = ['kode', 'nama', 'tipe', 'deskripsi', 'solusi', 'image_url'];
    protected $casts = ['solusi' => 'json'];

    /**
     * Many-to-Many relationship dengan Gejala via penyakit_gejala
     */
    public function gejala()
    {
        return $this->belongsToMany(Gejala::class, 'penyakit_gejala')
                    ->withPivot('cf_pakar', 'deskripsi')
                    ->withTimestamps();
    }

    /**
     * One-to-Many relationship dengan Rule
     */
    public function rules()
    {
        return $this->hasMany(Rule::class, 'penyakit_id');
    }

    /**
     * One-to-Many relationship dengan DiagnosisHistory
     */
    public function diagnosisHistories()
    {
        return $this->hasMany(DiagnosisHistory::class, 'hasil_penyakit_id');
    }

    /**
     * Get solusi as array
     */
    public function getSolusiArray()
    {
        return $this->solusi ?? [];
    }
}
