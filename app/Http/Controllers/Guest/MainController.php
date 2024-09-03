<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\GeneralInfo;
use App\Models\Umkm;
use App\Models\VillageOfficial;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $sliders = [
            [
                'title' => 'Desa dengan sejuta keindahan',
                'link' => '/profile',
                'type' => 'image',
                'file' => 'https://picsum.photos/seed/picsum/630/1024'
            ],
            [
                'title' => 'Desa dengan sejuta keragaman',
                'link' => '/profile',
                'type' => 'image',
                'file' => 'https://picsum.photos/seed/picsum/630/1024'
            ],
        ];
        $village = GeneralInfo::first();
        $data = [
            'penduduk' => $village->total_population,
            'dusun' => $village->total_dusun,
            'rt' => $village->total_rt,
            'umkm' => Umkm::count(),
            'budayaList' => [
                [
                    'judul' => 'Tari Tradisional Ponorogo',
                    'isi' => '<p>Tari Tradisional Ponorogo adalah Reog Ponorogo yang merupakan warisan budaya yang telah dilestarikan selama berabad-abad. Tarian ini menggambarkan kehidupan masyarakat desa dan keindahan alam sekitar.</p>',
                    'data' => 'tari-cepoko.jpg'
                ]
            ],
            'logo' => ['kddesa' => 'cepoko']
        ];
        $artikelList = Article::orderBy('publish_date', 'desc')->limit(6)->get();
        $umkmList = Umkm::orderBy('created_at', 'desc')->limit(6)->get();
        $villageOfficials = VillageOfficial::orderBy('created_at', 'desc')->limit(6)->get();

        return view('pages.guest.home', compact('sliders', 'data', 'artikelList', 'umkmList', 'villageOfficials'));
    }

    public function profile()
    {
        return view('pages.guest.profil');
    }
    public function galeri()
    {
        return view('pages.guest.galeri');
    }
    public function article()
    {
        return view('pages.guest.article');
    }
}
