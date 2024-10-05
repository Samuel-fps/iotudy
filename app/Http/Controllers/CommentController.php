<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Show category admin
        $comments = DB::table('comments')
                    ->join('articles', 'comments.article_id', '=', 'articles.id')
                    ->join('users', 'comments.user_id', '=', 'users.id')
                    ->select('comments.id', 'comments.value', 'comments.description', 'articles.title', 'users.name')
                    ->where('articles.user_id', '=', Auth::user()->id)
                    ->orderBy('articles.id', 'desc')
                    ->get();
        
        return view('admin.comments.index', compact('comments'));
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
    public function store(CommentRequest $request)
    {   
        // Verify if there is a comment from this user
        $result = Comment::where('user_id', Auth::user()->id)
                            ->where('article_id', $request->article_id)->exists();

        // Get slug and article state
        $article = Article::select('status', 'slug')->find($request->article_id);

        if(!$result and $article->status == 1){
            Comment::create([
                'value' => $request->value,
                'description' => $request->description,
                'user_id' => Auth::user()->id,
                'article_id' => $request->article_id,
            ]);
            return redirect()->action([ArticleController::class, 'show'], [$article->slug]);
        }
        else{
            return redirect()->action([ArticleController::class, 'show'], [$article->slug])
                             ->with('success-error', 'Solo se perite un comentario');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

          return redirect()->action([CommentController::class, 'show'], compact('comment'))
                             ->with('success-delete', 'Comentario eliminado.');
    }
}
