<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = Article::all();
            return view('pages.admin.article.index', compact('data'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {
        try {
            $article = new Article();
            $article->village_id = $request->village_id;
            $article->user_id = $request->user_id;
            $article->title = $request->title;
            $article->slug = $request->slug;
            $article->content = $request->content;
            $article->publish_date = now();
            $article->status = $request->status;

            if ($request->hasFile('thumbnail')) {
                $image = $request->file('thumbnail');
                $image->storeAs('article', $image->hashName(),'public');
                $article->thumbnail = $image->hashName();
            }

            $article->save();
            return back()->with('success', 'Article created successfully');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        try {
            return view('pages.admin.article.show', compact('article'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        try {
            $article->village_id = $request->village_id;
            $article->user_id = $request->user_id;
            $article->title = $request->title;
            $article->slug = $request->slug;
            $article->content = $request->content;
            $article->publish_date = now();
            $article->status = $request->status;

            if ($request->hasFile('thumbnail')) {
                if ($article->thumbnail) {
                    Storage::delete('public/article/'.$article->thumbnail);
                }

                $image = $request->file('thumbnail');
                $image->storeAs('article', $image->hashName(),'public');
                $article->thumbnail = $image->hashName();
            }

            $article->save();
            return back()->with('success', 'Article updated successfully');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        try {
            $article->delete();
            return back()->with('success', 'Article deleted successfully');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
