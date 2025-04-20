<?php

namespace Database\Seeders;

use App\Models\agama;
use App\Models\eselon;
use App\Models\golongan;
use App\Models\jabatan;
use App\Models\pegawai;
use App\Models\unitKerja;
use App\Models\User;
use Carbon\Carbon;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => 'password',
        ]);

        // seeder table agama
        agama::upsert([
            ['agama' => 'Islam'],
            ['agama' => 'Kristen'],
            ['agama' => 'Katolik'],
            ['agama' => 'Hindu'],
            ['agama' => 'Budha'],
        ], ['agama'], ['agama']);

        // eselon
        eselon::upsert([
            ['eselon' => 'I'],
            ['eselon' => 'II'],
        ], ['eselon'], ['eselon']);

        // gol
        golongan::upsert([
            ['gol' => 'IV/e'],
            ['gol' => 'IV/a'],
            ['gol' => 'III/c'],
            ['gol' => 'III/b'],
            ['gol' => 'III/a'],
            ['gol' => 'IV/c'],
            ['gol' => 'IV/d'],
        ], ['gol'], ['gol']);

        // unit kerja
        unitKerja::upsert([
            ['id' => 1, 'nama' => 'Disnaker', 'parent_id' => null],
            ['id' => 2, 'nama' => 'Sekertariat', 'parent_id' => 1],
            ['id' => 3, 'nama' => 'Bidang Pelatihan', 'parent_id' => 1],
            ['id' => 4, 'nama' => 'Bidang Kepegawaian', 'parent_id' => 3],
            ['id' => 5, 'nama' => 'Perencanaan', 'parent_id' => 3],
            ['id' => 6, 'nama' => 'Sekertariat Provinsi', 'parent_id' => 2],
            ['id' => 7, 'nama' => 'Sekertariat Kabupaten', 'parent_id' => 2],
            ['id' => 8, 'nama' => 'PUPR', 'parent_id' => null],
        ], ['id'], ['id', 'parent_id']);

        // jabatan
        jabatan::upsert([
            ['id' => 1, 'jabatan' => 'Kepala Biro Umum', 'unit_kerja_id' => 1],
            ['id' => 2, 'jabatan' => 'Sekertaris', 'unit_kerja_id' => 2],
            ['id' => 3, 'jabatan' => 'Kepala Seksi Perencanaan', 'unit_kerja_id' => 5],
            ['id' => 4, 'jabatan' => 'Kepala Seksi Kepegawaian', 'unit_kerja_id' => 4],
            ['id' => 5, 'jabatan' => 'Kepala Seksi Pelatihan', 'unit_kerja_id' => 3],
            ['id' => 6, 'jabatan' => 'Sekertaris Provinsi', 'unit_kerja_id' => 6],
            ['id' => 7, 'jabatan' => 'Sekertaris Kabupaten', 'unit_kerja_id' => 7],
            ['id' => 8, 'jabatan' => 'Kepala PUPR', 'unit_kerja_id' => 8],
        ], ['id'], ['id', 'unit_kerja_id']);

        pegawai::upsert([
            [
                'id' => 1,
                'nip' => 197812312001011001,
                'nama' => 'Andi Setiawan',
                'tempat_lahir' => 'Jakarta',
                'alamat' => 'Jl. Merdeka No. 10, Jakarta',
                'tgl_lahir' => '1978-12-31',
                'jenis_kelamin' => 'L',
                'golongan_id' => 1,
                'eselon_id' => 1,
                'jabatan_id' => 1,
                'tempat_tugas' => 'Disnaker',
                'agama_id' => 1,
                'unit_kerja_id' => 1,
                'no_hp' => 81234567890,
                'npwp' => '01.234.567.8-901.000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'nip' => 198011112002031002,
                'nama' => 'Siti Rahmawati',
                'tempat_lahir' => 'Bandung',
                'alamat' => 'Jl. Asia Afrika No. 22, Bandung',
                'tgl_lahir' => '1980-11-11',
                'jenis_kelamin' => 'P',
                'golongan_id' => 2,
                'eselon_id' => 2,
                'jabatan_id' => 2,
                'tempat_tugas' => 'Sekretariat',
                'agama_id' => 2,
                'unit_kerja_id' => 2,
                'no_hp' => 81312345678,
                'npwp' => '02.345.678.9-012.000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 3,
                'nip' => 198503052003042003,
                'nama' => 'Budi Hartono',
                'tempat_lahir' => 'Semarang',
                'alamat' => 'Jl. Pahlawan No. 7, Semarang',
                'tgl_lahir' => '1985-03-05',
                'jenis_kelamin' => 'L',
                'golongan_id' => 3,
                'eselon_id' => 1,
                'jabatan_id' => 3,
                'tempat_tugas' => 'Perencanaan',
                'agama_id' => 1,
                'unit_kerja_id' => 5,
                'no_hp' => 81498765432,
                'npwp' => '03.456.789.0-123.000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 4,
                'nip' => 198702172004052004,
                'nama' => 'Desi Anggraini',
                'tempat_lahir' => 'Yogyakarta',
                'alamat' => 'Jl. Malioboro No. 15, Yogyakarta',
                'tgl_lahir' => '1987-02-17',
                'jenis_kelamin' => 'P',
                'golongan_id' => 3,
                'eselon_id' => 2,
                'jabatan_id' => 4,
                'tempat_tugas' => 'Kepegawaian',
                'agama_id' => 2,
                'unit_kerja_id' => 4,
                'no_hp' => 81567891234,
                'npwp' => '04.567.890.1-234.000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 5,
                'nip' => 199001012005062005,
                'nama' => 'Rian Maulana',
                'tempat_lahir' => 'Surabaya',
                'alamat' => 'Jl. Basuki Rahmat No. 45, Surabaya',
                'tgl_lahir' => '1990-01-01',
                'jenis_kelamin' => 'L',
                'golongan_id' => 3,
                'eselon_id' => 1,
                'jabatan_id' => 5,
                'tempat_tugas' => 'Pelatihan',
                'agama_id' => 1,
                'unit_kerja_id' => 3,
                'no_hp' => 81678901234,
                'npwp' => '05.678.901.2-345.000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 6,
                'nip' => 198209102006072006,
                'nama' => 'Ayu Lestari',
                'tempat_lahir' => 'Makassar',
                'alamat' => 'Jl. Pettarani No. 19, Makassar',
                'tgl_lahir' => '1982-09-10',
                'jenis_kelamin' => 'P',
                'golongan_id' => 2,
                'eselon_id' => 2,
                'jabatan_id' => 6,
                'tempat_tugas' => 'Sekretariat Provinsi',
                'agama_id' => 2,
                'unit_kerja_id' => 6,
                'no_hp' => 81789012345,
                'npwp' => '06.789.012.3-456.000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 7,
                'nip' => 198406152007082007,
                'nama' => 'Dedi Supriyadi',
                'tempat_lahir' => 'Cimahi',
                'alamat' => 'Jl. Gatot Subroto No. 2, Cimahi',
                'tgl_lahir' => '1984-06-15',
                'jenis_kelamin' => 'L',
                'golongan_id' => 3,
                'eselon_id' => 2,
                'jabatan_id' => 7,
                'tempat_tugas' => 'Sekretariat Kabupaten',
                'agama_id' => 1,
                'unit_kerja_id' => 7,
                'no_hp' => 81890123456,
                'npwp' => '07.890.123.4-567.000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 8,
                'nip' => 197609262008092008,
                'nama' => 'Rina Kurniasari',
                'tempat_lahir' => 'Medan',
                'alamat' => 'Jl. Sisingamangaraja No. 88, Medan',
                'tgl_lahir' => '1976-09-26',
                'jenis_kelamin' => 'P',
                'golongan_id' => 1,
                'eselon_id' => 1,
                'jabatan_id' => 8,
                'tempat_tugas' => 'PUPR',
                'agama_id' => 2,
                'unit_kerja_id' => 8,
                'no_hp' => 81901234567,
                'npwp' => '08.901.234.5-678.000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ], ['id'], ['nip', 'nama', 'jabatan_id', 'unit_kerja_id']);
    }
}
