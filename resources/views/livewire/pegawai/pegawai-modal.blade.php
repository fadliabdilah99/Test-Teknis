    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">{{ $link == 'store' ? 'Tambah Pegawai' : 'Edit Pegawai' }}</h4>
                            <button class="btn btn-primary btn-round ms-auto" wire:click="close()">
                                Kembali
                            </button>
                            <div style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: rgba(0, 0, 0, 0.5); padding: 1rem; border-radius: 0.5rem;"
                                wire:loading>
                                <i class="fa fa-spinner fa-spin ms-3" style="color: white;"></i>
                                <span style="color: white;">Loading...</span>
                            </div>
                        </div>
                    </div>
                    @if (session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="card-body">
                        <form wire:submit.prevent="{{ $link }}" method="POST">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>NIP</label>
                                        <input id="Nip" type="number" wire:model="nip" class="form-control"
                                            placeholder="" required />
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input id="nama" wire:model="nama" type="text" class="form-control"
                                            placeholder="Masukan Nama" required />
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Tempat Lahir</label>
                                        <input id="TempatLahir" wire:model="tempat_lahir" type="text"
                                            class="form-control" placeholder="Masukan Tempat Lahir" required />
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <textarea required id="Alamat" wire:model="alamat" class="form-control" placeholder="Masukan Alamat"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 pe-0">
                                    <div class="form-group">
                                        <label>Tanggal Lahir</label>
                                        <input id="tglLahir" max="{{ date('Y-m-d') }}" wire:model="tgl_lahir"
                                            type="date" class="form-control" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jenis Kelamin (Radio Button)</label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="jenis_kelamin"
                                                id="L" value="L" wire:model="jenis_kelamin" required>
                                            <label class="form-check-label" for="L">Laki-laki</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="jenis_kelamin"
                                                id="P" value="P" wire:model="jenis_kelamin" required>
                                            <label class="form-check-label" for="P">Perempuan</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Golongan</label>
                                        <select required id="golongan" wire:model="golongan_id" class="form-control">
                                            <option selected>Golongan</option>
                                            @foreach ($golongans as $golongan)
                                                <option value="{{ $golongan->id }}">{{ $golongan->gol }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Eselon</label>
                                        <select required id="eselon" wire:model="eselon_id" class="form-control">
                                            <option selected>eselon</option>
                                            @foreach ($eselons as $eselon)
                                                <option value="{{ $eselon->id }}">{{ $eselon->eselon }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="unitKerja">Unit Kerja</label>
                                        {{-- ketika unit kerja di pilih akan request data jabatan sesuai dengan relasi unit kerja yang di pilih --}}
                                        <select required id="unitKerja" wire:change="changeUnitKerja"
                                            wire:model="unitKerja_id" class="form-control select2">
                                            <option value="" selected>Pilih Unit Kerja</option>
                                            @foreach ($unitKerjas as $unitKerja)
                                                {{-- menampilkan struktur unit kerja sampai turunan bernilai null --}}
                                                <option value="{{ $unitKerja->id }}">
                                                    {{ $unitKerja->nama }}
                                                    @php
                                                        $parent = $unitKerja->parent;
                                                        while ($parent) {
                                                            echo ' - ' . $parent->nama;
                                                            $parent = $parent->parent;
                                                        }
                                                    @endphp
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{-- jika jabatan belum di pilih akan di disable --}}
                                        <label>{{ $selectJabatan == true ? 'Jabatan' : 'Pilih Unit Kerja terlebih dahulu' }}</label>
                                        <select {{ $selectJabatan == true ? '' : 'disabled' }} required id="jabatan"
                                            wire:model="jabatan_id" class="form-control">
                                            <option selected>
                                                Jabatan
                                            </option>
                                            @foreach ($jabatans as $jabatan)
                                                <option value="{{ $jabatan->id }}">{{ $jabatan->jabatan }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Agama</label>
                                        <select required id="agama" wire:model="agama_id" class="form-control">
                                            <option selected>
                                                agama
                                            </option>
                                            @foreach ($agamas as $agama)
                                                <option value="{{ $agama->id }}">{{ $agama->agama }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 pe-0">
                                    <div class="form-group">
                                        <label>Tempat tugas</label>
                                        <input required id="temptaTugas" wire:model="tempat_tugas" type="text"
                                            class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-6 pe-0">
                                    <div class="form-group">
                                        <label>No Hp</label>
                                        <input id="No" wire:model="no_hp" type="number"
                                            class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-6 pe-0">
                                    <div class="form-group">
                                        <label>NPWP</label>
                                        <input id="npwp" wire:model="npwp" type="number"
                                            class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-12 pe-0">
                                    <div class="form-group">
                                        <label>Foto</label>
                                        <input type="file" id="foto" wire:model="foto" accept="image/*"
                                            class="form-control" />
                                        @if ($foto)
                                            <img src="{{ asset('storage/fotoPegawai/' . $foto) }}" alt="Preview"
                                                class="img-thumbnail mt-2" style="width: 150px; height: auto;" />
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ $link == 'store' ? 'Simpan' : 'Update' }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
