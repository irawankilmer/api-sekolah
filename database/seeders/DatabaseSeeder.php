<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $role = Role::create(['name' => 'Admin']);

        $user = User::create([
            'username'  => 'admin1',
            'email'     => 'admin1@gmail.com',
            'password'  => Hash::make('admin1')
        ]);

        $user->assignRole('Admin');

        $rguru = Role::create(['name' => 'Guru']);

        $guru = User::create([
            'username'  => 'guru1',
            'email'     => 'guru1@gmail.com',
            'password'  => Hash::make('guru1')
        ]);

        $guru->assignRole('Guru');

        $rsiswa = Role::create(['name' => 'Siswa']);

        $siswa = User::create([
            'username'  => 'siswa1',
            'email'     => 'siswa1@gmail.com',
            'password'  => Hash::make('siswa1')
        ]);

        $siswa->assignRole('Siswa');
    }
}
