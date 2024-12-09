<?php

namespace Database\Seeders;

use App\Models\Organization;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Organization::create([
            'name' => 'Pemerintah Kabupaten Sekadau',
            'slug' => 'pemerintah-kabupaten-sekadau',
            'abbreviation' => 'Pemkab Sekadau',
            'description' => 'Web Pemerintah Kabupaten Sekadau',
            'address' => 'Merapi, RT. 05 / RW. 03, Sekadau Hilir, Gonis Tekam, Kec. Sekadau Hilir, Kabupaten Sekadau, Kalimantan Barat 79515',
            'latitude' => '0.006873',
            'longitude' => '110.954765',
            'email' => 'kontak@sekadaukab.go.id',
            'url' => 'https://sekadaukab.go.id',
            'phone' =>'+62 564',
            'fax' =>'+62 564',
        ]);
        Organization::create([
            'name' => 'Dinas Komunikasi dan Informatika',
            'slug' => 'dinas-komunikasi-dan-informatika',
            'abbreviation' => 'DisKomInfo',
            'description' => 'Web Dinas Komunikasi dan Informatika',
            'address' => 'Jl. Merdeka Timur KM.9, Kompleks Perkantoran Pemerintah Daerah Kab. Sekadau, Kantor Bupati Sekadau Lantai 2, Kec. Sekadau Hilir, Kab Sekadau',
            'latitude' => '0.006873',
            'longitude' => '110.954765',
            'email' => 'kominfo@sekadaukab.go.id',
            'url' => 'https://sekadaukab.go.id',
            'phone' =>'+62 564',
            'fax' =>'+62 564',
        ]);

        Organization::create([
            'name' => 'Sekretariat Daerah',
            'slug' => 'sekretariat-daerah',
            'abbreviation' => 'SetDa',
            'description' => 'Web Sekretariat Daerah',
            'address' => 'Jl. Merdeka Timur KM.9, Kompleks Perkantoran Pemerintah Daerah Kab. Sekadau, Kantor Bupati Sekadau Lantai 1, Kec. Sekadau Hilir, Kab Sekadau',
            'latitude' => '0.006873',
            'longitude' => '110.954765',
            'email' => 'sekda@sekadaukab.go.id',
            'url' => 'https://sekadaukab.go.id',
            'phone' =>'+62 564',
            'fax' =>'+62 564',
        ]);

        Organization::create([
            'name' => 'Dinas Pekerjaan Umum dan Penataan Ruang',
            'slug' => 'dinas-pekerjaan-umum-dan-penataan-ruang',
            'abbreviation' => 'DPUPR',
            'description' => 'Web Dinas Pekerjaan Umum dan Penataan Ruang',
            'address' => 'Jl. Merdeka Timur KM.9, Kompleks Perkantoran Pemerintah Daerah Kab. Sekadau, Kec. Sekadau Hilir, Kab Sekadau',
            'latitude' => '0.006873',
            'longitude' => '110.954765',
            'email' => 'pupr@sekadaukab.go.id',
            'url' => 'https://sekadaukab.go.id',
            'phone' =>'+62 564',
            'fax' =>'+62 564',
        ]);

        Organization::create([
            'name' => 'Dinas Perumahan, Kawasan Permukiman dan Pertanahan',
            'slug' => 'dinas-perumahan-kawasan-permukiman-dan-pertanahan',
            'abbreviation' => 'DPKPP',
            'description' => 'Web Dinas Perumahan, Kawasan Permukiman dan Pertanahan',
            'address' => 'Jl. Merdeka Timur KM.9, Kompleks Perkantoran Pemerintah Daerah Kab. Sekadau, Kec. Sekadau Hilir, Kab Sekadau',
            'latitude' => '0.006873',
            'longitude' => '110.954765',
            'email' => 'dpkpp@sekadaukab.go.id',
            'url' => 'https://sekadaukab.go.id',
            'phone' =>'+62 564',
            'fax' =>'+62 564',
        ]);

        Organization::create([
            'name' => 'Badan Perencanaan Pembangunan, Riset dan Inovasi Daerah',
            'slug' => 'badan-perencanaan-pembangunan-riset-dan-inovasi-daerah',
            'abbreviation' => 'BAPEDDA',
            'description' => 'Web Badan Perencanaan Pembangunan Daerah, Penelitian dan Pengembangan',
            'address' => 'Jl. Merdeka Timur KM.9, Kompleks Perkantoran Pemerintah Daerah Kab. Sekadau, Kec. Sekadau Hilir, Kab Sekadau',
            'latitude' => '0.006873',
            'longitude' => '110.954765',
            'email' => 'bapperida@sekadaukab.go.id',
            'url' => 'https://bapperida.sekadaukab.go.id',
            'phone' =>'+62 564',
            'fax' =>'+62 564',
        ]);

        Organization::create([
            'name' => 'Dinas Kependudukan dan Pencatatan Sipil',
            'slug' => 'dinas-kependudukan-dan-pencatatan-sipil',
            'abbreviation' => 'Dukcapil',
            'description' => 'Web Dinas Kependudukan dan Pencatatan Sipil',
            'address' => 'Jl. Merdeka Timur KM.9, Kompleks Perkantoran Pemerintah Daerah Kab. Sekadau, Kec. Sekadau Hilir, Kab Sekadau',
            'latitude' => '0.006873',
            'longitude' => '110.954765',
            'email' => 'dukcapil@sekadaukab.go.id',
            'url' => 'https://sekadaukab.go.id',
            'phone' =>'+62 564',
            'fax' =>'+62 564',
        ]);

        Organization::create([
            'name' => 'Badan Kepegawaian Pengembangan Sumber Daya Manusia',
            'slug' => 'badan-kepegawaian-pengembangan-sumber-daya-manusia',
            'abbreviation' => 'BKPSDM',
            'description' => 'Web Badan Kepegawaian Pengembangan Sumber Daya Manusia',
            'address' => 'Jl. Merdeka Timur KM.9, Kompleks Perkantoran Pemerintah Daerah Kab. Sekadau, Kec. Sekadau Hilir, Kab Sekadau',
            'latitude' => '0.006873',
            'longitude' => '110.954765',
            'email' => 'bkpsdm@gmail.com',
            'url' => 'https://sekadaukab.go.id',
            'phone' =>'+62 564',
            'fax' =>'+62 564',
        ]);

        Organization::create([
            'name' => 'Dinas Lingkungan Hidup',
            'slug' => 'dinas-lingkungan-hidup',
            'abbreviation' => 'DLH',
            'description' => 'Web Dinas Lingkungan Hidup',
            'address' => 'Jl. Merdeka Timur KM.9, Kompleks Perkantoran Pemerintah Daerah Kab. Sekadau, Kec. Sekadau Hilir, Kab Sekadau',
            'latitude' => '0.006873',
            'longitude' => '110.954765',
            'email' => 'lingkunganhidup@sekadaukab.go.id',
            'url' => 'https://sekadaukab.go.id',
            'phone' =>'+62 564',
            'fax' =>'+62 564',
        ]);

        Organization::create([
            'name' => 'Satuan Polisi Pamong Praja',
            'slug' => 'satuan-polisi-pamong-praja',
            'abbreviation' => 'SatpolPP',
            'description' => 'Web Satuan Polisi Pamong Praja',
            'address' => 'Jl. Merdeka Timur KM.9, Kompleks Perkantoran Pemerintah Daerah Kab. Sekadau, Kec. Sekadau Hilir, Kab Sekadau',
            'latitude' => '0.006873',
            'longitude' => '110.954765',
            'email' => 'salpolpp@sekadaukab.go.id',
            'url' => 'https://sekadaukab.go.id',
            'phone' =>'+62 564',
            'fax' =>'+62 564',
        ]);

        Organization::create([
            'name' => 'Puskesmas Simpang Empat Kayu Lapis',
            'slug' => 'puskesmas-simpang-empat-kayu-lapis',
            'abbreviation' => 'SatpolPP',
            'description' => 'Web Puskesmas Simpang Empat Kayu Lapis',
            'address' => 'Jl. Merdeka Timur KM.9, Kompleks Perkantoran Pemerintah Daerah Kab. Sekadau, Kec. Sekadau Hilir, Kab Sekadau',
            'latitude' => '0.006873',
            'longitude' => '110.954765',
            'email' => 'pkmsp4@sekadaukab.go.id',
            'url' => 'https://sekadaukab.go.id',
            'phone' =>'+62 564',
            'fax' =>'+62 564',
        ]);

        Organization::create([
            'name' => 'Badan Penanggulangan Bencana Daerah',
            'slug' => 'badan-penanggulangan-bencana-daerah',
            'abbreviation' => 'BPBD',
            'description' => 'Web Badan Penanggulangan Bencana Daerah',
            'address' => 'Jl. Merdeka Timur KM.9, Kompleks Perkantoran Pemerintah Daerah Kab. Sekadau, Kec. Sekadau Hilir, Kab Sekadau',
            'latitude' => '0.006873',
            'longitude' => '110.954765',
            'email' => 'bpbd@sekadaukab.go.id',
            'url' => 'https://sekadaukab.go.id',
            'phone' =>'+62 564',
            'fax' =>'+62 564',
        ]);

        Organization::create([
            'name' => 'Dinas Pemberdayaan Masyarakat dan Desa',
            'slug' => 'dinas-pemberdayaan-masyarakat-dan-desa',
            'abbreviation' => 'DPMD',
            'description' => 'Web Dinas Pemberdayaan Masyarakat dan Desa',
            'address' => 'Jl. Merdeka Timur KM.9, Kompleks Perkantoran Pemerintah Daerah Kab. Sekadau, Kec. Sekadau Hilir, Kab Sekadau',
            'latitude' => '0.006873',
            'longitude' => '110.954765',
            'email' => 'pemdesskd@sekadaukab.go.id',
            'url' => 'https://sekadaukab.go.id',
            'phone' =>'+62 564',
            'fax' =>'+62 564',
        ]);
        Organization::create([
            'name' => 'Dinas Kepemudaan Olahraga dan Pariwisata',
            'slug' => 'dinas-kepemudaan-olahraga-dan-pariwisata',
            'abbreviation' => 'DinasPoraWisata',
            'description' => 'Web Dinas Kepemudaan Olahraga dan Pariwisata',
            'address' => 'Jl. Merdeka Timur KM.9, Kompleks Perkantoran Pemerintah Daerah Kab. Sekadau, Kec. Sekadau Hilir, Kab Sekadau',
            'latitude' => '0.006873',
            'longitude' => '110.954765',
            'email' => 'dinasporawisata@sekadaukab.go.id',
            'url' => 'https://sekadaukab.go.id',
            'phone' =>'+62 564',
            'fax' =>'+62 564',
        ]);

        Organization::create([
            'name' => 'Dinas Penanaman Modal Dan Pelayanan Terpadu Satu Pintu',
            'slug' => 'dinas-penanaman-modal-dan-pelayanan-terpadu-satu-pintu',
            'abbreviation' => 'DPMPTSP',
            'description' => 'Web Dinas Penanaman Modal & Pelayanan Terpadu Satu Pintu',
            'address' => 'Jl. Merdeka Timur KM.9, Kompleks Perkantoran Pemerintah Daerah Kab. Sekadau, Kec. Sekadau Hilir, Kab Sekadau',
            'latitude' => '0.006873',
            'longitude' => '110.954765',
            'email' => 'dpmptsp@sekadaukab.go.id',
            'url' => 'https://sekadaukab.go.id',
            'phone' =>'+62 564',
            'fax' =>'+62 564',
        ]);

        Organization::create([
            'name' => 'Dinas Ketahanan Pangan, Pertanian dan Perikanan',
            'slug' => 'dinas-ketahanan-pangan-pertanian-dan-perikanan',
            'abbreviation' => 'DKP3',
            'description' => 'Web Dinas Ketahanan Pangan, Pertanian dan Perikanan',
            'address' => 'Jl. Merdeka Timur KM.9, Kompleks Perkantoran Pemerintah Daerah Kab. Sekadau, Kec. Sekadau Hilir, Kab Sekadau',
            'latitude' => '0.006873',
            'longitude' => '110.954765',
            'email' => 'dkp3@sekadaukab.go.id',
            'url' => 'https://sekadaukab.go.id',
            'phone' =>'+62 564',
            'fax' =>'+62 564',
        ]);

        Organization::create([
            'name' => 'Kecamatan Belitang',
            'slug' => 'kecamatan-belitang',
            'abbreviation' => 'KecBelitang',
            'description' => 'Web Kecamatan Belitang',
            'address' => 'Jl. Merdeka Timur KM.9, Kompleks Perkantoran Pemerintah Daerah Kab. Sekadau, Kec. Sekadau Hilir, Kab Sekadau',
            'latitude' => '0.006873',
            'longitude' => '110.954765',
            'email' => 'kecamatanbelitang@sekadaukab.go.id',
            'url' => 'https://sekadaukab.go.id',
            'phone' =>'+62 564',
            'fax' =>'+62 564',
        ]);

        Organization::create([
            'name' => 'Badan Kesatuan Bangsa dan Politik',
            'slug' => 'badan-kesatuan-bangsa-dan-politik',
            'abbreviation' => 'DKP3',
            'description' => 'Web Badan Kesatuan Bangsa dan Politik',
            'address' => 'Jl. Merdeka Timur KM.9, Kompleks Perkantoran Pemerintah Daerah Kab. Sekadau, Kec. Sekadau Hilir, Kab Sekadau',
            'latitude' => '0.006873',
            'longitude' => '110.954765',
            'email' => 'kesbangpol@sekadaukab.go.id',
            'url' => 'https://sekadaukab.go.id',
            'phone' =>'+62 564',
            'fax' =>'+62 564',
        ]);

        Organization::create([
            'name' => 'Kecamatan Sekadau Hilir',
            'slug' => 'kecamatan-sekadau-hilir',
            'abbreviation' => 'KecSekadauHilir',
            'description' => 'Web Kecamatan Sekadau Hilir',
            'address' => 'Jl. Merdeka Timur KM.9, Kompleks Perkantoran Pemerintah Daerah Kab. Sekadau, Kec. Sekadau Hilir, Kab Sekadau',
            'latitude' => '0.006873',
            'longitude' => '110.954765',
            'email' => 'kecamatansekadauhilir@sekadaukab.go.id',
            'url' => 'https://sekadaukab.go.id',
            'phone' =>'+62 564',
            'fax' =>'+62 564',
        ]);

        Organization::create([
            'name' => 'Dinas Kearsipan dan Perpustakaan',
            'slug' => 'dinas-kearsipan-dan-perpustakaan',
            'abbreviation' => 'DinasKearsipan',
            'description' => 'Web Dinas Kearsipan dan Perpustakaan',
            'address' => 'Jl. Merdeka Timur KM.9, Kompleks Perkantoran Pemerintah Daerah Kab. Sekadau, Kec. Sekadau Hilir, Kab Sekadau',
            'latitude' => '0.006873',
            'longitude' => '110.954765',
            'email' => 'kearsipan@sekadaukab.go.id',
            'url' => 'https://sekadaukab.go.id',
            'phone' =>'+62 564',
            'fax' =>'+62 564',
        ]);

        Organization::create([
            'name' => 'Dinas Perhubungan',
            'slug' => 'dinas-perhubungan',
            'abbreviation' => 'DisHub',
            'description' => 'Web Dinas Perhubungan',
            'address' => 'Jl. Merdeka Timur KM.9, Kompleks Perkantoran Pemerintah Daerah Kab. Sekadau, Kec. Sekadau Hilir, Kab Sekadau',
            'latitude' => '0.006873',
            'longitude' => '110.954765',
            'email' => 'dishub@sekadaukab.go.id',
            'url' => 'https://sekadaukab.go.id',
            'phone' =>'+62 564',
            'fax' =>'+62 564',
        ]);

        Organization::create([
            'name' => 'Kecamatan Sekadau Hulu',
            'slug' => 'kecamatan-sekadau-hulu',
            'abbreviation' => 'Kecsekadauhulu',
            'description' => 'Web Kecamatan Sekadau Hulu',
            'address' => 'Jl. Merdeka Timur KM.9, Kompleks Perkantoran Pemerintah Daerah Kab. Sekadau, Kec. Sekadau Hilir, Kab Sekadau',
            'latitude' => '0.006873',
            'longitude' => '110.954765',
            'email' => 'sekadauhulu@sekadaukab.go.id',
            'url' => 'https://sekadaukab.go.id',
            'phone' =>'+62 564',
            'fax' =>'+62 564',
        ]);

        Organization::create([
            'name' => 'Dinas Sosial Pemberdayaan Perempuan dan Perlindungan Anak',
            'slug' => 'dinas-sosial-pemberdayaan-perempuan-dan-perlindungan-anak',
            'abbreviation' => 'DinsosPPPA',
            'description' => 'Web Dinas Sosial Pemberdayaan Perempuan dan Perlindungan Anak',
            'address' => 'Jl. Merdeka Timur KM.9, Kompleks Perkantoran Pemerintah Daerah Kab. Sekadau, Kec. Sekadau Hilir, Kab Sekadau',
            'latitude' => '0.006873',
            'longitude' => '110.954765',
            'email' => 'dinassosial@gmail.com',
            'url' => 'https://sekadaukab.go.id',
            'phone' =>'+62 564',
            'fax' =>'+62 564',
        ]);

        Organization::create([
            'name' => 'Badan Pengelola Keuangan dan Aset Daerah',
            'slug' => 'badan-pengelola-keuangan-dan-aset-daerah',
            'abbreviation' => 'BPKAD',
            'description' => 'Web Badan Pengelola Keuangan dan Aset Daerah',
            'address' => 'Jl. Merdeka Timur KM.9, Kompleks Perkantoran Pemerintah Daerah Kab. Sekadau, Kec. Sekadau Hilir, Kab Sekadau',
            'latitude' => '0.006873',
            'longitude' => '110.954765',
            'email' => 'bpkad@sekadaukab.go.id',
            'url' => 'https://sekadaukab.go.id',
            'phone' =>'+62 564',
            'fax' =>'+62 564',
        ]);

        Organization::create([
            'name' => 'Badan Pengelola Retribusi dan Pajak Daerah',
            'slug' => 'badan-pengelola-retribusi-dan-pajak-daerah',
            'abbreviation' => 'BPRPD',
            'description' => 'Web Badan Pengelola Retribusi dan Pajak Daerah',
            'address' => 'Jl. Merdeka Timur KM.9, Kompleks Perkantoran Pemerintah Daerah Kab. Sekadau, Kec. Sekadau Hilir, Kab Sekadau',
            'latitude' => '0.006873',
            'longitude' => '110.954765',
            'email' => 'bprpd@sekadaukab.go.id',
            'url' => 'https://sekadaukab.go.id',
            'phone' =>'+62 564',
            'fax' =>'+62 564',
        ]);

        Organization::create([
            'name' => 'Dinas Pendidikan',
            'slug' => 'dinas-pendidikan',
            'abbreviation' => 'Disdik',
            'description' => 'Web Dinas Pendidikan',
            'address' => 'Jl. Merdeka Timur KM.9, Kompleks Perkantoran Pemerintah Daerah Kab. Sekadau, Kec. Sekadau Hilir, Kab Sekadau',
            'latitude' => '0.006873',
            'longitude' => '110.954765',
            'email' => 'disdik@sekadaukab.go.id',
            'url' => 'https://sekadaukab.go.id',
            'phone' =>'+62 564',
            'fax' =>'+62 564',
        ]);

        Organization::create([
            'name' => 'Kecamatan Nanga Taman',
            'slug' => 'kecamatan-nanga-taman',
            'abbreviation' => 'KecNgTaman',
            'description' => 'Web Kecamatan Nanga Taman',
            'address' => 'Jl. Merdeka Timur KM.9, Kompleks Perkantoran Pemerintah Daerah Kab. Sekadau, Kec. Sekadau Hilir, Kab Sekadau',
            'latitude' => '0.006873',
            'longitude' => '110.954765',
            'email' => 'nangataman@sekadaukab.go.id',
            'url' => 'https://sekadaukab.go.id',
            'phone' =>'+62 564',
            'fax' =>'+62 564',
        ]);

        Organization::create([
            'name' => 'Dinas Koperasi, Usaha Kecil Menengah dan Perdagangan',
            'slug' => 'dinas-koperasi-usaha-kecil-menengah-dan-perdagangan',
            'abbreviation' => 'DKUKMP',
            'description' => 'Web Dinas Koperasi, Usaha Kecil Menengah dan Perdagangan',
            'address' => 'Jl. Merdeka Timur KM.9, Kompleks Perkantoran Pemerintah Daerah Kab. Sekadau, Kec. Sekadau Hilir, Kab Sekadau',
            'latitude' => '0.006873',
            'longitude' => '110.954765',
            'email' => 'koperasi@sekadaukab.go.id',
            'url' => 'https://sekadaukab.go.id',
            'phone' =>'+62 564',
            'fax' =>'+62 564',
        ]);

        Organization::create([
            'name' => 'Sekretariat DPRD',
            'slug' => 'sekretariat-dprd',
            'abbreviation' => 'SetDPRD',
            'description' => 'Web Sekretariat DPRD',
            'address' => 'Jl. Merdeka Timur KM.9, Kompleks Perkantoran Pemerintah Daerah Kab. Sekadau, Kec. Sekadau Hilir, Kab Sekadau',
            'latitude' => '0.006873',
            'longitude' => '110.954765',
            'email' => 'setwan@sekadaukab.go.id',
            'url' => 'https://sekadaukab.go.id',
            'phone' =>'+62 564',
            'fax' =>'+62 564',
        ]);

        Organization::create([
            'name' => 'Kecamatan Belitang Hulu',
            'slug' => 'kecamatan-belitang-hulu',
            'abbreviation' => 'KecBelitangHulu',
            'description' => 'Web Kecamatan Belitang Hulu',
            'address' => 'Jl. Merdeka Timur KM.9, Kompleks Perkantoran Pemerintah Daerah Kab. Sekadau, Kec. Sekadau Hilir, Kab Sekadau',
            'latitude' => '0.006873',
            'longitude' => '110.954765',
            'email' => 'belitanghulu@sekadaukab.go.id',
            'url' => 'https://sekadaukab.go.id',
            'phone' =>'+62 564',
            'fax' =>'+62 564',
        ]);

        Organization::create([
            'name' => 'Inspektorat',
            'slug' => 'inspektorat',
            'abbreviation' => 'Inspektorat',
            'description' => 'Web Inspektorat',
            'address' => 'Jl. Merdeka Timur KM.9, Kompleks Perkantoran Pemerintah Daerah Kab. Sekadau, Kec. Sekadau Hilir, Kab Sekadau',
            'latitude' => '0.006873',
            'longitude' => '110.954765',
            'email' => 'inspektorat@sekadaukab.go.id',
            'url' => 'https://sekadaukab.go.id',
            'phone' =>'+62 564',
            'fax' =>'+62 564',
        ]);

        Organization::create([
            'name' => 'Kecamatan nanga Mahap',
            'slug' => 'kecamatan-nanga-mahap',
            'abbreviation' => 'KecnangaMahap',
            'description' => 'Web Kecamatan nanga Mahap',
            'address' => 'Jl. Merdeka Timur KM.9, Kompleks Perkantoran Pemerintah Daerah Kab. Sekadau, Kec. Sekadau Hilir, Kab Sekadau',
            'latitude' => '0.006873',
            'longitude' => '110.954765',
            'email' => 'mahap@sekadaukab.go.id',
            'url' => 'https://sekadaukab.go.id',
            'phone' =>'+62 564',
            'fax' =>'+62 564',
        ]);

        Organization::create([
            'name' => 'Kecamatan Belitang Hilir',
            'slug' => 'kecamatan-belitang-hilir',
            'abbreviation' => 'KecBelitangHilir',
            'description' => 'Web Kecamatan Belitang Hilir',
            'address' => 'Jl. Merdeka Timur KM.9, Kompleks Perkantoran Pemerintah Daerah Kab. Sekadau, Kec. Sekadau Hilir, Kab Sekadau',
            'latitude' => '0.006873',
            'longitude' => '110.954765',
            'email' => 'belitanghilir@sekadaukab.go.id',
            'url' => 'https://sekadaukab.go.id',
            'phone' =>'+62 564',
            'fax' =>'+62 564',
        ]);

        Organization::create([
            'name' => 'Dinas Kesehatan Pengendalian Penduduk dan Keluarga Berencana',
            'slug' => 'dinas-kesehatan-pengendalian-penduduk-dan-keluarga-berencana',
            'abbreviation' => 'DinkesPPKB',
            'description' => 'Web Dinas Kesehatan Pengendalian Penduduk dan Keluarga Berencana',
            'address' => 'Jl. Merdeka Timur KM.9, Kompleks Perkantoran Pemerintah Daerah Kab. Sekadau, Kec. Sekadau Hilir, Kab Sekadau',
            'latitude' => '0.006873',
            'longitude' => '110.954765',
            'email' => 'dinkes@sekadaukab.go.id',
            'url' => 'https://sekadaukab.go.id',
            'phone' =>'+62 564',
            'fax' =>'+62 564',
        ]);

        Organization::create([
            'name' => 'Puskesmas Rawak',
            'slug' => 'puskesmas-rawak',
            'abbreviation' => 'PkmRawak',
            'description' => 'Web Puskesmas Rawak',
            'address' => 'Rawak, Kec Sekadau Hulu',
            'latitude' => '0.006873',
            'longitude' => '110.954765',
            'email' => 'pkmrawak@sekadaukab.go.id',
            'url' => 'https://sekadaukab.go.id',
            'phone' =>'+62 564',
            'fax' =>'+62 564',
        ]);

        Organization::create([
            'name' => 'Puskesmas Sungai Ayak',
            'slug' => 'puskesmas-sebetung',
            'abbreviation' => 'PkmSebetung',
            'description' => 'Web Puskesmas Sebetung',
            'address' => 'Sebetung',
            'latitude' => '0.006873',
            'longitude' => '110.954765',
            'email' => 'pkmsebetung@sekadaukab.go.id',
            'url' => 'https://sekadaukab.go.id',
            'phone' =>'+62 564',
            'fax' =>'+62 564',
        ]);

        Organization::create([
            'name' => 'Puskesmas Sungai Ayak',
            'slug' => 'puskesmas-sungai-ayak',
            'abbreviation' => 'PkmSungaiAyak',
            'description' => 'Web Puskesmas Sungai Ayak',
            'address' => 'Sungai Ayak',
            'latitude' => '0.006873',
            'longitude' => '110.954765',
            'email' => 'pkmseiayak@sekadaukab.go.id',
            'url' => 'https://sekadaukab.go.id',
            'phone' =>'+62 564',
            'fax' =>'+62 564',
        ]);

        Organization::create([
            'name' => 'Puskesmas Sekadau',
            'slug' => 'puskesmas-sekadau',
            'abbreviation' => 'PkmSekadau',
            'description' => 'Web Puskesmas Sekadau',
            'address' => 'Sekadau',
            'latitude' => '0.006873',
            'longitude' => '110.954765',
            'email' => 'pkmsekadau@sekadaukab.go.id',
            'url' => 'https://sekadaukab.go.id',
            'phone' =>'+62 564',
            'fax' =>'+62 564',
        ]);

        Organization::create([
            'name' => 'Puskesmas Nanga Belitang',
            'slug' => 'puskesmas-nanga-belitang',
            'abbreviation' => 'PkmNangaBelitang',
            'description' => 'Web Puskesmas Nanga Belitang',
            'address' => 'Nanga Belitang',
            'latitude' => '0.006873',
            'longitude' => '110.954765',
            'email' => 'pkmbelitang@sekadaukab.go.id',
            'url' => 'https://sekadaukab.go.id',
            'phone' =>'+62 564',
            'fax' =>'+62 564',
        ]);

        Organization::create([
            'name' => 'Puskesmas Nanga Taman',
            'slug' => 'puskesmas-nanga-taman',
            'abbreviation' => 'PkmNangaTaman',
            'description' => 'Web Puskesmas Nanga Taman',
            'address' => 'Nanga Taman',
            'latitude' => '0.006873',
            'longitude' => '110.954765',
            'email' => 'pkmnangataman@sekadaukab.go.id',
            'url' => 'https://sekadaukab.go.id',
            'phone' =>'+62 564',
            'fax' =>'+62 564',
        ]);

        Organization::create([
            'name' => 'Puskesmas Balai Sepuak',
            'slug' => 'puskesmas-balai-sepuak',
            'abbreviation' => 'PkmbalaiSepuak',
            'description' => 'Web Puskesmas Balai Sepuak',
            'address' => 'Balai Sepuak',
            'latitude' => '0.006873',
            'longitude' => '110.954765',
            'email' => 'pkmnangasepuak@sekadaukab.go.id',
            'url' => 'https://sekadaukab.go.id',
            'phone' =>'+62 564',
            'fax' =>'+62 564',
        ]);

        Organization::create([
            'name' => 'Puskesmas Selalong',
            'slug' => 'puskesmas-selalong',
            'abbreviation' => 'PkmSelalong',
            'description' => 'Web Puskesmas Selalong',
            'address' => 'Selalong',
            'latitude' => '0.006873',
            'longitude' => '110.954765',
            'email' => 'pkmselalong@sekadaukab.go.id',
            'url' => 'https://sekadaukab.go.id',
            'phone' =>'+62 564',
            'fax' =>'+62 564',
        ]);

        Organization::create([
            'name' => 'Puskesmas tapang Perodah',
            'slug' => 'puskesmas-tapang-perodah',
            'abbreviation' => 'PkmTapangPerodah',
            'description' => 'Web Puskesmas Tapang Perodah',
            'address' => 'Tapang Perodah',
            'latitude' => '0.006873',
            'longitude' => '110.954765',
            'email' => 'pkmtapangperodah@sekadaukab.go.id',
            'url' => 'https://sekadaukab.go.id',
            'phone' =>'+62 564',
            'fax' =>'+62 564',
        ]);

        Organization::create([
            'name' => 'Puskesmas SP III Trans',
            'slug' => 'puskesmas-sp3-trans',
            'abbreviation' => 'PuskesmasSPIIITrans',
            'description' => 'Web Puskesmas SP III Trans',
            'address' => 'sp II Trans',
            'latitude' => '0.006873',
            'longitude' => '110.954765',
            'email' => 'pkmsp3trans@sekadaukab.go.id',
            'url' => 'https://sekadaukab.go.id',
            'phone' =>'+62 564',
            'fax' =>'+62 564',
        ]);

        Organization::create([
            'name' => 'Dinas Pemadam Kebakaran dan Penyelamatan',
            'slug' => 'dinas-pemadam-kebakaran-dan-penyelamatan',
            'abbreviation' => 'DPKP',
            'description' => 'Web Dinas Pemadam Kebakaran dan Penyelamatan',
            'address' => 'Jl. Merdeka Timur Km. 1 Kec. Sekadau Hilir, Kab Sekadau',
            'latitude' => '0.006873',
            'longitude' => '110.954765',
            'email' => 'dpkp@sekadaukab.go.id',
            'url' => 'https://dpkp.sekadaukab.go.id',
            'phone' =>'+62 564',
            'fax' =>'+62 564',
        ]);

        Organization::create([
            'name' => 'Dinas Perindustrian, Perdagangan, dan Tenaga Kerja',
            'slug' => 'dinas-perindustrian-perdagangan-dan-tenaga-kerja',
            'abbreviation' => 'DPPTK',
            'description' => 'Web Dinas Perindustrian, Perdagangan, dan Tenaga Kerja',
            'address' => 'Jl. Merdeka Timur Km. 1 Kec. Sekadau Hilir, Kab Sekadau',
            'latitude' => '0.006873',
            'longitude' => '110.954765',
            'email' => 'dpkp@sekadaukab.go.id',
            'url' => 'https://dpkp.sekadaukab.go.id',
            'phone' =>'+62 564',
            'fax' =>'+62 564',
        ]);

        // $faker = Faker::create();

        // for ($i = 0; $i < 20; $i++) {
        //     Organization::create([
        //         'name' => $faker->company,
        //         'slug' => $faker->unique()->slug,
        //         'abbreviation' => $faker->lexify('???'),
        //         'description' => $faker->paragraph,
        //         'address' => $faker->address,
        //         'latitude' => $faker->latitude,
        //         'longitude' => $faker->longitude,
        //         'email' => $faker->email,
        //         'phone' => $faker->phoneNumber,
        //         'fax' => $faker->phoneNumber,
        //     ]);
        // }
    }
}
