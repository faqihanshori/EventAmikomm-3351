<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
    public function index(Request $request)
    {
        $query = Partner::query();
        
        if ($request->has('search')) {
            $keyword = $request->search;
            $query->where('name', 'LIKE', '%' . $keyword . '%');
        }

        $partners = $query->latest()->paginate(10);
        return view('partners.index', compact('partners'));
    }

    public function create()
    {
        return view('partners.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $data = $request->except('logo');

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('partners/logos', 'public');
            $data['logo_url'] = '/storage/' . $path;
        }

        Partner::create($data);

        return redirect()->route('admin.partners.index')->with('success', 'Partner berhasil ditambahkan.');
    }

    public function edit(Partner $partner)
    {
        return view('partners.edit', compact('partner'));
    }

    public function update(Request $request, Partner $partner)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $data = $request->except('logo');

        if ($request->hasFile('logo')) {
            // Hapus logo lama jika ada (opsional)
            if ($partner->logo_url && str_starts_with($partner->logo_url, '/storage/')) {
                $oldPath = str_replace('/storage/', '', $partner->logo_url);
                Storage::disk('public')->delete($oldPath);
            }

            $path = $request->file('logo')->store('partners/logos', 'public');
            $data['logo_url'] = '/storage/' . $path;
        }

        $partner->update($data);

        return redirect()->route('admin.partners.index')->with('success', 'Partner berhasil diperbarui.');
    }

    public function destroy(Partner $partner)
    {
        if ($partner->logo_url && str_starts_with($partner->logo_url, '/storage/')) {
            $oldPath = str_replace('/storage/', '', $partner->logo_url);
            Storage::disk('public')->delete($oldPath);
        }
        $partner->delete();
        return redirect()->route('admin.partners.index')->with('success', 'Partner berhasil dihapus.');
    }
}