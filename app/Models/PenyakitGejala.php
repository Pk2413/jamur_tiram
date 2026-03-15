<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenyakitGejala extends Model
{
    protected $table = 'penyakit_gejala';
    protected $fillable = ['penyakit_id', 'gejala_id', 'cf_pakar', 'deskripsi'];

    /**
     * Belongs-to relationship dengan Penyakit
     */
    public function penyakit()
    {
        return $this->belongsTo(Penyakit::class, 'penyakit_id');
    }

    /**
     * Belongs-to relationship dengan Gejala
     */
    public function gejala()
    {
        return $this->belongsTo(Gejala::class, 'gejala_id');
    }
}
