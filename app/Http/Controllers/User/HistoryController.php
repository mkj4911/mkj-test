<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Sale;
use App\Models\User;

class HistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:users');
    }

    public function index(Request $request)
    {
        $user = User::findOrFail(Auth::id());
        $historys = Sale::SalesHistory()
            ->where('sales.user_id', Auth::id())->get();
        // dd($historys);
        return view('user.history', compact('historys'));
    }

    public function edit($id)
    {
        $review = Sale::findOrFail($id);

        return view('user.history-edit', compact('review'));
    }
}
