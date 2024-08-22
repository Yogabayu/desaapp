<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Apbd;
use App\Models\Article;
use App\Models\TypeGalery;
use App\Models\Umkm;
use App\Models\VillageGallery;
use App\Policies\ApbdPolicy;
use App\Policies\ArticlePolicy;
use App\Policies\TypeGaleryPolicy;
use App\Policies\UmkmPolicy;
use App\Policies\VillageGalleryPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        TypeGalery::class => TypeGaleryPolicy::class,
        VillageGallery::class => VillageGalleryPolicy::class,
        Article::class => ArticlePolicy::class,
        Umkm::class => UmkmPolicy::class,
        Apbd::class => ApbdPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
