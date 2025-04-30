<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        // Buat role
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $dokterRole = Role::firstOrCreate(['name' => 'dokter']);
        $kasirRole = Role::firstOrCreate(['name' => 'kasir']);
        $pendaftaranRole = Role::firstOrCreate(['name' => 'pendaftaran']);

        // Buat user Admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@klinik.com'],
            [
                'name' => 'Admin Klinik',
                'password' => Hash::make('password'), // password: password
            ]
        );
        $admin->assignRole($adminRole);

        // Buat user Dokter
        $dokter = User::firstOrCreate(
            ['email' => 'dokter@klinik.com'],
            [
                'name' => 'Dokter Umum',
                'password' => Hash::make('password'), // password: password
            ]
        );
        $dokter->assignRole($dokterRole);

        // Buat user Petugas Pendaftaran
        $pendaftaran = User::firstOrCreate(
            ['email' => 'pendaftaran@klinik.com'],
            [
                'name' => 'Petugas Pendaftaran',
                'password' => Hash::make('password'), // password: password
            ]
        );
        $pendaftaran->assignRole($pendaftaranRole);

        // Buat user Kasir
        $kasir = User::firstOrCreate(
            ['email' => 'kasir@klinik.com'],
            [
                'name' => 'Kasir Klinik',
                'password' => Hash::make('password'), // password: password
            ]
        );
        $kasir->assignRole($kasirRole);
    }
}
