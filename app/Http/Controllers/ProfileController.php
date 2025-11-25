<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of profiles.
     */
    public function index()
    {
        $profiles = Profile::latest()->paginate(10);
        return view('profiles.list', compact('profiles'));
    }

    /**
     * Show the form for creating a new profile.
     */
    public function create()
    {
        return view('profiles.create');
    }

    /**
     * Store a newly created profile in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name'      => 'required|string|max:255',
            'email'           => 'required|email|unique:profiles,email',
            'mobile'          => 'required|string|unique:profiles,mobile',
            'password'        => 'required|min:6|confirmed',
            'date_of_birth'   => 'nullable|date',
            'profile_image'   => 'nullable|image|max:2048',
            'photos.*'        => 'nullable|image|max:2048',
        ]);

        $data = $request->except(['password', 'password_confirmation', 'profile_image', 'photos']);

        // Hash password
        $data['password'] = Hash::make($request->password);

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            $data['profile_image'] = $request->file('profile_image')->store('profiles', 'public');
        }

        // Handle multiple photos
        if ($request->hasFile('photos')) {
            $photos = [];
            foreach ($request->file('photos') as $photo) {
                $photos[] = $photo->store('profiles/photos', 'public');
            }
            $data['photos'] = json_encode($photos);
        }

        Profile::create($data);

        return redirect()->route('profiles.index')->with('success', 'Profile created successfully.');
    }

    /**
     * Show the form for editing the specified profile.
     */
    public function edit(Profile $profile)
    {
        return view('profiles.edit', compact('profile'));
    }

    /**
     * Update the specified profile in storage.
     */
    public function update(Request $request, Profile $profile)
    {
        $request->validate([
            'first_name'    => 'required|string|max:255',
            'email'         => 'required|email|unique:profiles,email,' . $profile->id,
            'mobile'        => 'required|string|unique:profiles,mobile,' . $profile->id,
            'password'      => 'nullable|min:6|confirmed',
            'profile_image' => 'nullable|image|max:2048',
            'photos.*'      => 'nullable|image|max:2048',
        ]);

        $data = $request->except(['password', 'password_confirmation', 'profile_image', 'photos']);

        // Update password if provided
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // Update profile image
        if ($request->hasFile('profile_image')) {
            if ($profile->profile_image) {
                Storage::disk('public')->delete($profile->profile_image);
            }
            $data['profile_image'] = $request->file('profile_image')->store('profiles', 'public');
        }

        // Update multiple photos
        if ($request->hasFile('photos')) {
            $photos = [];
            foreach ($request->file('photos') as $photo) {
                $photos[] = $photo->store('profiles/photos', 'public');
            }
            $data['photos'] = json_encode($photos);
        }

        $profile->update($data);

        return redirect()->route('profiles.index')->with('success', 'Profile updated successfully.');
    }

    /**
     * Remove the specified profile from storage.dfsdfsdfsfdfd
     */
    public function destroy(Profile $profile)
    {
        if ($profile->profile_image) {
            Storage::disk('public')->delete($profile->profile_image);
        }

        if ($profile->photos) {
            foreach (json_decode($profile->photos, true) as $photo) {
                Storage::disk('public')->delete($photo);
            }
        }

        $profile->delete();

        return redirect()->route('profiles.index')->with('success', 'Profile deleted successfully.');
    }
}
