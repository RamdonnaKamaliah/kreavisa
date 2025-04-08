<?php 

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\JabatanKaryawan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\PasswordChangedNotification;
use Illuminate\Support\Facades\Mail;
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
            'gudang' => 'gudang.profile.index',
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
    $user = $request->user();
    $jabatanKaryawan = JabatanKaryawan::all();
    
    // Tentukan view berdasarkan usertype
    $view = match ($user->usertype) {
        'admin' => 'admin.profile.edit',
        'gudang' => 'gudang.profile.edit',
        'karyawan' => 'karyawan.profile.edit',
        default => abort(403, 'Unauthorized'),
    };

    return view($view, [
        'user' => $user,
        'jabatanKaryawan' => $jabatanKaryawan,
    ]);
}

public function update(ProfileUpdateRequest $request): RedirectResponse
{
    $user = $request->user();
    $validatedData = $request->validated();

    try {
        // Handle file upload
        if ($request->hasFile('foto')) {
            // Delete old photo if exists
            if ($user->foto && file_exists(public_path('uploads/datakaryawan/' . $user->foto))) {
                unlink(public_path('uploads/datakaryawan/' . $user->foto));
            }
            
            // Store new photo
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/datakaryawan'), $filename);
            $validatedData['foto'] = $filename;
        }

        $passwordChanged = false;
        
        // Only update password if it's provided
        if (!empty($validatedData['password'])) {
            $user->password = bcrypt($validatedData['password']);
            $passwordChanged = true;
            unset($validatedData['password']);
        }

        // Update user data
        $user->fill($validatedData);

        // Reset email verification if email changed
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        // Kirim notifikasi jika password diubah
        if ($passwordChanged) {
            Mail::to($user->email)->send(new PasswordChangedNotification($user));
        }

        return Redirect::route('profile.index')->with('success', 'Profile berhasil diperbarui.');
    } catch (\Exception $e) {
        return Redirect::back()->with('error', 'Gagal memperbarui profile: ' . $e->getMessage());
    }
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