<?php /** @noinspection HtmlUnknownAnchorTarget */

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //----------------EXCEPTIONS---------------//
        DB::table('exceptions')->insert([
            'error_code' => env('ERR_EDIT_SUBMITED_DOC'),
            'error_type' => 'Dokumen Tidak Dapat Diedit',
            'error_message' => 'Dokumen sudah ditandai selesai dan disubmit ke repository. Pastikan dokumen yang ingin anda akses masih dalam proses penulisan atau belum disubmit ke repository pusat. Mungkin anda hanya ingin membaca dokumen ini ?',
            'error_callback' => '<a href="#REP1" class="btn btn-info">baca</a>'
        ]);
        DB::table('exceptions')->insert([
            'error_code' => env('ERR_WRONG_URL_DOC'),
            'error_type' => 'Dokumen Tidak Ditemukan',
            'error_message' => 'URL dokumen salah. URL tersebut tidak mengarah pada dokumen apapun di dalam repositori.Mohon periksa kembali URL dokumen yang ingin diakses.',
            'error_callback' => ''
        ]);

        //-----------------ACCOUNT-----------------//
        DB::table('users')->insert([
            'name' => 'Universitas Muhammadiyah Malang',
            'identity' => 'universitas muhammadiyah malang',
            'role' => 'super',
            'email' => 'unmuhmalang@mail.devs',
            'password' => Hash::make('unmuhmalang123')
        ]);
        DB::table('users')->insert([
            'name' => 'Informatika',
            'identity' => 'informatika',
            'role' => 'department',
            'email' => 'informatika@mail.devs',
            'password' => Hash::make('informatika123')
        ]);
        DB::table('users')->insert([
            'name' => 'Psikologi',
            'identity' => 'psikologi',
            'role' => 'department',
            'email' => 'psikologi@mail.devs',
            'password' => Hash::make('psikologi123')
        ]);
        DB::table('users')->insert([
            'name' => 'Bahasa Indonesia',
            'identity' => 'bahasa indonesia',
            'role' => 'department',
            'email' => 'bahasaindonesia@mail.devs',
            'password' => Hash::make('bahasaindonesia123')
        ]);
        DB::table('users')->insert([
            'name' => 'Jokowi Dodo',
            'identity' => '1223239090',
            'role' => 'lecturer',
            'email' => 'jokowidodo@mail.devs',
            'password' => Hash::make('jokowidodo123')
        ]);
        DB::table('users')->insert([
            'name' => 'Maruf Amiin',
            'identity' => '123123123',
            'role' => 'lecturer',
            'email' => 'marufamiin@mail.devs',
            'password' => Hash::make('marufamiin123')
        ]);
        DB::table('users')->insert([
            'name' => 'Basuki Ahok',
            'identity' => '12345555',
            'role' => 'lecturer',
            'email' => 'basukiahok@mail.devs',
            'password' => Hash::make('basukiahok123')
        ]);
        DB::table('users')->insert([
            'name' => 'Risma Tri',
            'identity' => '1209876544',
            'role' => 'lecturer',
            'email' => 'rismatri@mail.devs',
            'password' => Hash::make('rismatri123')
        ]);
        DB::table('users')->insert([
            'name' => 'Sandiaga Uno',
            'identity' => '1209876546',
            'role' => 'lecturer',
            'email' => 'sandiagauno@mail.devs',
            'password' => Hash::make('sandiagauno123')
        ]);
        DB::table('users')->insert([
            'name' => 'Puan Maharani',
            'identity' => '1209876547',
            'role' => 'lecturer',
            'email' => 'puanmaharani@mail.devs',
            'password' => Hash::make('puanmaharani123')
        ]);
        DB::table('users')->insert([
            'name' => 'Chen Lim',
            'identity' => '1209876548',
            'role' => 'lecturer',
            'email' => 'chenlim@mail.devs',
            'password' => Hash::make('chenlim123')
        ]);
        DB::table('users')->insert([
            'name' => 'Donald Trump',
            'identity' => '1209876549',
            'role' => 'lecturer',
            'email' => 'donaldtrump@mail.devs',
            'password' => Hash::make('donaldtrump123')
        ]);
        DB::table('users')->insert([
            'name' => 'Moh Hermawan',
            'identity' => '201610370311101',
            'role' => 'student',
            'email' => 'mohhermawan@mail.devs',
            'password' => Hash::make('mohhermawan123')
        ]);
        DB::table('users')->insert([
            'name' => 'Moh Irsyad',
            'identity' => '201610370311102',
            'role' => 'student',
            'email' => 'mohirsyad@mail.devs',
            'password' => Hash::make('mohirsyad123')
        ]);
        DB::table('users')->insert([
            'name' => 'Ayu Purwaningsih',
            'identity' => '201610370311103',
            'role' => 'student',
            'email' => 'ayupurwaningsih@mail.devs',
            'password' => Hash::make('ayupurwaningsih123')
        ]);
        DB::table('users')->insert([
            'name' => 'Said Imam Baihaqi',
            'identity' => '201610370311104',
            'role' => 'student',
            'email' => 'saidimambaihaqi@mail.devs',
            'password' => Hash::make('saidimambaihaqi123')
        ]);
        DB::table('users')->insert([
            'name' => 'Bima Prasetya Anugrah',
            'identity' => '201610370311105',
            'role' => 'student',
            'email' => 'bimaprasetyaanugrah@mail.devs',
            'password' => Hash::make('bimaprasetyaanugrah123')
        ]);
        DB::table('users')->insert([
            'name' => 'Alfarid Wardiman',
            'identity' => '201610370311106',
            'role' => 'student',
            'email' => 'alfaridwardiman@mail.devs',
            'password' => Hash::make('alfaridwardiman123')
        ]);
        DB::table('users')->insert([
            'name' => 'Rasyid Lutfi',
            'identity' => '201610370311107',
            'role' => 'student',
            'email' => 'rasyidlutfi@mail.devs',
            'password' => Hash::make('rasyidlutfi123')
        ]);
        DB::table('users')->insert([
            'name' => 'Kekeyi Putri',
            'identity' => '201610370311108',
            'role' => 'student',
            'email' => 'kekeyiputri@mail.devs',
            'password' => Hash::make('kekeyiputri123')
        ]);
        DB::table('users')->insert([
            'name' => 'Septian Rio',
            'identity' => '201610370311109',
            'role' => 'student',
            'email' => 'septianrio@mail.devs',
            'password' => Hash::make('septianrio123')
        ]);
        DB::table('users')->insert([
            'name' => 'Bagus Putra Widadi',
            'identity' => '201610370311110',
            'role' => 'student',
            'email' => 'bagusputrawidadi@mail.devs',
            'password' => Hash::make('bagusputrawidadi123')
        ]);
        DB::table('users')->insert([
            'name' => 'Muh Faruq',
            'identity' => '201610370311111',
            'role' => 'student',
            'email' => 'muhfaruq@mail.devs',
            'password' => Hash::make('muhfaruq123')
        ]);
        DB::table('users')->insert([
            'name' => 'Rahmatillah',
            'identity' => '201610370311112',
            'role' => 'student',
            'email' => 'rahmatillah@mail.devs',
            'password' => Hash::make('rahmatillah123')
        ]);
        DB::table('users')->insert([
            'name' => 'Asti Astuti',
            'identity' => '201610370311113',
            'role' => 'student',
            'email' => 'astiastuti@mail.devs',
            'password' => Hash::make('astiastuti123')
        ]);
        DB::table('users')->insert([
            'name' => 'Moh Iqbal',
            'identity' => '201610370311114',
            'role' => 'student',
            'email' => 'mohiqbal@mail.devs',
            'password' => Hash::make('mohiqbal123')
        ]);

        //-----------------lecturers-----------------//
        DB::table('lecturers')->insert([
            'name' => 'Jokowi Dodo',
            'identity' => '1223239090'
        ]);
        DB::table('lecturers')->insert([
            'name' => 'Maruf Amiin',
            'identity' => '123123123'
        ]);
        DB::table('lecturers')->insert([
            'name' => 'Basuki Ahok',
            'identity' => '12345555'
        ]);
        DB::table('lecturers')->insert([
            'name' => 'Risma Tri',
            'identity' => '1209876544'
        ]);
        DB::table('lecturers')->insert([
            'name' => 'Sandiaga Uno',
            'identity' => '1209876546'
        ]);
        DB::table('lecturers')->insert([
            'name' => 'Puan Maharani',
            'identity' => '1209876547'
        ]);
        DB::table('lecturers')->insert([
            'name' => 'Chen Lim',
            'identity' => '1209876548'
        ]);
        DB::table('lecturers')->insert([
            'name' => 'Donald Trump',
            'identity' => '1209876549'
        ]);

        //-----------------department-----------------//
        DB::table('departments')->insert([
            'identity' => 'informatika'
        ]);
        DB::table('departments')->insert([
            'identity' => 'psikologi'
        ]);
        DB::table('departments')->insert([
            'identity' => 'bahasa indonesia'
        ]);

        //-----------------super-----------------//
        DB::table('universities')->insert([
            'identity' => 'universitas muhammadiyah malang'
        ]);

        //-----------------skripdown-----------------//
        DB::table('skripdowns')->insert([
            'foreign_words' => 'online|offline|software|file',
            'translate_words' => 'daring|luring|perangkat lunak|berkas'
        ]);

        DB::table('students')->insert([
            'name' => 'Moh Hermawan',
            'identity' => '201610370311101',
            'identity_dep' => 'informatika',
            'identity_fac' => 'teknik',
            'identity_univ' => 'universitas muhammadiyah malang'
        ]);
        DB::table('students')->insert([
            'name' => 'Moh Irsyad',
            'identity' => '201610370311102',
            'identity_dep' => 'informatika',
            'identity_fac' => 'teknik',
            'identity_univ' => 'universitas muhammadiyah malang'
        ]);
        DB::table('students')->insert([
            'name' => 'Ayu Purwaningsih',
            'identity' => '201610370311103',
            'identity_dep' => 'informatika',
            'identity_fac' => 'teknik',
            'identity_univ' => 'universitas muhammadiyah malang'
        ]);
        DB::table('students')->insert([
            'name' => 'Said Imam Baihaqi',
            'identity' => '201610370311104',
            'identity_dep' => 'informatika',
            'identity_fac' => 'teknik',
            'identity_univ' => 'universitas muhammadiyah malang'
        ]);
        DB::table('students')->insert([
            'name' => 'Bima Prasetya Anugrah',
            'identity' => '201610370311105',
            'identity_dep' => 'informatika',
            'identity_fac' => 'teknik',
            'identity_univ' => 'universitas muhammadiyah malang'
        ]);
        DB::table('students')->insert([
            'name' => 'Alfarid Wardiman',
            'identity' => '201610370311106',
            'identity_dep' => 'bahasa indonesia',
            'identity_fac' => 'fakultas keguruan dan ilmu pendidikan',
            'identity_univ' => 'universitas muhammadiyah malang'
        ]);
        DB::table('students')->insert([
            'name' => 'Rasyid Lutfi',
            'identity' => '201610370311107',
            'identity_dep' => 'bahasa indonesia',
            'identity_fac' => 'fakultas keguruan dan ilmu pendidikan',
            'identity_univ' => 'universitas muhammadiyah malang'
        ]);
        DB::table('students')->insert([
            'name' => 'Kekeyi Putri',
            'identity' => '201610370311108',
            'identity_dep' => 'bahasa indonesia',
            'identity_fac' => 'fakultas keguruan dan ilmu pendidikan',
            'identity_univ' => 'universitas muhammadiyah malang'
        ]);
        DB::table('students')->insert([
            'name' => 'Septian Rio',
            'identity' => '201610370311109',
            'identity_dep' => 'bahasa indonesia',
            'identity_fac' => 'fakultas keguruan dan ilmu pendidikan',
            'identity_univ' => 'universitas muhammadiyah malang'
        ]);
        DB::table('students')->insert([
            'name' => 'Bagus Putra Widadi',
            'identity' => '201610370311110',
            'identity_dep' => 'psikologi',
            'identity_fac' => 'psikologi',
            'identity_univ' => 'universitas muhammadiyah malang'
        ]);
        DB::table('students')->insert([
            'name' => 'Muh Faruq',
            'identity' => '201610370311111',
            'identity_dep' => 'psikologi',
            'identity_fac' => 'psikologi',
            'identity_univ' => 'universitas muhammadiyah malang'
        ]);
        DB::table('students')->insert([
            'name' => 'Rahmatillah',
            'identity' => '201610370311112',
            'identity_dep' => 'psikologi',
            'identity_fac' => 'psikologi',
            'identity_univ' => 'universitas muhammadiyah malang'
        ]);
        DB::table('students')->insert([
            'name' => 'Asti Astuti',
            'identity' => '201610370311113',
            'identity_dep' => 'psikologi',
            'identity_fac' => 'psikologi',
            'identity_univ' => 'universitas muhammadiyah malang'
        ]);
        DB::table('students')->insert([
            'name' => 'Moh Iqbal',
            'identity' => '201610370311114',
            'identity_dep' => 'psikologi',
            'identity_fac' => 'psikologi',
            'identity_univ' => 'universitas muhammadiyah malang'
        ]);
    }
}
