<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $profile = Profile::where('user_id', Auth::id())->first();
        $profile->address1 = $request->address1;
        // dd($profile->address1);
        $profile->save();

        return redirect()
            ->route('user.profiles.index')
            ->with([
                'message' => 'お客様情報を更新しました。',
                'status' => 'info'
            ]);
    }
}
