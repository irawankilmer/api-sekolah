<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
      $categories = Category::orderBy('updated_at', 'desc')->get();
      return view('category.index', compact('categories'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        Category::create([
          'name'    => $request->get('name'),
          'description'    => $request->get('description'),
          'parent_id' => $request->get('parent_id'),
        ]);

        return redirect()->route('sys.kategori')->with('success', 'Kategori berhasil ditambahkan');
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCategoryRequest $request, string $id)
    {
      $data = $request->validated()['edit'];

      $category = Category::findOrFail($id);
      $category->update([
        'name' => $data['name'],
        'parent_id' => $data['parent_id'] ?? null,
        'description' => $data['description'] ?? null,
      ]);

      return redirect()->route('sys.kategori')->with('success', 'Kategori berhasil diubah!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $category = Category::find($id);
        $category->delete();

        return redirect()->route('sys.kategori')->with('success', 'Kategori berhasil dihapus');
    }
}
