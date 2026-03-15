<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiagnosisHistory extends Model
{
    protected $table = 'diagnosis_history';
    protected $fillable = ['gejala_terpilih', 'hasil_penyakit_id', 'confidence_level'];
    protected $casts = ['gejala_terpilih' => 'json'];

    /**
     * Belongs-to relationship dengan Penyakit
     */
    public function penyakit()
    {
        return $this->belongsTo(Penyakit::class, 'hasil_penyakit_id');
    }

    /**
     * Get gejala array
     */
    public function getGejalaArray()
    {
        return $this->gejala_terpilih ?? [];
    }
}
