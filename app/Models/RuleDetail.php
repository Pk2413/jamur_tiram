<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RuleDetail extends Model
{
    protected $table = 'rule_detail';
    protected $fillable = ['rule_id', 'gejala_id', 'urutan'];

    /**
     * Belongs-to relationship dengan Rule
     */
    public function rule()
    {
        return $this->belongsTo(Rule::class, 'rule_id');
    }

    /**
     * Belongs-to relationship dengan Gejala
     */
    public function gejala()
    {
        return $this->belongsTo(Gejala::class, 'gejala_id');
    }
}
