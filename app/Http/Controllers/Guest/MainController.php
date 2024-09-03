<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Apbd;
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
        $apbd1 = Apbd::orderBy('created_at', 'desc')->where('type', 3)->first();
        $apbd2 = Apbd::orderBy('created_at', 'desc')->where('type', 2)->first();
        $apbd3 = Apbd::orderBy('created_at', 'desc')->where('type', 1)->first();

        // Prepare data for each APBD type
        $apbd1Data = $apbd1 ? [
            'label' => 'APBD Pelaksanaan Desa',
            'data' => [$apbd1->amount],
            'backgroundColor' => 'rgba(255, 99, 132, 0.2)',
            'borderColor' => 'rgba(255, 99, 132, 1)'
        ] : null; // Set to null if no data

        $apbd2Data = $apbd2 ? [
            'label' => 'APBD Pendapatan Desa',
            'data' => [$apbd2->amount],
            'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
            'borderColor' => 'rgba(54, 162, 235, 1)'
        ] : null;

        $apbd3Data = $apbd3 ? [
            'label' => 'APBD Belanja Desa',
            'data' => [$apbd3->amount],
            'backgroundColor' => 'rgba(255, 206, 86, 0.2)',
            'borderColor' => 'rgba(255, 206, 86, 1)'
        ] : null;

        // dd($apbd1Data, $apbd2Data, $apbd3Data);
        return view('pages.guest.home', compact('sliders', 'data', 'artikelList', 'umkmList', 'villageOfficials', 'apbd1Data', 'apbd2Data', 'apbd3Data'));
    }

    public function profile()
    {
        $village = GeneralInfo::first();
        return view('pages.guest.profil', compact('village'));
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
