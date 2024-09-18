<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Apbd;
use App\Models\Article;
use App\Models\ArticleComment;
use App\Models\GeneralInfo;
use App\Models\Umkm;
use App\Models\UmkmReview;
use App\Models\VillageGallery;
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
                'file' => asset('frontend/assets/images/reog.png')
            ],
            [
                'title' => 'Desa dengan sejuta keragaman',
                'link' => '/profile',
                'type' => 'image',
                'file' => asset('frontend/assets/images/reog.png')
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
        $villageOfficials = VillageOfficial::orderBy('created_at', 'desc')->get();
        $galleries = VillageGallery::with('type_gallery')->orderBy('id', 'desc')->limit(8)->where('is_show', 1)->get();
        return view('pages.guest.profile', compact('village', 'villageOfficials', 'galleries'));
    }
    public function galeri()
    {
        $galleries = VillageGallery::with('type_gallery')->orderBy('id', 'desc')->where('is_show', 1)->get();
        // dd($galleries);
        return view('pages.guest.galeri', compact('galleries'));
    }

    public function umkm()
    {
        $umkmList = Umkm::with(['village', 'images'])
            ->where('is_active', true)
            ->paginate(12);
        return view('pages.guest.umkm', compact('umkmList'));
    }

    public function showUmkm($slug)
    {
        $umkm = Umkm::with(['village', 'images'])->where('slug', $slug)->firstOrFail();
        $suggestedUmkms = Umkm::with(['village', 'images'])
            ->where('village_id', $umkm->village_id)
            ->where('id', '!=', $umkm->id)
            ->inRandomOrder()
            ->take(5)
            ->get();
        $reviews = $umkm->reviews()->paginate(10);
        return view('pages.guest.detail.umkm-detail', compact('umkm', 'suggestedUmkms', 'reviews'));
    }

    public function addReview(Request $request){
        $request->validate([
            'umkm_id' => 'required',
            'name' => 'required',
            'email' => 'required',
            'comment' => 'required',
        ]);
        UmkmReview::create([
            'umkm_id' => $request->umkm_id,
            'name' => $request->name,
            'email' => $request->email,
            'review' => $request->comment
        ]);
        return back()->with('success', 'Review added successfully.');
    }


    public function article()
    {
        $articleList = Article::with(['village'])
            ->where('status', true)
            ->paginate(12);

        // dd($articleList);
        return view('pages.guest.article', compact('articleList'));
    }

    public function showArticle($slug)
    {
        $article = Article::with(['village'])->where('slug', $slug)->firstOrFail();
        $suggestedArticles = Article::with(['village'])
            ->where('village_id', $article->village_id)
            ->where('id', '!=', $article->id)
            ->inRandomOrder()
            ->take(5)
            ->get();
        $mostViewedArticles = Article::with(['village'])
            ->where('village_id', $article->village_id)
            ->inRandomOrder()
            ->take(5)
            ->get();
        $reviews = $article->comments()->where('status', true)->paginate(10);
        return view('pages.guest.detail.article-detail', compact('article', 'suggestedArticles','mostViewedArticles', 'reviews'));
    }

    public function addArticleComment(Request $request){
        $request->validate([
            'article_id' => 'required',
            'name' => 'required',
            'email' => 'required',
            'comment' => 'required',
        ]);
        ArticleComment::create([
            'article_id' => $request->article_id,
            'name' => $request->name,
            'email' => $request->email,
            'comment' => $request->comment,
            'status' => 1,
        ]);
        return back()->with('success', 'Review added successfully.');
    }
}
