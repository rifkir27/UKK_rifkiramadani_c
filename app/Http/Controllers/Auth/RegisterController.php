<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student;
use App\Models\Rayon;
use App\Models\Rombel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        $rayons = Rayon::all();
        $rombels = Rombel::all();
        return view('auth.register', compact('rayons', 'rombels'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'nullable|string|max:20',
            'nis' => 'required|string|unique:students,nis',
            'rayon_id' => 'required|exists:rayons,id',
            'rombel_id' => 'required|exists:rombels,id',
            'address' => 'nullable|string',
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

        Auth::login($user);

        return redirect('/siswa/dashboard');
    }
}

