<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gejala extends Model
{
    protected $table = 'gejala';
    protected $fillable = ['kode', 'nama', 'deskripsi', 'kategori'];

    /**
     * Many-to-Many relationship dengan Penyakit via penyakit_gejala
     */
    public function penyakit()
    {
        return $this->belongsToMany(Penyakit::class, 'penyakit_gejala')
                    ->withPivot('cf_pakar', 'deskripsi')
                    ->withTimestamps();
    }

    /**
     * Many-to-Many relationship dengan Rule via rule_detail
     */
    public function rules()
    {
        return $this->belongsToMany(Rule::class, 'rule_detail')
                    ->withPivot('urutan')
                    ->orderBy('urutan')
                    ->withTimestamps();
    }
}
