<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Time;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $day = Carbon::now();
        $times = Time::select('id', 'member_id', 'punchIn', 'punchOut', 'workTime')->get();

        return view('admin.times.index', compact('times', 'day'));
    }
}
