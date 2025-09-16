<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([ 
            'nama' => 'Administrator', 
            'email' => 'admin@gmail.com', 
            'role' => '0',
            'status' => 1,
            'password' => bcrypt('Adm!n123'), 
        ]);  
        User::create([ 
            'nama' => 'Kepala Subdirektorat', 
            'email' => 'rubiyantara@kemenkeu.go.id', 
            'role' => '1', 
            'status' => 1,
            'password' => bcrypt('Subdit123'), 
        ]);
        User::create([
            'nama'=> 'Kepala Seksi Edukasi dan Pengendalian Gratifikasi',
            'email'=> 'fatanul.azis@kemenkeu.go.id',
            'role'=> '1',
            'status'=> '1',
            'password'=> bcrypt('Ksepg123'),
        ]);
        User::create([
            'nama'=> 'Kepala Seksi Pelayanan Pengaduan Masyarakat',
            'email'=> 'kasmui76@kemenkeu.go.id',
            'role'=> '1',
            'status'=> '1',
            'password'=> bcrypt('Ksppm123'),
        ]);
        User::create([
            'nama'=> 'Kepala Seksi Analisis Data dan Informasi',
            'email'=> 'yudhi.setia@kemenkeu.go.id',
            'role'=> '1',
            'status'=> '1',
            'password'=> bcrypt('Ksadi123'),
        ]);
        User::create([
            'nama'=> 'Pelaksana Pada Seksi EPG',
            'email'=> 'dhea.arini@kemenkeu.go.id',
            'role'=> '1',
            'status'=> '1',
            'password'=> bcrypt('Ppse123'),
        ]);
        User::create([
            'nama'=> 'Pelaksana Pada Seksi EPG',
            'email'=> 'farhan.nugraha@kemenkeu.go.id',
            'role'=> '1',
            'status'=> '1',
            'password'=> bcrypt('Ppse123'),
        ]);
        User::create([
            'nama'=> 'Pelaksana Pada Seksi EPG',
            'email'=> 'enjjel.ristieni@kemenkeu.go.id',
            'role'=> '1',
            'status'=> '1',
            'password'=> bcrypt('Ppse123'),
        ]);
        User::create([
            'nama'=> 'Pelaksana Pada Seksi EPG',
            'email'=> 'taufik.h@kemenkeu.go.id',
            'role'=> '1',
            'status'=> '1',
            'password'=> bcrypt('Ppse123'),
        ]);
        User::create([
            'nama'=> 'Pelaksana Pada Seksi PPM',
            'email'=> 'ericson.sibarani@kemenkeu.go.id',
            'role'=> '1',
            'status'=> '1',
            'password'=> bcrypt('Ppsp123'),
        ]);
        User::create([
            'nama'=> 'Pelaksana Pada Seksi PPM',
            'email'=> 'muhammad.haikal@kemenkeu.go.id',
            'role'=> '1',
            'status'=> '1',
            'password'=> bcrypt('Ppsp123'),
        ]);
        User::create([
            'nama'=> 'Pelaksana Pada Seksi PPM',
            'email'=> 'yuanita.dewi@kemenkeu.go.id',
            'role'=> '1',
            'status'=> '1',
            'password'=> bcrypt('Ppsp123'),
        ]);
        User::create([
            'nama'=> 'Pelaksana Pada Seksi PPM',
            'email'=> 'abimanyu.tri@kemenkeu.go.id',
            'role'=> '1',
            'status'=> '1',
            'password'=> bcrypt('Ppsp123'),
        ]);
        User::create([
            'nama'=> 'Pelaksana Pada Seksi ADI',
            'email'=> 'aldila.kun@kemenkeu.go.id',
            'role'=> '1',
            'status'=> '1',
            'password'=> bcrypt('Ppsa123'),
        ]);
        User::create([
            'nama'=> 'Pelaksana Pada Seksi ADI',
            'email'=> 'amin.dwinta@kemenkeu.go.id',
            'role'=> '1',
            'status'=> '1',
            'password'=> bcrypt('Ppsa123'),
        ]);
        User::create([
            'nama'=> 'Pelaksana Pada Seksi ADI',
            'email'=> 'iqbal.muhammad@kemenkeu.go.id',
            'role'=> '1',
            'status'=> '1',
            'password'=> bcrypt('Ppsa123'),
        ]);
        User::create([
            'nama'=> 'Pelaksana Pada Seksi ADI',
            'email'=> 'ilham.gamma@kemenkeu.go.id',
            'role'=> '1',
            'status'=> '1',
            'password'=> bcrypt('Ppsa123'),
        ]);
        User::create([
            'nama'=> 'Tata Usaha',
            'email'=> 'dewi.uswatun@kemenkeu.go.id',
            'role'=> '1',
            'status'=> '1',
            'password'=> bcrypt('Taus123'),
        ]);
        User::create([
            'nama'=> 'Tata Usaha',
            'email'=> 'sekar.rahayu@kemenkeu.go.id',
            'role'=> '1',
            'status'=> '1',
            'password'=> bcrypt('Taus123'),
        ]);
        User::create([
            'nama'=> 'Tata Usaha',
            'email'=> 'nabilla.usman@kemenkeu.go.id',
            'role'=> '1',
            'status'=> '1',
            'password'=> bcrypt('Taus123'),
        ]);
        User::create([
            'nama'=> 'Tata Usaha',
            'email'=> 'adhinda.chantika@kemenkeu.go.id',
            'role'=> '1',
            'status'=> '1',
            'password'=> bcrypt('Taus123'),
        ]);
    }
}