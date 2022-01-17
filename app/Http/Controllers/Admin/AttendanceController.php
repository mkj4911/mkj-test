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

    public function index(Request $request)
    {
        $members = Member::select('id', 'name')->get();
        $day = Carbon::now();
        //$times = Time::select('id', 'member_id', 'punchIn', 'punchOut', 'workTime')->get();

        //日付が選択されたら
        if (!empty($request['from']) && !empty($request['until'])) {
            //ハッシュタグの選択された20xx/xx/xx ~ 20xx/xx/xxのレポート情報を取得
            $times = Time::getDate($request['from'], $request['until'])
                ->selectMembers($request->member ?? '0')
                ->get();
        } elseif (!empty($request['from']) && empty($request['until'])) {
            $times = Time::getDate1($request['from'])
                ->selectMembers($request->member ?? '0')
                ->get();
        } else {
            //リクエストデータがなければそのままで表示
            $times = Time::selectMembers($request->member ?? '0')->get();
        }

        $from = $request->input('from');
        $until = $request->input('until');

        return view('admin.times.index', compact('members', 'times', 'day', 'from', 'until'));
    }
}
