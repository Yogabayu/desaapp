<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\GeneralInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $articles = Article::with('user')->select('articles.*');

                return DataTables::of($articles)
                    ->addIndexColumn()
                    ->addColumn('author', function ($article) {
                        return $article->user->name;
                    })
                    ->editColumn('publish_date', function ($article) {
                        return $article->publish_date ? $article->publish_date->format('d M Y') : '';
                    })
                    ->editColumn('status', function ($article) {
                        $class = $article->status == 1 ? 'badge-success' : 'badge-warning';
                        return '<span class="badge ' . $class . '">' . ucfirst($article->status == 1 ? 'Ditampilkan' : 'Disembunyikan') . '</span>';
                    })
                    ->addColumn('action', function ($article) {
                        return view('pages.admin.article.components.action_buttons', compact('article'))->render();
                    })
                    ->rawColumns(['status', 'action'])
                    ->make(true);
            }

            return view('pages.admin.article.index');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('pages.admin.article.store');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required',
                'content' => 'required',
                'status' => 'required',
                'thumbnail' => 'required|mimes:jpg,jpeg,png|max:2048',
            ], [
                'required' => ':attribute harus diisi',
                'mimes' => 'File harus berupa jpg,jpeg,png',
                'max' => 'File terlalu besar'
            ]);

            DB::beginTransaction();
            $village = GeneralInfo::first();

            $article = new Article();
            $article->village_id = $village->id;
            $article->user_id = Auth::user()->id;
            $article->title = $request->title;
            $article->slug = Str::slug($request->title);
            $article->content = $request->content;
            $article->publish_date = now();
            $article->status = $request->status;

            if ($request->hasFile('thumbnail')) {
                $image = $request->file('thumbnail');
                $image->storeAs('article', $image->hashName(), 'public');
                $article->thumbnail = $image->hashName();
            }

            $article->save();

            DB::commit();
            return back()->with('success', 'Article created successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        try {
            $comments = $article->comments()->paginate(10);
            return view('pages.admin.article.show', compact('article','comments'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        try {
            return view('pages.admin.article.edit', compact('article'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        try {
            $request->validate([
                'title' => 'required',
                'content' => 'required',
                'status' => 'required',
                'thumbnail' => 'mimes:jpg,jpeg,png|max:2048',
            ], [
                'required' => ':attribute harus diisi',
                'mimes' => 'File harus berupa jpg,jpeg,png',
                'max' => 'File terlalu besar'
            ]);

            DB::beginTransaction();
            $village = GeneralInfo::first();

            $article->village_id = $village->id;
            $article->user_id = Auth::user()->id;

            $cleanArticleTitle = preg_replace('/\s+/', '', strtolower($article->title));
            $cleanRequestTitle = preg_replace('/\s+/', '', strtolower($request->title));
            if ($cleanArticleTitle != $cleanRequestTitle) {
                $article->slug = Str::slug($request->title);
            }            
            $article->title = $request->title;
            $article->content = $request->content;

            if ($article->status != $request->status && $request->status == 1) {
                $article->publish_date = now();
            }
            $article->status = $request->status;

            if ($request->hasFile('thumbnail')) {
                if ($article->thumbnail) {
                    Storage::delete('public/article/' . $article->thumbnail);
                }

                $image = $request->file('thumbnail');
                $image->storeAs('article', $image->hashName(), 'public');
                $article->thumbnail = $image->hashName();
            }

            $article->save();
            DB::commit();
            return redirect()->route('articles.index')->with('success', 'Article updated successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
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
            return response()->json(['success' => true, 'message' => 'Article deleted successfully'], 200);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => $th->getMessage()], 500);
        }
    }
}
