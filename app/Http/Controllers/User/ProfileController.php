<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use InterventionImage;
use App\Http\Requests\UploadImageRequest;
use App\Services\ImageService400;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:users');
    }

    public function index()
    {
        $profile = Profile::where('user_id', Auth::id())->first();

        return view('user.profiles.index', compact('profile'));
    }

    public function update(Request $request)
    {
        // $request->validate([
        //     'processing' => 'required',
        // ]);

        $old_image = $request->old_image;

        $imageFile = $request->image;
        if (!is_null($imageFile) && $imageFile->isValid()) {
            $fileNameToStore = ImageService400::upload($imageFile, 'profiles');
        }

        $profile = Profile::where('user_id', Auth::id())->first();
        $profile->zipcode = $request->zipcode;
        $profile->address1 = $request->address1;
        $profile->address2 = $request->address2;
        $profile->phone1 = $request->phone1;
        $profile->phone2 = $request->phone2;
        if (!is_null($imageFile) && $imageFile->isValid()) {
            if ($old_image) {
                unlink('storage/profiles/' . $old_image);
            }
            $profile->image = $fileNameToStore;
        }
        // dd($profile->address1);
        $profile->save();

        $user = User::where('id', Auth::id())->first();
        $user->name = $request->name;
        // dd($user);

        $user->save();


        return redirect()
            ->route('user.profiles.index')
            ->with([
                'message' => 'お客様情報を更新しました。',
                'status' => 'info'
            ]);
    }
}
