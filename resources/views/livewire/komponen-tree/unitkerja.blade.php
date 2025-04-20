<li class="nav-item submenu ">
    <a data-bs-toggle="collapse" href="#unit-{{ $unit->id }}" class="" aria-expanded="false">
        <span class="sub-item">{{ $unit->nama }}</span>
        <span class="caret"></span>
    </a>

    <div class="collapse" id="unit-{{ $unit->id }}">
        <ul class="nav nav-collapse subnav px-3">

            <!-- TOMBOL -->
            <div class="d-flex">
                <button class="text-light btn btn-sm btn-transparent"
                    onclick="toggleForm({{ $unit->id }}, 'unit')">+ UK</button>
                <span>|</span>
                <button class="text-light btn btn-sm btn-transparent"
                    onclick="toggleForm({{ $unit->id }}, 'jabatan')">+ JB</button>
            </div>

            <!-- FORM TAMBAH UNIT -->
            <div class="form-tambah-unit d-none" id="form-unit-{{ $unit->id }}">
                <input type="text" class="form-control mb-2" placeholder="Nama Unit Baru"
                    wire:model.defer="namaUnitBaru">
                <button class="btn btn-sm btn-success" wire:click="simpanUnit({{ $unit->id }})">Simpan Unit</button>
            </div>

            <!-- FORM TAMBAH JABATAN -->
            <div class="form-tambah-jabatan d-none" id="form-jabatan-{{ $unit->id }}">
                <input type="text" class="form-control mb-2" placeholder="Nama Jabatan"
                    wire:model.defer="namaJabatanBaru">
                <button class="btn btn-sm btn-primary" wire:click="simpanJabatan({{ $unit->id }})">Simpan
                    Jabatan</button>
            </div>

            {{-- menampilkan unit kerja jika masih terdapat turunan selanjutnya --}}
            @foreach ($unit->children as $child)
                @include('livewire.komponen-tree.unitkerja', ['unit' => $child])
            @endforeach
            {{-- menampilkan jabatan yang terdapat dalam unit kerja tertentu --}}
            @foreach ($unit->jabatans as $jabatan)
                <li class="nav-item">
                    <a href="{{ route('unitkerja.detail', $jabatan->id) }}" class="nav-link {{ request()->is('unitkerja/pegawai/*') }}" wire:navigate>
                        <i class="fas fa-user"></i>
                        <p>{{ $jabatan->jabatan }}</p>
                        {{-- <span class="badge badge-success">4</span> --}}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</li>
