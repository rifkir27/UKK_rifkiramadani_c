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
        return redirect()->route('admin.petugas.index');
    }

    public function indexPetugas()
    {
        $users = User::where('role', 'petugas')->latest()->get();
        return view('admin.users.index-petugas', compact('users'));
    }

    public function indexSiswa()
    {
        $users = User::where('role', 'siswa')->with('student.rayon', 'student.rombel')->latest()->get();
        return view('admin.users.index-siswa', compact('users'));
    }

    public function createPetugas()
    {
        return view('admin.users.create-petugas');
    }

    public function storePetugas(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'phone' => 'nullable|string',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'petugas',
            'phone' => $request->phone,
            'status' => 'active',
        ]);

        return redirect()->route('admin.petugas.index')->with('success', 'Petugas berhasil ditambahkan');
    }

    public function createSiswa()
    {
        $rayons = Rayon::all();
        $rombels = Rombel::all();
        return view('admin.users.create-siswa', compact('rayons', 'rombels'));
    }

    public function storeSiswa(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'nis' => 'required|string|unique:students,nis',
            'rayon_id' => 'required|exists:rayons,id',
            'rombel_id' => 'required|exists:rombels,id',
            'phone' => 'nullable|string',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'siswa',
            'phone' => $request->phone,
            'status' => 'active',
        ]);

        Student::create([
            'user_id' => $user->id,
            'nis' => $request->nis,
            'rayon_id' => $request->rayon_id,
            'rombel_id' => $request->rombel_id,
            'address' => $request->address,
            'barcode' => 'SISWA-' . str_pad($user->id, 5, '0', STR_PAD_LEFT),
        ]);

        return redirect()->route('admin.siswa.index')->with('success', 'Siswa berhasil ditambahkan');
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

        $redirectRoute = $user->role === 'siswa' ? 'admin.siswa.index' : 'admin.petugas.index';
        return redirect()->route($redirectRoute)->with('success', 'Pengguna berhasil diupdate');
    }

    public function destroy(User $user)
    {
        $role = $user->role;
        $user->delete();

        $redirectRoute = $role === 'siswa' ? 'admin.siswa.index' : 'admin.petugas.index';
        return redirect()->route($redirectRoute)->with('success', 'Pengguna berhasil dihapus');
    }
}
