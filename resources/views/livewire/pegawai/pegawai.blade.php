<div>

    @if ($modal)
        @include('livewire.pegawai.pegawai-modal')
    @else
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    @if (session()->has('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Data Pegawai</h4>
                        <button class="btn btn-primary btn-round ms-auto" wire:click="showCreate()">
                            <i class="fa fa-plus"></i>
                            Tambah Pegawai
                        </button>
                        <div class="ms-1">
                            <button type="button" class="btn btn-success btn-round" wire:click="exportExcel()">
                                <i class="fa fa-file-excel"></i>
                                Export Excel
                            </button>
                        </div>
                        <div class="ms-1">
                            <a href="{{ route('pegawai.cetak') }}" target="_blank" class="btn btn-success btn-round"
                                wire:click="print()">
                                <i class="fas fa-print"></i>
                                Print
                            </a>
                        </div>
                        <div style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: rgba(0, 0, 0, 0.5); padding: 1rem; border-radius: 0.5rem;"
                            wire:loading>
                            <i class="fa fa-spinner fa-spin ms-3" style="color: white;"></i>
                            <span style="color: white;">Loading...</span>
                        </div>
                    </div>
                </div>
                <div class="card-body">


                    <div class="table-responsive">
                        <table id="add-row" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Tempat Lahir</th>
                                    <th>Alamat</th>
                                    <th>Tgl Lahir</th>
                                    <th>L/P</th>
                                    <th>Gol</th>
                                    <th>Eselon</th>
                                    <th>Jabatan</th>
                                    <th>Tempat Tugas</th>
                                    <th>Agama</th>
                                    <th>Unit Kerja</th>
                                    <th>No. Hp</th>
                                    <th>NPWP</th>
                                    <th style="width: 10%">Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Tempat Lahir</th>
                                    <th>Alamat</th>
                                    <th>Tgl Lahir</th>
                                    <th>L/P</th>
                                    <th>Gol</th>
                                    <th>Eselon</th>
                                    <th>Jabatan</th>
                                    <th>Tempat Tugas</th>
                                    <th>Agama</th>
                                    <th>Unit Kerja</th>
                                    <th>No. Hp</th>
                                    <th>NPWP</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($pegawais as $index => $pegawai)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $pegawai->nip }}</td>
                                        <td class="text-center"><img
                                                src="{{ asset('storage/fotoPegawai/' . $pegawai->foto) }}"
                                                alt="..."
                                                style="width: 50px; height: 50px; object-fit: cover; object-position: center;"
                                                class="avatar-img rounded-circle">{{ $pegawai->nama }}</td>
                                        <td>{{ $pegawai->tempat_lahir }}</td>
                                        <td>{{ $pegawai->alamat }}</td>
                                        <td>{{ $pegawai->tgl_lahir }}</td>
                                        <td>{{ $pegawai->jenis_kelamin }}</td>
                                        <td>{{ $pegawai->golongan->gol }}</td>
                                        <td>{{ $pegawai->eselon->eselon }}</td>
                                        <td>{{ $pegawai->jabatan->jabatan }}</td>
                                        <td>{{ $pegawai->tempat_tugas }}</td>
                                        <td>{{ $pegawai->agama->agama }}</td>
                                        <td>{{ $pegawai->unit_kerja->nama ?? '-' }}</td>
                                        <td>{{ $pegawai->no_hp }}</td>
                                        <td>{{ $pegawai->npwp }}</td>
                                        <td>
                                            <div class="form-button-action">
                                                <button type="button" wire:click="showEdit({{ $pegawai->id }})"
                                                    data-bs-toggle="tooltip" title=""
                                                    class="btn btn-link btn-primary btn-lg"
                                                    data-original-title="Edit Task">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-link btn-danger"
                                                    onclick="confirmDeletion({{ $pegawai->id }})"
                                                    data-bs-toggle="tooltip" title=""
                                                    data-original-title="Remove">
                                                    <i class="fa fa-times"></i>
                                                </button>


                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>

@push('scripts')
    <script>
        $("#add-row").DataTable({
            pageLength: 5,
        });
    </script>

    <script>
        function confirmDeletion(pegawaiId) {
            Swal.fire({
                title: 'Apa kamu yakin?',
                text: "Anda tidak dapat mengembalikan data ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.call('delete', pegawaiId);
                }
            })
        }
    </script>
@endpush
