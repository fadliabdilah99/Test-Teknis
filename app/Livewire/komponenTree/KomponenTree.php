<?php

namespace App\Livewire\KomponenTree;

use App\Models\jabatan;
use App\Models\unitKerja;
use Livewire\Component;

class KomponenTree extends Component
{
    public $formMode = null; // 'unit' atau 'jabatan'
    public $parentId = null;
    public $namaUnitBaru, $namaJabatanBaru;

    public function mount() {}


    // method untuk simpan unit kerja
    public function simpanUnit($parentId)
    {
        UnitKerja::create([
            'nama' => $this->namaUnitBaru,
            'parent_id' => $parentId,
        ]);

        $this->namaUnitBaru = '';
    }

    // method untuk simpan jabatan
    public function simpanJabatan($unitId)
    {
        Jabatan::create([
            'jabatan' => $this->namaJabatanBaru,
            'unit_kerja_id' => $unitId,
        ]);

        $this->namaJabatanBaru = '';
    }



    public function render()
    {
        $unitKerjas = unitKerja::with('jabatans')->get();
        $tree = $this->buildTree($unitKerjas);
        return view('livewire.komponen-tree.komponen-tree', compact('tree', 'unitKerjas'));
    }

    // fungsi untuk membuat tree
    public function buildTree($items, $parentId = 0)
    {
        $branch = [];

        foreach ($items as $item) {
            if ($item->induk_id == $parentId) {
                $children = $this->buildTree($items, $item->id);
                if ($children) {
                    $item->children = $children;
                }
                $branch[] = $item;
            }
        }

        return $branch;
    }
}
