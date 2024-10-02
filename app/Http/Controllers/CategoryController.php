<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Show category admin
        $category = Category::orderBy('id', 'desc')
                                ->simplePaginate(8);
        
        return view('admin.categories.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $category = $request->all();
        
        // Validate file in request
        if($request->hasFile('image')){
            $category['image'] = $request->file('image')->store('categories');
        }

        Category::create($category);

        return redirect()->action([ArticleController::class, 'index'])
                         ->with('success-create', 'Categoria creado con éxito');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        // New image
        if($request->hasFile('image')){
            // Delete image
            File::delete(public_path('storage/' . $category->image));
            // Set new image
            $category['image'] = $request->file('image')->store('categories');
        }

        // Update date
        $category->update([
            'name' => $request->title,
            'slug' => $request->slug,
            'status' => $request->status,
            'is_featured' => $request->status,
        ]);

        return redirect()->action([CategoryController::class, 'index'])
                         ->with('success-update', 'Categoría modificado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // Delete category image
        if($category->image){
            File::delete(public_path('storage/' . $category->image));
        }

        $category->delete();

        return redirect()->action([CategoryController::class, 'index'], compact('category'))
                         ->with('success-delete', 'Categoría eliminado con éxito');
    }

    // filter by category
    public function detail(Category $category){

        //dd($category);
        $this->authorize('published', $category);

        $articles = Article::where([
            ['category_id', $category->id],
            ['status', '1'],
        ])
            ->orderBy('id', 'desc')
            ->simplePaginate(5);

        $navbar = Category::where([
            ['status', '1'],
            ['is_featured', '1']
        ])->paginate(3);

        return view('subscriber.categories.detail', compact('articles', 'category', 'navbar'));
    }
}
