<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rayon;
use Illuminate\Http\Request;

class RayonController extends Controller
{
    public function index()
    {
        $rayons = Rayon::latest()->get();
        return view('admin.rayons.index', compact('rayons'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255|unique:rayons']);
        Rayon::create($request->only('name'));
        return redirect()->route('admin.rayons.index')->with('success', 'Rayon berhasil ditambahkan');
    }

    public function update(Request $request, Rayon $rayon)
    {
        $request->validate(['name' => 'required|string|max:255|unique:rayons,name,' . $rayon->id]);
        $rayon->update($request->only('name'));
        return redirect()->route('admin.rayons.index')->with('success', 'Rayon berhasil diupdate');
    }

    public function destroy(Rayon $rayon)
    {
        $rayon->delete();
        return redirect()->route('admin.rayons.index')->with('success', 'Rayon berhasil dihapus');
    }
}

