<?php

namespace App\Livewire\Pegawai;

use App\Exports\pegawaisExport;
use App\Models\agama;
use App\Models\eselon;
use App\Models\golongan;
use App\Models\jabatan;
use App\Models\pegawai as ModelsPegawai;
use App\Models\unitKerja;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

#[Layout('layouts.app')]
class Pegawai extends Component
{

    use WithFileUploads;

    // variable untuk menampung data yang di perlukan
    public $pegawai_id, $nip, $nama, $tempat_lahir, $alamat, $tgl_lahir, $jenis_kelamin, $golongan_id, $eselon_id, $jabatan_id, $tempat_tugas, $agama_id, $no_hp, $npwp, $foto, $link, $modal = false, $selectJabatan = false, $unitKerja_id, $unitKerjas, $golongans, $eselons, $jabatans, $agamas = [];


    // deklarasi variable untuk pertama kali di load
    public function mount()
    {
        $this->unitKerjas = unitKerja::with('parent')->get();
        $this->golongans = golongan::all();
        $this->eselons = eselon::all();
        $this->jabatans = jabatan::all();
        $this->agamas = agama::all();
        // $this->pegawais = ModelsPegawai::with('golongan', 'eselon', 'jabatan', 'agama', 'unitKerja')->get();
    }


    // method untuk menampilkan modal
    public function showCreate()
    {
        $this->link = "store";
        $this->modal = true;
    }

    // method untuk reset form
    public function resetForm()
    {
        $this->nip = '';
        $this->nama = '';
        $this->tempat_lahir = '';
        $this->alamat = '';
        $this->tgl_lahir = '';
        $this->jenis_kelamin = '';
        $this->golongan_id = '';
        $this->eselon_id = '';
        $this->jabatan_id = '';
        $this->tempat_tugas = '';
        $this->agama_id = '';
        $this->unitKerja_id = '';
        $this->no_hp = '';
        $this->npwp = '';
        $this->foto = null;
    }

    // method untuk menutup modal
    public function close()
    {
        $this->modal = false;
        $this->resetForm();
    }

    // validasi setiap variale
    protected $rules = [
        'nip' => 'required|integer',
        'nama' => 'required|string|max:255',
        'tempat_lahir' => 'required|string|max:255',
        'alamat' => 'required|string',
        'tgl_lahir' => 'required|date',
        'jenis_kelamin' => 'required|in:L,P',
        'golongan_id' => 'required|integer',
        'eselon_id' => 'required|integer',
        'jabatan_id' => 'required|integer',
        'tempat_tugas' => 'required|string|max:255',
        'agama_id' => 'required|integer',
        'unitKerja_id' => 'nullable|integer',
        'no_hp' => 'nullable',
        'npwp' => 'nullable|string|max:255',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
    ];

    // fungsi untuk menyimpan data
    public function store()
    {
        try {
            // validasi data sesuai dengan rules
            $this->validate();
            // dd($this->all());
            $pegawai = new ModelsPegawai();
            Log::info($pegawai);
            $pegawai->nip = $this->nip;
            $pegawai->nama = $this->nama;
            $pegawai->tempat_lahir = $this->tempat_lahir;
            $pegawai->alamat = $this->alamat;
            $pegawai->tgl_lahir = $this->tgl_lahir;
            $pegawai->jenis_kelamin = $this->jenis_kelamin;
            $pegawai->golongan_id = $this->golongan_id;
            $pegawai->eselon_id = $this->eselon_id;
            $pegawai->jabatan_id = $this->jabatan_id;
            $pegawai->tempat_tugas = $this->tempat_tugas;
            $pegawai->agama_id = $this->agama_id;
            $pegawai->unit_kerja_id = $this->unitKerja_id;
            $pegawai->no_hp = $this->no_hp;
            $pegawai->npwp = $this->npwp;

            // jika ada file foto, simpan di folder public/storage/fotoPegawai
            if ($this->foto) {
                $imageName = time() . '.' . $this->foto->extension();
                $path = $this->foto->storeAs('fotoPegawai', $imageName, 'public');
                $pegawai->foto = $imageName;
            }

            $pegawai->save();

            // mengosongkan form
            $this->resetForm();
            session()->flash('success', 'Pegawai berhasil dibuat.');

            // tutup modal
            $this->modal = false;
        } catch (\Exception $e) {
            Log::error('Error creating pegawai: ' . $e->getMessage());
            session()->flash('error', 'Gagal membuat pegawai: ' . $e->getMessage());
        }
    }


    // method untuk mengubah data jabatan ketika unit kerja di pilih
    public function changeUnitKerja()
    {
        $this->jabatans = jabatan::where('unit_kerja_id', $this->unitKerja_id)->get();
        $this->selectJabatan = true;
    }



    // method untuk menampilkan modal beserta memberikan value pada form
    public function showEdit($id)
    {
        $pegawai = ModelsPegawai::find($id);
        $this->pegawai_id = $pegawai->id;
        $this->nip = $pegawai->nip;
        $this->nama = $pegawai->nama;
        $this->tempat_lahir = $pegawai->tempat_lahir;
        $this->alamat = $pegawai->alamat;
        $this->tgl_lahir = $pegawai->tgl_lahir;
        $this->jenis_kelamin = $pegawai->jenis_kelamin;
        $this->golongan_id = $pegawai->golongan_id;
        $this->eselon_id = $pegawai->eselon_id;
        $this->jabatan_id = $pegawai->jabatan_id;
        $this->tempat_tugas = $pegawai->tempat_tugas;
        $this->agama_id = $pegawai->agama_id;
        $this->unitKerja_id = $pegawai->unit_kerja_id;
        $this->no_hp = $pegawai->no_hp;
        $this->npwp = $pegawai->npwp;
        $this->foto = $pegawai->foto;
        $this->link = "update";
        $this->modal = true;
    }


    // method untuk update data
    public function update()
    {
        // dd($this->all());
        $this->validate();
        $pegawai = ModelsPegawai::find($this->pegawai_id);
        $pegawai->nip = $this->nip;
        $pegawai->nama = $this->nama;
        $pegawai->tempat_lahir = $this->tempat_lahir;
        $pegawai->alamat = $this->alamat;
        $pegawai->tgl_lahir = $this->tgl_lahir;
        $pegawai->jenis_kelamin = $this->jenis_kelamin;
        $pegawai->golongan_id = $this->golongan_id;
        $pegawai->eselon_id = $this->eselon_id;
        $pegawai->jabatan_id = $this->jabatan_id;
        $pegawai->tempat_tugas = $this->tempat_tugas;
        $pegawai->agama_id = $this->agama_id;
        $pegawai->unit_kerja_id = $this->unitKerja_id;
        $pegawai->no_hp = $this->no_hp;
        $pegawai->npwp = $this->npwp;

        // jika ada file foto, simpan di folder public/storage/fotoPegawaim dan jika sebelumnya terdapat foto, hapus foto sebelumnnya
        if ($pegawai->foto && file_exists(public_path('storage/fotoPegawai/' . $pegawai->foto))) {
            unlink(public_path('storage/fotoPegawai/' . $pegawai->foto));
        }
        if ($this->foto) {
            $imageName = time() . '.' . $this->foto->extension();
            $path = $this->foto->storeAs('fotoPegawai', $imageName, 'public');
            $pegawai->foto = $imageName;
        }

        $pegawai->save();

        // mengosongkan form
        $this->resetForm();

        // tutup modal
        $this->modal = false;
        session()->flash('success', 'Pegawai berhasil diubah.');
    }

    // method untuk menghapus data
    public function delete($id)
    {
        $pegawai = ModelsPegawai::find($id);
        // jika ada file foto, hapus file di folder public/storage/fotoPegawaim
        if ($pegawai->foto && file_exists(public_path('storage/fotoPegawai/' . $pegawai->foto))){
            unlink(public_path('storage/fotoPegawai/' . $pegawai->foto));
        }
        $pegawai->delete();
        session()->flash('success', 'Pegawai berhasil dihapus.');
    }


    // method untuk mencetak data karyawan
    public function print()
    {
        $pegawais = ModelsPegawai::with(['golongan', 'eselon', 'jabatan', 'agama', 'unitKerja'])->get();
        return view('print.print-pegawai', compact('pegawais'));
    }

    // method untuk export data karyawan ke excel
    public function exportExcel()
    {
        return Excel::download(new pegawaisExport(), 'pegawai.xlsx');
    }

    // method untuk menampilkan view
    public function render()
    {

        // dd($data['pegawais']);
        return view(
            'livewire.pegawai.pegawai',
            [
                // data pegawai di tempatkan di sini supaya ter render ulang jika terjadi perubahan
                'pegawais' => ModelsPegawai::with('golongan', 'eselon', 'jabatan', 'agama', 'unitKerja')->get(),
            ]
        );
    }
}
