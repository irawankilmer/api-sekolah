<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTagRequest;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
      $tags = Tag::orderBy('updated_at', 'DESC')->get();
      return view('tag.index', compact('tags'));
    }

    public function store(StoreTagRequest $request): RedirectResponse
    {
        Tag::create([
          'name'  => $request->get('name'),
          'description'  => $request->get('description'),
        ]);

        return redirect()->route('sys.tag')->with('success', 'Tag berhasil ditambahkan!!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreTagRequest $request, string $id)
    {
      $data = $request->validated()['edit'];

      $tag = Tag::findOrFail($id);
      $tag->update([
        'name' => $data['name'],
        'description' => $data['description'] ?? null,
      ]);

      return redirect()->route('sys.tag')->with('success', 'Tag berhasil diubah!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $tag = Tag::find($id);
        $tag->delete();

        return redirect()->route('sys.tag')->with('success', 'Tag berhasil di hapus!');
    }
}
