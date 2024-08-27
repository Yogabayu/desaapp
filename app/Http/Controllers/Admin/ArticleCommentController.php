<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArticleComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            //code...
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
    public function store(Request $request)
    {
        try {
            $articleComment = new ArticleComment();
            $articleComment->article_id = $request->article_id;
            $articleComment->name = Auth::user()->name ?? $request->name;
            $articleComment->email = Auth::user()->email ?? $request->email;
            $articleComment->comment = $request->contentComment;
            $articleComment->status = $request->status ? 1 : 0;
            $articleComment->save();
            return back()->with('success', 'Article Comment created successfully');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ArticleComment $articleComment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ArticleComment $articleComment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ArticleComment $articleComment)
    {
        try {
            $articleComment->status = $request->status;
            $articleComment->save();
            return back()->with('success', 'Article Comment updated successfully');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $articleComment = ArticleComment::find($id);
            $articleComment->delete();
            return response()->json(['success' => true, 'message' => 'Comment deleted successfully'], 200);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => $th->getMessage()]);
        }
    }

    public function toggleShowComment(Request $request)
    {
        try {
            $comment = ArticleComment::find($request->comment_id); 
            if ($comment) {
                $comment->status = !$comment->status;
                $comment->save();
                return response()->json(['status' => true]);
            } else {
                return response()->json(['status' => false, 'error' => 'Comment not found']);
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'error' => $th->getMessage()]);
        }
    }
}
