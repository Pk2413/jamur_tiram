<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    protected $table = 'rule';
    protected $fillable = ['kode', 'penyakit_id', 'kondisi_format', 'jumlah_gejala'];

    /**
     * Belongs-to relationship dengan Penyakit
     */
    public function penyakit()
    {
        return $this->belongsTo(Penyakit::class, 'penyakit_id');
    }

    /**
     * Many-to-Many relationship dengan Gejala via rule_detail
     */
    public function gejala()
    {
        return $this->belongsToMany(Gejala::class, 'rule_detail')
                    ->withPivot('urutan')
                    ->orderBy('urutan')
                    ->withTimestamps();
    }

    /**
     * Get gejala IDs dari rule
     */
    public function getGejalaIds()
    {
        return $this->gejala()->pluck('gejala.id')->toArray();
    }

    /**
     * Check if all gejala dalam rule cocok dengan selected gejala
     */
    public function matches(array $selectedGejalaIds): bool
    {
        $ruleGejalaIds = $this->getGejalaIds();
        
        foreach ($ruleGejalaIds as $gejalaId) {
            if (!in_array($gejalaId, $selectedGejalaIds)) {
                return false;
            }
        }
        
        return true;
    }
}
