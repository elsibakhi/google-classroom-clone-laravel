<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Nnjeim\World\World;
class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        // dd(Request::create("https://localhost/api/countries")->data);
$action = World::timezones();

if ($action->success) {
    $timezones = $action->data;
}

        return view('profile.edit', [
            'user' => $request->user(),
            'timezones' => $timezones,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }


    public function extraUpdate(Request $request): RedirectResponse
    {

        $validated = $request->validate([
           "first_name"=>["required","string","max:50"],
           "last_name"=>["required","string","max:50"],
           "gender"=>["nullable","in:male,female"],
           "birthday"=>["nullable","date"],
           "locale"=>["required","in:ar,en"],
           "timezone"=>["required","timezone:all"],

        ]);

      $request->user()->profile()->update($validated);




        return Redirect::route('profile.edit')->with('status', 'profile-updated-extra');
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
