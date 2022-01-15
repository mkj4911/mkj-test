<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Time;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TimeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:members');

        $this->middleware(function ($request, $next) {

            $id = $request->route()->parameter('time');
            if (!is_null($id)) {
                $timesMemberId = Time::findOrFail($id)->member->id;
                $timeId = (int)$timesMemberId;
                $memberId = Auth::id();
                if ($timeId !== $memberId) {
                    abort(404);
                }
            }
            return $next($request);
        });
    }

    public function index()
    {

        $member = Member::with('time')
            ->where('id', Auth::id())
            ->get();

        if (Auth::check()) {
            $today = Carbon::today();
            $month = intval($today->month);
            $day = intval($today->day);
            $format = $today->format('Y年m月d日');
            //当日の勤怠を取得
            $items = Time::GetMonthAttendance($month)->GetDayAttendance($day)->where('member_id', Auth::id())->get();
            return view('member.time.index', ['itmes' => $items, 'day' => $format, 'member' => $member]);
        } else {
            return redirect('member.dashboard');
        }
    }

    //出勤アクション
    public function timein()
    {
        // **必要なルール**
        // ・同じ日に2回出勤が押せない(もし打刻されていたらhomeに戻る設定)
        $member = Auth::id();
        $oldtimein = Time::where('member_id', Auth::id())->latest()->first(); //一番最新のレコードを取得

        $oldDay = '';

        //退勤前に出勤を2度押せない制御
        if ($oldtimein) {
            $oldTimePunchIn = new Carbon($oldtimein->punchIn);
            $oldDay = $oldTimePunchIn->startOfDay(); //最後に登録したpunchInの時刻を00:00:00で代入
        }
        $today = Carbon::today(); //当日の日時を00:00:00で代入

        if (($oldDay == $today) && (empty($oldtimein->punchOut))) {
            return redirect()->back()->with([
                'message' => '出勤打刻済みです',
                'status' => 'alert'
            ]);
        }

        // 退勤後に再度出勤を押せない制御
        if ($oldtimein) {
            $oldTimePunchOut = new Carbon($oldtimein->punchOut);
            $oldDay = $oldTimePunchOut->startOfDay(); //最後に登録したpunchInの時刻を00:00:00で代入
        }

        if (($oldDay == $today)) {
            return redirect()->back()->with([
                'message' => '退勤打刻済みです',
                'status' => 'alert'
            ]);
        }

        $month = intval($today->month);
        $day = intval($today->day);
        $year = intval($today->year);


        $time = Time::create([
            'member_id' => Auth::id(),
            'punchIn' => Carbon::now(),
            'month' => $month,
            'day' => $day,
            'year' => $year,
        ]);

        return redirect()->back()->with([
            'message' => '出勤打刻しました',
            'status' => 'info'
        ]);
    }

    //退勤アクション
    public function timeOut()
    {
        //ログインユーザーの最新のレコードを取得
        $member = Auth::id();
        $timeOut = Time::where('member_id', Auth::id())->latest()->first();

        //string → datetime型
        $now = new Carbon();
        $punchIn = new Carbon($timeOut->punchIn);
        $breakIn = new Carbon($timeOut->breakIn);
        $breakOut = new Carbon($timeOut->breakOut);
        //実労時間(Minute)
        $stayTime = $punchIn->diffInSeconds($now);
        $breakTime = $breakIn->diffInSeconds($breakOut);
        $workingMinute = $stayTime - $breakTime;
        //15分刻み
        $workingHour = $workingMinute;

        $seconds = $workingMinute;

        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds / 60) % 60);
        $seconds = $seconds % 60;

        $hms = sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);


        //退勤処理がされていない場合のみ退勤処理を実行
        if ($timeOut) {
            if (empty($timeOut->punchOut)) {
                if ($timeOut->breakIn && !$timeOut->breakOut) {
                    return redirect()->back()->with('message', '休憩終了が打刻されていません');
                } else {
                    $timeOut->update([
                        'punchOut' => Carbon::now(),
                        'workTime' => $hms
                    ]);
                    return redirect()->back()->with([
                        'message' => 'お疲れさまでした',
                        'status' => 'info'
                    ]);
                }
            } else {
                $today = new Carbon();
                $day = $today->day;
                $oldPunchOut = new Carbon();
                $oldPunchOutDay = $oldPunchOut->day;
                if ($day == $oldPunchOutDay) {
                    return redirect()->back()->with([
                        'message' => '退勤済みです',
                        'status' => 'alert'
                    ]);
                } else {
                    return redirect()->back()->with([
                        'message' => '出勤打刻をしてください',
                        'status' => 'alert'
                    ]);
                }
            }
        } else {
            return redirect()->back()->with([
                'message' => '出勤打刻がされていません',
                'status' => 'alert'
            ]);
        }
    }

    // //休憩開始アクション
    // public function breakIn()
    // {
    //     $user = Auth::user();
    //     $oldtimein = Time::where('user_id', $user->id)->latest()->first();
    //     if ($oldtimein->punchIn && !$oldtimein->punchOut && !$oldtimein->breakIn) {
    //         $oldtimein->update([
    //             'breakIn' => Carbon::now(),
    //         ]);
    //         return redirect()->back();
    //     }
    //     return redirect()->back();
    // }

    // //休憩終了アクション
    // public function breakOut()
    // {
    //     $user = Auth::user();
    //     $oldtimein = Time::where('user_id', $user->id)->latest()->first();
    //     if ($oldtimein->breakIn && !$oldtimein->breakOut) {
    //         $oldtimein->update([
    //             'breakOut' => Carbon::now(),
    //         ]);
    //         return redirect()->back();
    //     }
    //     return redirect()->back();
    // }

    //勤怠実績
    public function performance()
    {
        $items = [];
        return view('member.time.performance', compact('items'));
    }
    public function result(Request $request)
    {
        $member = Auth::id();
        $items = Time::where('member_id', Auth::id())->where('year', $request->year)->where('month', $request->month)->get();

        return view('member.time.performance', compact('items'));
    }

    //日次勤怠
    public function daily()
    {
        $items = [];
        return view('member.time.daily', compact('items'));
    }
    public function dailyResult(Request $request)
    {
        $items = Time::where('member_id', Auth::id())->where('year', $request->year)->where('month', $request->month)->where('day', $request->day)->get();
        return view('member.time.daily', compact('items'));
    }
}
