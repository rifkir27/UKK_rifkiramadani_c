<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student;
use App\Models\Rayon;
use App\Models\Rombel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $rayons = Rayon::all();
        $rombels = Rombel::all();
        return view('admin.users.create', compact('rayons', 'rombels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,petugas,siswa',
            'phone' => 'nullable|string',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'phone' => $request->phone,
            'status' => 'active',
        ]);

        if ($request->role === 'siswa') {
            Student::create([
                'user_id' => $user->id,
                'nis' => $request->nis,
                'rayon_id' => $request->rayon_id,
                'rombel_id' => $request->rombel_id,
                'address' => $request->address,
                'barcode' => 'SISWA-' . str_pad($user->id, 5, '0', STR_PAD_LEFT),
            ]);
        }

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil ditambahkan');
    }

    public function edit(User $user)
    {
        $rayons = Rayon::all();
        $rombels = Rombel::all();
        return view('admin.users.edit', compact('user', 'rayons', 'rombels'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,petugas,siswa',
            'phone' => 'nullable|string',
        ]);

        $data = $request->only('name', 'email', 'role', 'phone');
        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }
        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil diupdate');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil dihapus');
    }
}
