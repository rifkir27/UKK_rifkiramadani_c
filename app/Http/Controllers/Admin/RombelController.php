<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rombel;
use App\Models\Rayon;
use Illuminate\Http\Request;

class RombelController extends Controller
{
    public function index()
    {
        $rombels = Rombel::with('rayon')->latest()->get();
        $rayons = Rayon::all();
        return view('admin.rombels.index', compact('rombels', 'rayons'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'rayon_id' => 'required|exists:rayons,id',
        ]);
        Rombel::create($request->all());
        return redirect()->route('admin.rombels.index')->with('success', 'Rombel berhasil ditambahkan');
    }

    public function update(Request $request, Rombel $rombel)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'rayon_id' => 'required|exists:rayons,id',
        ]);
        $rombel->update($request->all());
        return redirect()->route('admin.rombels.index')->with('success', 'Rombel berhasil diupdate');
    }

    public function destroy(Rombel $rombel)
    {
        $rombel->delete();
        return redirect()->route('admin.rombels.index')->with('success', 'Rombel berhasil dihapus');
    }
}

