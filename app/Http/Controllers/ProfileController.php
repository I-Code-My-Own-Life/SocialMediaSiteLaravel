<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function create()
    {
        // If profile already created then redirect to profile page : 
        if(auth()->user()->profile){
            return redirect('profile/'. auth()->user()->profile->username);
        }
        return view('profile.create');
    }

    public function store(Request $request)
    {
        
        // First, let's validate the data : 
        $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:profiles'],
            'bio' => ['required', 'string'],
            'avatar' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048']
        ]);
        
        
        // Handle avatar file upload
        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $resizedAvatar = Image::make((storage_path('app/public/' . $avatarPath)));
            $resizedAvatar->fit(300,300);
            $resizedAvatar->save(storage_path('app/public/' . $avatarPath));
        }
        
        Profile::create([
            'user_id' => auth()->user()->id,
            'username' => $request->input('username'),
            'bio' => $request->input('bio'),
            'avatar' => $avatarPath
        ]);

        return redirect()->back()->with('success','Your profile has been created');
    }

    public function show(Profile $profile){
        return view('profile.show',[
            'profile' => $profile
        ]);
    }
}
