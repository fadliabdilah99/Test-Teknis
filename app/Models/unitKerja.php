<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class unitKerja extends Model
{
    protected $guarded = [];


    public function parent()
    {
        return $this->belongsTo(UnitKerja::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(UnitKerja::class, 'parent_id');
    }

    public function jabatans()
    {
        return $this->hasMany(Jabatan::class, 'unit_kerja_id');
    }
}
