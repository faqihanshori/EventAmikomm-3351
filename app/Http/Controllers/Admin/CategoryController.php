<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // ── READ ──────────────────────────────────────────────
    // GET /admin/categories
    public function index(Request $request)
    {
        // Soal 3: Fitur Search – filter berdasarkan nama
        $search = $request->input('search');

        $categories = Category::when($search, function ($query) use ($search) {
            $query->where('name', 'LIKE', '%' . $search . '%');
        })->latest()->paginate(10);

        return view('admin.categories.index', compact('categories', 'search'));
    }

    // ── CREATE ────────────────────────────────────────────
    // GET /admin/categories/create
    public function create()
    {
        return view('admin.categories.create');
    }

    // ── STORE ─────────────────────────────────────────────
    // POST /admin/categories
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'slug' => 'nullable|string|max:255|unique:categories,slug',
        ]);

        // Jika slug tidak diisi, generate otomatis dari name
        if (empty($data['slug'])) {
            $data['slug'] = \Illuminate\Support\Str::slug($data['name']);
        }

        Category::create($data);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Kategori berhasil ditambahkan!');
    }

    // ── EDIT ──────────────────────────────────────────────
    // GET /admin/categories/{category}/edit
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    // ── UPDATE ────────────────────────────────────────────
    // PUT /admin/categories/{category}
    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'slug' => 'nullable|string|max:255|unique:categories,slug,' . $category->id,
        ]);

        // Jika slug tidak diisi, generate otomatis dari name
        if (empty($data['slug'])) {
            $data['slug'] = \Illuminate\Support\Str::slug($data['name']);
        }

        $category->update($data);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Kategori berhasil diperbarui!');
    }

    // ── DESTROY ───────────────────────────────────────────
    // DELETE /admin/categories/{category}
    public function destroy(Category $category)
    {
        // Cegah hapus kategori yang masih memiliki event
        if ($category->events()->count() > 0) {
            return redirect()
                ->route('admin.categories.index')
                ->with('error', 'Kategori tidak bisa dihapus karena masih memiliki event!');
        }

        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
