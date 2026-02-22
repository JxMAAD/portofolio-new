<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Profile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();

        $profile = $user->profile ?? new Profile();

        return view('profile.edit', compact('user', 'profile'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // Update user data
        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        // Handle profile
        $profile = $user->profile ?? new Profile(['user_id' => $user->id]);

        $profile->name = $request->name;
        $profile->title = $request->title;
        $profile->bio = $request->bio;

        // Upload photo
        if ($request->hasFile('photo')) {

            if ($profile->photo && Storage::disk('public')->exists($profile->photo)) {
                Storage::disk('public')->delete($profile->photo);
            }

            $profile->photo = $request->file('photo')
                ->store('profiles/photos', 'public');
        }

        // Upload CV
        if ($request->hasFile('cv')) {

            if ($profile->cv && Storage::disk('public')->exists($profile->cv)) {
                Storage::disk('public')->delete($profile->cv);
            }

            $profile->cv = $request->file('cv')
                ->store('profiles/cv', 'public');
        }

        $profile->user_id = $user->id;
        $profile->save();

        Alert::success('Berhasil', 'Profile berhasil diperbarui ✨');

        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    // public function destroy(Request $request): RedirectResponse
    // {
    //     $request->validateWithBag('userDeletion', [
    //         'password' => ['required', 'current_password'],
    //     ]);

    //     $user = $request->user();

    //     // Hapus file profile jika ada
    //     if ($user->profile) {

    //         if ($user->profile->photo) {
    //             Storage::delete($user->profile->photo);
    //         }

    //         if ($user->profile->cv) {
    //             Storage::delete($user->profile->cv);
    //         }

    //         $user->profile->delete();
    //     }

    //     Auth::logout();

    //     $user->delete();

    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();

    //     Alert::success('Akun Dihapus', 'Akun berhasil dihapus 👋');

    //     return Redirect::to('/');
    // }
}
