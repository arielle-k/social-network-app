<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Profile;
use Illuminate\Support\Facades\Storage;
class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */

     public function create()
    {
        return view('profile.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'biography' => 'required',
            'avatar' => 'required|image',
            'dob' => 'required|date',
            'gender' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        // Uploading the avatar image
        $file = $request->avatar;
        $avatarName = $file->getClientOriginalName();
        $file->storeAs('avatars', $avatarName);

        // Create a new profile
        $profile = new Profile();
        $profile->biographie = $validatedData['biography'];
        $profile->avatar = $avatarName;
        $profile->dob = $validatedData['dob'];
        $profile->gender = $validatedData['gender'];
        $profile->phone = $validatedData['phone'];
        $profile->address = $validatedData['address'];
        $profile->user_id = auth()->user()->id;
        $profile->save();

        return redirect()->route('posts.index', ['profile' => $profile->id])->with('status', 'Profile created successfully.');
    }


    public function edit(Profile $profile)
    {

        return view('profile.edit',compact('profile'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request ,Profile $profile)
    {
        $request->validate([
            'name' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'dob' => 'required',
            'bio'=>'required',
            'avatar'=> 'nullable|image',

        ]);
        $profile->load('user');

        if ($profile->user) {
            $profile->user->name = $request->input('name');
            $profile->user->email = $request->input('email');
            $profile->user->save();
        }

        $profile->gender = $request['gender'];
        $profile->biographie = $request['bio'];
        $profile->address = $request['address'];

        $profile->phone = $request['phone'];
        $profile->dob = $request['dob'];
        $profile->user_id= auth()->user()->id;

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $avatarName = $file->getClientOriginalName();
            $file->storeAs('avatars', $avatarName);
            $profile->avatar = $avatarName;
        }

        $profile->save();

        return Redirect::route('profile.edit',$profile)->with('status', 'profile-updated');
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


        public function show(Profile $profile)
{
    $user = $profile->user;
    $user->load('friends');
    $posts = $user->posts;

    return view('profile.show', compact('profile', 'user', 'posts'));
}



}
