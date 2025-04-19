<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Livewire\Attributes\Layout;

class pegawai extends Model
{
    protected $guarded = [];

    public function golongan()
    {
        return $this->belongsTo(golongan::class, 'golongan_id');
    }

    public function eselon()
    {
        return $this->belongsTo(eselon::class, 'eselon_id');
    }

    public function jabatan()
    {
        return $this->belongsTo(jabatan::class, 'jabatan_id');
    }

    public function agama()
    {
        return $this->belongsTo(agama::class, 'agama_id');
    }

    public function unitKerja()
    {
        return $this->belongsTo(unitKerja::class, 'unit_kerja_id');
    }

}
