<?php

namespace Database\Seeders;

use App\Models\agama;
use App\Models\eselon;
use App\Models\golongan;
use App\Models\jabatan;
use App\Models\User;
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

        // jabatan
        // Jabatan::upsert([
        //     ['jabatan' => 'Kepala Sekretariat Utama'],
        //     ['jabatan' => 'Penyusun laporan keuangan'],
        //     ['jabatan' => 'Surveyor Pemetaan Pertama'],
        //     ['jabatan' => 'Analis Data Survei dan Pemetaan'],
        //     ['jabatan' => 'Perancang Per-UU-an Utama IV/e'],
        //     ['jabatan' => 'Kepala Biro Perencanaan, Kepegawaian dan'],
        //     ['jabatan' => 'Hukum'],
        //     ['jabatan' => ' Widyaiswara Utama IV/e'],
        //     ['jabatan' => 'Analis Kepegawaian Madya IV/b'],
        //     ['jabatan' => 'Kepala Sub Bidang Kerjasama dan Pelayanan Riset, DKP'],
        //     ['jabatan' => 'Analis Hukum'],
        //     ['jabatan' => 'Peneliti Pertama III/b'],
        //     ['jabatan' => 'Surveyor Pemetaan Muda'],
        //     ['jabatan' => 'Analis Jabatan'],
        //     ['jabatan' => 'Kepala Subbag Kepegawaian'],
        // ], ['jabatan'], ['jabatan']);
    }
}
