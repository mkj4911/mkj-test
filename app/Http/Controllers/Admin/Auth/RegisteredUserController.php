<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Throwable;
use App\Models\Shop;
use App\Models\Holiday;
use Illuminate\Support\Facades\Log;


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        try {
            DB::transaction(function () use ($request) {
                $admin = Admin::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);

                Shop::create([
                    'admin_id' => $admin->id,
                    'name' => '店名を入力してください。',
                    'information' => '',
                    'filename' => '',
                    'is_selling' => true,
                ]);

                Holiday::create([
                    'admin_id' => $admin->id,
                    'flag_mon' => 1,
                    'flag_tue' => 1,
                    'flag_wed' => 1,
                    'flag_thu' => 1,
                    'flag_fri' => 1,
                    'flag_sat' => 1,
                    'flag_sun' => 1,
                    'flag_holiday' => 1,
                ]);
            }, 2);
        } catch (Throwable $e) {
            Log::error($e);
            throw $e;
        }


        //event(new Registered($admin));

        // Auth::login($admin);

        return redirect(RouteServiceProvider::ADMIN_HOME);
    }
}
