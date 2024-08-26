<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Apbd;
use App\Models\Article;
use App\Models\GeneralInfo;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Models\VillageOfficial;
use App\Models\TypeGalery;
use App\Models\Umkm;
use App\Models\VillageGallery;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //  // Permissions
         $superadminPermission = Permission::create([
            'name' => 'Superadmin',
            'create' => true,
            'read' => true,
            'update' => true,
            'delete' => true,
        ]);

        $adminPermission = Permission::create([
            'name' => 'Admin',
            'create' => true,
            'read' => true,
            'update' => true,
            'delete' => false,
        ]);

        // // Roles
        $superadminRole = Role::create([
            'name' => 'Superadmin',
            'permission_id' => $superadminPermission->id,
        ]);

        $adminRole = Role::create([
            'name' => 'Admin',
            'permission_id' => $adminPermission->id,
        ]);

        // // Users
        User::create([
            'role_id' => $superadminRole->id,
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'nip' => '1234567890',
            'password' => Hash::make('superadmin123'),
            'isActive' => true,
        ]);
        
        User::create([
            'role_id' => $adminRole->id,
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'nip' => '0987654321',
            'password' => Hash::make('admin123'),
            'isActive' => true,
        ]);

        GeneralInfo::create([
            'slug' => Str::slug('Nama Desa'),
            'name' => 'Nama Desa',
            'address' => 'Alamat Desa',
            'fb' => 'https://facebook.com/namadesa',
            'wa' => 'https://wa.me/nomorwhatsapp',
            'ig' => 'https://instagram.com/namadesa',
            'ytb' => 'https://youtube.com/namadesachannel',
            'email' => 'emaildesa@example.com',
            'web' => 'https://www.namadesa.com',
            'tlp' => '08123456789',
            'short_desc' => 'Deskripsi tentang singkat Desa...',
            'long_desc' => 'Deskripsi tentang panjang Desa...',
            'logo' => 'default_logo.png', // Ganti dengan nama file logo default
            'general_image' => 'default_image.jpg', // Ganti dengan nama file gambar umum default
            'area' => '100',
            'total_population' => '1000',
            'total_dusun' => '10',
            'total_rt' => '10',
            'total_umkm' => '10',
            'fasilities' => 'Fasilitas di Desa...',
            'general_work' => 'Kegiatan Desa...',
            'visi' => 'Visi Desa...',
            'misi' => 'Misi Desa...',
        ]);

        //official village
        VillageOfficial::factory(7)->create();

        //type galeri
        TypeGalery::factory(3)->create();

        //galeri image
        VillageGallery::factory(10)->create();

        //article
        Article::factory(10)->create();

        //umkm
        Umkm::factory(10)->create();

        //apbd
        Apbd::factory(10)->create();
    }
}
