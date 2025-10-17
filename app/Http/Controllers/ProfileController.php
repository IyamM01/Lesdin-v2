<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::with(['siswa.jurusan', 'guruPendamping'])
                    ->findOrFail(Auth::id());

        // Coba view 'profile.index' dulu, kalau tidak ada jatuh ke 'profile'
        $viewName = view()->exists('profile.index') ? 'profile.index'
                  : (view()->exists('profile') ? 'profile' : null);

        if (!$viewName) {
            // Biar error-nya jelas kalau file memang tidak ada dua-duanya
            abort(500, "View 'profile' atau 'profile/index' tidak ditemukan. Pastikan file berada di resources/views/profile.blade.php atau resources/views/profile/index.blade.php");
        }

        return view($viewName, compact('user'));
    }

    // Edit terpisah tidak dipakai
    public function edit() { abort(404); }

    // Penting: TANPA parameter $id, karena route PATCH /profile tidak mengirim id
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['nullable', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'password' => ['nullable', 'confirmed', 'min:8'],
        ]);

        $user->name = $validated['name'];
        if (!empty($validated['email'])) {
            $user->email = $validated['email'];
        }
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }
        $user->save();

        return back()->with('status', 'Profil berhasil diperbarui.');
    }

    public function destroy() { abort(404); }
}
