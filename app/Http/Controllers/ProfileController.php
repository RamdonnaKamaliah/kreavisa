<?php 

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\JabatanKaryawan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function index(Request $request): View
    {
        $user = $request->user();

        // Periksa usertype dan sesuaikan data yang ditampilkan
        $view = match ($user->usertype) {
            'admin' => 'admin.profile-index',
            'gudang' => 'gudang.profile-index',
            'karyawan' => 'karyawan.profile-index',
            default => abort(403, 'Unauthorized'),
        };

        return view($view, compact('user'));
    }

    /**
     * Show the profile edit form.
     */
    public function edit(Request $request): View
    {
        $jabatanKaryawan = JabatanKaryawan::all();
    
        return view('profile.edit', [
            'user' => $request->user(),
            'jabatanKaryawan' => $jabatanKaryawan,
        ]);
    }
    

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $validatedData = $request->validated();

        if ($request->hasFile('foto')) {
            if ($user->foto && file_exists(storage_path('app/public/' . $user->foto))) {
                unlink(storage_path('app/public/' . $user->foto));
            }
            $path = $request->file('foto')->store('profile-photos', 'public');
            $validatedData['foto'] = $path;
        }
        

        // Update data user
        $user->fill($validatedData);

        // Reset email verification jika email berubah
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'Profile berhasil diperbarui.');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
