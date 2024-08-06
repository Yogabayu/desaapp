<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $sliders = [
            [
                'title' => 'Welcome to Our Village',
                'link' => '/about',
                'type' => 'image',
                'file' => 'https://picsum.photos/seed/picsum/630/1024'
            ],
            [
                'title' => 'Our Community',
                'link' => '/community',
                'type' => 'image',
                'file' => 'https://picsum.photos/seed/picsum/630/1024'
            ],
        ];
        $data = [
            'penduduk' => 5000,
            'dusun' => 10,
            'rt' => 15,
            'umkm' => 50,
            'slider' => [
                ['judul' => 'Selamat Datang di Desa Cepoko']
            ],
            'budayaList' => [
                [
                    'judul' => 'Tari Tradisional Cepoko',
                    'isi' => '<p>Tari Tradisional Cepoko adalah warisan budaya yang telah dilestarikan selama berabad-abad. Tarian ini menggambarkan kehidupan masyarakat desa dan keindahan alam sekitar.</p>',
                    'data' => 'tari-cepoko.jpg'
                ]
            ],
            'logo' => ['kddesa' => 'cepoko']
        ];
        $artikelList = [
            [
                'id' => 1,
                'gambar' => 'blog-1.jpg',
                'kategori' => 'Kategori 1',
                'tgl_upload' => '2023-08-01 14:30:00',
                'judul' => 'Judul Artikel 1',
                'slug' => 'slug-artikel-1',
                'kddesa' => 'desa1'
            ],
            [
                'id' => 2,
                'gambar' => 'blog-1.jpg',
                'kategori' => 'Kategori 2',
                'tgl_upload' => '2023-08-02 14:30:00',
                'judul' => 'Judul Artikel 2',
                'slug' => 'slug-artikel-2',
                'kddesa' => 'desa2'
            ],
            [
                'id' => 3,
                'gambar' => 'blog-1.jpg',
                'kategori' => 'Kategori 2',
                'tgl_upload' => '2023-08-02 14:30:00',
                'judul' => 'Judul Artikel 2',
                'slug' => 'slug-artikel-2',
                'kddesa' => 'desa2'
            ],
            // Add more dummy articles as needed
        ];
    
        return view('pages.guest.home', compact('sliders', 'data','artikelList'));
    }

    public function profile(){
        return view('pages.guest.profil');
    }
    public function galeri(){
        return view('pages.guest.galeri');
    }
    public function article(){
        return view('pages.guest.article');
    }
}
