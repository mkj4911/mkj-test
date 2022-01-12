<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Holiday;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use InterventionImage;
use App\Http\Requests\UploadImageRequest;
use App\Services\ImageService;
use App\Calendar\CalendarView;
use App\Models\Admin;

class CalendarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');

        $this->middleware(function ($request, $next) {
            //dd($request->route()->parameter('shop'));
            // dd(Auth::id());
            $id = $request->route()->parameter('holiday');
            if (!is_null($id)) {
                $holidayAdminId = Holiday::findOrFail($id)->admin->id;
                $holidayId = (int)$holidayAdminId;
                $adminId = Auth::id();
                if ($holidayId !== $adminId) {
                    abort(404);
                }
            }
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        //$ownerId = Auth::id();
        $calendar = new CalendarView(now());
        $holiday = Holiday::where('admin_id', Auth::id())->get();
        $setting = Holiday::where('admin_id', Auth::id())->first();
        // $calendar = new CalendarView(time());

        return view(
            'admin.holiday.index',
            [
                "calendar" => $calendar,
                "setting" => $setting,
                "FLAG_OPEN" => Holiday::OPEN,
                "FLAG_CLOSE" => Holiday::CLOSE
            ],
            compact('holiday')
        );
    }

    function update(Request $request, $id)
    {
        $holiday = Holiday::findOrFail($id);
        //取得
        $setting = Holiday::first();
        //更新
        $holiday->update($request->all());
        $holiday->save();

        return redirect()
            ->route('admin.shops.index', compact('holiday'))
            ->with([
                'message' => '休日設定を保存しました。',
                'status' => 'info'
            ]);
    }
}
