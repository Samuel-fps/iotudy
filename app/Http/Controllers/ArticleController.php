<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ArticleRequest;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $articles = Article::where('user_id', $user->id)
        ->orderBy('id', 'desc')
        ->simplePaginate(10);

        return view('admin.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Get public categories
        $categories = Category::select(['id','name'])->where(['status','1'])->get();

        return view('admin.articles.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleRequest $request)
    {
        $request->merge(
            ['user_id' => Auth::user()->id,]
        );

        $article = $request->all();
        
        // Validate file in request
        if($request->hasFile('image')){
            $article['image'] = $request->file('image')->store('articles');
        }

        Article::create($article);

        return redirect()->action([ArticleController::class, 'index'])
                         ->with('success-create', 'Articulo creado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        $this->authorize('published', $article);

        $comments = $article->comments()->simplePaginate(5);

        return view('susbcriber.articles.show', compact('article', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        // Get public categories
        $categories = Category::select(['id','name'])->where(['status','1'])->get();

        return view('admin.articles.edit', compact('categories', 'article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleRequest $request, Article $article)
    {
        // New image
        if($request->hasFile('image')){
            // Delete image
            File::delete(public_path('storage/' . $article->image));
            // Set new image
            $article['image'] = $request->file('image')->store('articles');
        }

        // Update date
        $article->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'introduction' => $request->introduction,
            'body' => $request->body,
            'user_id' => Auth::user()->id,
            'category_id' => $request->category_id,
            'status' => $request->status,
        ]);

        return redirect()->action([ArticleController::class, 'index'])
                         ->with('success-update', 'Articulo modificado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        // Delete article image
        if($article->image){
            File::delete(public_path('storage/' . $article->image));
        }

        $article->delete();

        return redirect()->action([ArticleController::class, 'index'], compact('article'))
                         ->with('success-delete', 'Articulo eliminado con éxito');
    }
}
