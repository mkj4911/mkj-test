<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use App\Models\Holiday;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use InterventionImage;
use App\Http\Requests\UploadImageRequest;
use App\Services\ImageService;
use App\Calendar\CalendarView;
use App\Models\Admin;

class ShopController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');

        $this->middleware(function ($request, $next) {
            // dd($request->route()->parameter('shop'));
            // dd(Auth::id());
            $id = $request->route()->parameter('shop');
            if (!is_null($id)) {
                $shopsAdminId = Shop::findOrFail($id)->admin->id;
                $shopId = (int)$shopsAdminId;
                $adminId = Auth::id();
                if ($shopId !== $adminId) {
                    abort(404);
                }
            }
            return $next($request);
        });

        $this->middleware(function ($request, $next) {
            // dd($request->route()->parameter('shop'));
            // dd(Auth::id());
            $id = $request->route()->parameter('holiday');
            if (!is_null($id)) {
                $holidayShopId = Holiday::findOrFail($id)->admin->id;
                $holidayId = (int)$holidayAdminId;
                $adminId = Shop::find($id);
                if ($holidayId !== $adminId) {
                    abort(404);
                }
            }
            return $next($request);
        });
    }

    public function index()
    {
        //$ownerId = Auth::id();
        $shops = Shop::where('admin_id', Auth::id())->get();

        $calendar = new CalendarView(now());
        $holiday = Holiday::where('admin_id', Auth::id())->get();
        $setting = Holiday::where('admin_id', Auth::id())->first();


        return view(
            'admin.shops.index',
            compact('shops', 'calendar', 'setting')
        );
    }

    public function edit($id)
    {
        $shop = Shop::findOrFail($id);
        //dd(Shop::findOrFail($id));
        return view('admin.shops.edit', compact('shop'));
    }

    public function update(UploadImageRequest $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'information' => 'required|string|max:1000',
            'is_selling' => 'required',
        ]);

        $imageFile = $request->image;
        if (!is_null($imageFile) && $imageFile->isValid()) {
            $fileNameToStore = ImageService::upload($imageFile, 'shops');
        }

        $shop = Shop::findOrFail($id);
        $shop->name = $request->name;
        $shop->information = $request->information;
        $shop->is_selling = $request->is_selling;
        if (!is_null($imageFile) && $imageFile->isValid()) {
            $shop->filename = $fileNameToStore;
        }

        $shop->save();

        return redirect()
            ->route('admin.shops.index')
            ->with([
                'message' => '店舗情報を更新しました。',
                'status' => 'info'
            ]);
    }
}
