<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Time;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UploadImageRequest;
use App\Services\ImageService;


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

        $members = Member::with('time')
            ->where('id', Auth::id())
            ->get();

        if (Auth::check()) {
            $today = Carbon::today();
            $month = intval($today->month);
            $day = intval($today->day);
            $format = $today->format('Y年m月d日');
            //当日の勤怠を取得
            $items = Time::GetMonthAttendance($month)->GetDayAttendance($day)->where('member_id', Auth::id())->get();
            return view('member.time.index', ['itmes' => $items, 'day' => $format, 'members' => $members]);
        } else {
            return redirect('member.dashboard');
        }
    }

    public function timein()
    {
        $member = Auth::id();
        $oldtimein = Time::where('member_id', Auth::id())->latest()->first();

        $oldDay = '';

        //退勤前に出勤を2度押せない制御
        if ($oldtimein) {
            $oldTimePunchIn = new Carbon($oldtimein->punchIn);
            $oldDay = $oldTimePunchIn->startOfDay();
        }
        $today = Carbon::today();

        if (($oldDay == $today) && (empty($oldtimein->punchOut))) {
            return redirect()->back()->with([
                'message' => '出勤打刻済みです',
                'status' => 'alert'
            ]);
        }

        // 退勤後に再度出勤を押せない制御
        if ($oldtimein) {
            $oldTimePunchOut = new Carbon($oldtimein->punchOut);
            $oldDay = $oldTimePunchOut->startOfDay();
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

    public function timeOut()
    {

        $member = Auth::id();
        $timeOut = Time::where('member_id', Auth::id())->latest()->first();

        $now = new Carbon();
        $punchIn = new Carbon($timeOut->punchIn);
        $breakIn = new Carbon($timeOut->breakIn);
        $breakOut = new Carbon($timeOut->breakOut);

        $stayTime = $punchIn->diffInSeconds($now);
        $breakTime = $breakIn->diffInSeconds($breakOut);
        $workingMinute = $stayTime - $breakTime;

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

    public function update(UploadImageRequest $request)
    {
        $imageFile = $request->image;
        if (!is_null($imageFile) && $imageFile->isValid()) {
            $fileNameToStore = ImageService::upload($imageFile, 'members');
        }

        $member = Member::where('id', Auth::id())->first();
        if (!is_null($imageFile) && $imageFile->isValid()) {
            $member->filename = $fileNameToStore;
        }

        $member->save();



        return redirect()
            ->back()
            ->with([
                'message' => '画像を更新しました。',
                'status' => 'info'
            ]);
    }
}
