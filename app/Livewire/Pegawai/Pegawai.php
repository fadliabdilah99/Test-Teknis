<?php

namespace App\Livewire\Pegawai;

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

#[Layout('layouts.app')]
class Pegawai extends Component
{

    use WithFileUploads;
    public $jabatan, $title, $link, $jabatan_nama, $pegawai_id, $nip, $nama, $tempat_lahir, $alamat, $tgl_lahir, $jenis_kelamin, $golongan_id, $eselon_id, $jabatan_id, $tempat_tugas, $agama_id, $unit_kerja_id, $no_hp, $npwp, $foto;
    public $modal = false;


    public function showCreate()
    {
        $this->link = "store";
        $this->modal = true;
    }

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
        $this->unit_kerja_id = '';
        $this->no_hp = '';
        $this->npwp = '';
        $this->foto = null;
    }

    public function close()
    {
        $this->modal = false;
        $this->resetForm();
    }

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
        'unit_kerja_id' => 'nullable|integer',
        'no_hp' => 'nullable',
        'npwp' => 'nullable|string|max:255',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
    ];






    public function store()
    {
        $this->jabatan = jabatan::where('jabatan', $this->jabatan_nama)->first();
        try {
            // dd($this->all());
            $this->validate();

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
            $pegawai->jabatan_id = $this->jabatan->id;
            $pegawai->tempat_tugas = $this->tempat_tugas;
            $pegawai->agama_id = $this->agama_id;
            $pegawai->unit_kerja_id = $this->jabatan->unitKerja->id;
            $pegawai->no_hp = $this->no_hp;
            $pegawai->npwp = $this->npwp;

            if ($this->foto) {
                $imageName = time() . '.' . $this->foto->extension();
                $path = $this->foto->storeAs('fotoPegawai', $imageName, 'public');
                $pegawai->foto = $imageName;
            }

            $pegawai->save();

            $this->resetForm();
            session()->flash('success', 'Pegawai berhasil dibuat.');


            $this->modal = false;
        } catch (\Exception $e) {
            Log::error('Error creating pegawai: ' . $e->getMessage());
            session()->flash('error', 'Gagal membuat pegawai. Silakan coba lagi.');
        }
    }

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
        $this->unit_kerja_id = $pegawai->unit_kerja_id;
        $this->no_hp = $pegawai->no_hp;
        $this->npwp = $pegawai->npwp;
        $this->foto = $pegawai->foto;
        $this->link = "update";
        $this->modal = true;
    }

    public function update()
    {
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
        $pegawai->unit_kerja_id = $this->unit_kerja_id;
        $pegawai->no_hp = $this->no_hp;
        $pegawai->npwp = $this->npwp;

        if ($pegawai->foto && file_exists(public_path('storage/fotoPegawai/' . $pegawai->foto))) {
            unlink(public_path('storage/fotoPegawai/' . $pegawai->foto));
        }
        if ($this->foto) {
            $imageName = time() . '.' . $this->foto->extension();
            $path = $this->foto->storeAs('fotoPegawai', $imageName, 'public');
            $pegawai->foto = $imageName;
        }

        $pegawai->save();

        $this->resetForm();
        $this->modal = false;
        session()->flash('success', 'Pegawai berhasil diubah.');
    }

    public function delete($id)
    {
        $pegawai = ModelsPegawai::find($id);
        unlink(public_path('storage/fotoPegawai/' . $pegawai->foto));
        $pegawai->delete();
        session()->flash('success', 'Pegawai berhasil dihapus.');
    }

    public function render()
    {
        $data['golongans'] = golongan::all();
        $data['eselons'] = eselon::all();
        $data['jabatans'] = jabatan::all();
        $data['agamas'] = agama::all();
        $data['unitKerjas'] = unitKerja::all();
        $data['pegawais'] = ModelsPegawai::with('golongan', 'eselon', 'jabatan', 'agama', 'unitKerja')->get();
        // dd($data['pegawais']);
        return view('livewire.pegawai.pegawai')->with($data);
    }
}
