<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ProfileRequest;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile)
    {   
        $this->authorize('view', $profile);
        return view('subscriber.profiles.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfileRequest $request, Profile $profile)
    {
        $this->authorize('update', $profile);
        $user = Auth::user();
        $current_photo = $profile->photo;
        
        if ($current_photo) {
            $split_url = explode('/', $current_photo);
            $public_id = explode('.', end($split_url))[0];
        } else {
            $public_id = null; // O algún valor por defecto si no hay foto
        }

        $photo = $current_photo;

        if($request->hasFile('photo')){
            Cloudinary::destroy('profiles/' . $public_id[0]);
            // Set new photo
            $photo = Cloudinary::upload($request->file('photo')
            ->getRealPath(),[
                'folder' => 'profiles',
            ])->getSecurePath();
        } 
        else{
            $photo = $user->profile->photo;
        }

        // Set name, email and photo
        $user->name = $request->name;
        $user->email = $request->email;
        $user->profile->photo = $photo;

        $user->save();
        $user->profile->save();

        return redirect()->route('profiles.edit', $user->profile->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
