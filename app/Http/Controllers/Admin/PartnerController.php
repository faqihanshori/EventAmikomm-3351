<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    // ── READ ──────────────────────────────────────────────
    // GET /admin/partners
    public function index(Request $request)
    {
        // Soal 3: Fitur Search – filter berdasarkan nama partner
        $search = $request->input('search');

        $partners = Partner::when($search, function ($query) use ($search) {
            $query->where('name', 'LIKE', '%' . $search . '%');
        })->latest()->paginate(10);

        return view('admin.partners.index', compact('partners', 'search'));
    }

    // ── CREATE ────────────────────────────────────────────
    // GET /admin/partners/create
    public function create()
    {
        return view('admin.partners.create');
    }

    // ── STORE ─────────────────────────────────────────────
    // POST /admin/partners
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'logo_url' => 'nullable|url|max:500',
        ]);

        Partner::create($data);

        return redirect()
            ->route('admin.partners.index')
            ->with('success', 'Partner berhasil ditambahkan!');
    }

    // ── EDIT ──────────────────────────────────────────────
    // GET /admin/partners/{partner}/edit
    public function edit(Partner $partner)
    {
        return view('admin.partners.edit', compact('partner'));
    }

    // ── UPDATE ────────────────────────────────────────────
    // PUT /admin/partners/{partner}
    public function update(Request $request, Partner $partner)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'logo_url' => 'nullable|url|max:500',
        ]);

        $partner->update($data);

        return redirect()
            ->route('admin.partners.index')
            ->with('success', 'Data partner berhasil diperbarui!');
    }

    // ── DESTROY ───────────────────────────────────────────
    // DELETE /admin/partners/{partner}
    public function destroy(Partner $partner)
    {
        $partner->delete();

        return redirect()
            ->route('admin.partners.index')
            ->with('success', 'Partner berhasil dihapus.');
    }
}
