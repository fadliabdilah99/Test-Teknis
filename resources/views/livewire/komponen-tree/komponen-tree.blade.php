<li class="nav-item submenu">
    <a data-bs-toggle="collapse" href="#unitKerjaMenu" class="collapsed" aria-expanded="false">
        <i class="fas fa-sitemap"></i>
        <p>Unit Kerja</p>
        <span class="caret"></span>
    </a>
    <div class="collapse" id="unitKerjaMenu">
        <ul class="nav nav-collapse">
            <div class="pe-5 ps-4 mb-2">
                <!-- Tombol untuk tambah unit kerja root -->
                <button class="btn btn-success btn-sm" onclick="toggleForm(null, 'unit')">+UK</button>
                <div id="form-unit-null" class="d-none mt-2">
                    <input type="text" wire:model.defer="namaUnitBaru" class="form-control mb-2" placeholder="Nama Unit Baru">
                    <button wire:click="simpanUnit(null)" class="btn btn-sm btn-success">Simpan</button>
                </div>
            </div>

            @foreach ($unitKerjas->where('parent_id', null) as $unit)
                @include('livewire.komponen-tree.unitkerja', ['unit' => $unit])
            @endforeach
        </ul>
    </div>
</li>
