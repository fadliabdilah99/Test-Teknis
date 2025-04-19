<?php

namespace App\Livewire\Pegawai;

use App\Models\jabatan;
use App\Models\unitKerja;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class DetailUnit extends Component
{

    public $jabatanId;
    public $jabatan;

    // Menerima parameter dari route
    public function mount($id)
    {
        $this->jabatanId = $id;
        $this->jabatan = jabatan::with(['unitKerja', 'pegawai'])->findOrFail($id);
    }


    public function render()
    {
        // dd($this->jabatan);
        return view('livewire.pegawai.detail-unit');
    }
}
