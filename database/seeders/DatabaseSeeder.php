<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kategori;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin
        User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'is_active' => true,
            'must_change_password' => false,
        ]);

        // Create Sample Students
        $students = [
            ['nis' => '2310001', 'name' => 'Budi Santoso', 'class' => 'XII', 'major' => 'RPL'],
            ['nis' => '2310002', 'name' => 'Siti Aminah', 'class' => 'XI', 'major' => 'TKJ'],
            ['nis' => '2310003', 'name' => 'Ahmad Rizki', 'class' => 'X', 'major' => 'MM'],
            ['nis' => '2310004', 'name' => 'Dewi Lestari', 'class' => 'XII', 'major' => 'AKL'],
            ['nis' => '2310005', 'name' => 'Fajar Nugroho', 'class' => 'XI', 'major' => 'OTKP'],
        ];

        foreach ($students as $student) {
            User::create([
                'nis' => $student['nis'],
                'name' => $student['name'],
                'class' => $student['class'],
                'major' => $student['major'],
                'password' => Hash::make('sekolah2024'),
                'role' => 'siswa',
                'is_active' => true,
                'must_change_password' => true,
            ]);
        }

        // Create Kategori
        $categories = [
            ['name' => 'Fasilitas Sekolah', 'color_code' => '#3B82F6'],
            ['name' => 'Bullying', 'color_code' => '#EF4444'],
            ['name' => 'Kurikulum', 'color_code' => '#10B981'],
            ['name' => 'Kebersihan', 'color_code' => '#F59E0B'],
            ['name' => 'Listrik', 'color_code' => '#8B5CF6'],
            ['name' => 'Keamanan', 'color_code' => '#6366F1'],
            ['name' => 'Lainnya', 'color_code' => '#6B7280'],
        ];

        foreach ($categories as $category) {
            Kategori::create($category);
        }
    }
}