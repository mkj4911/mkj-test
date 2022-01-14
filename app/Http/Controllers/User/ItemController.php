<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Calendar1\CalendarView1;
use App\Models\Member;
use App\Models\Shop;
use App\Models\Holiday;
use App\Models\Stock;
use App\Models\PrimaryCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;
use App\Jobs\SendThanksMail;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:users');

        $this->middleware(function ($request, $next) {

            $id = $request->route()->parameter('item');
            if (!is_null($id)) {
                $itemId = Product::availableItems()->where('product_id', $id)->exists();
                if (!$itemId) {
                    abort(404);
                }
            }
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $shop = Shop::first();

        //非同期メール送信
        // SendThanksMail::dispatch();


        if ($shop->is_selling === 1) {
            $categories = primaryCategory::with('secondary')
                ->get();

            $products = Product::availableItems()
                ->selectCategory($request->category ?? '0')
                ->searchKeyword($request->keyword)
                ->sortOrder($request->sort)
                ->paginate($request->pagination ?? '20');

            return view('user.index', compact('products', 'categories'));
        } else {
            return view('user.dashboard');
        }
    }

    public function shop()
    {
        $shop = Shop::first();

        $calendar = new CalendarView1(now());

        return view(
            'user.shop',
            [
                "calendar" => $calendar,
                // "setting" => $setting,
                // "holiday" => $holiday,
                "FLAG_OPEN" => Holiday::OPEN,
                "FLAG_CLOSE" => Holiday::CLOSE
            ],
            compact('shop')
        );
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        $quantity = Stock::where('product_id', $product->id)
            ->sum('quantity');
        if ($quantity > 9) {
            $quantity = 9;
        }

        // $calendar = new CalendarView1(now());
        // //$holiday = Holiday::where('shop_id', $product->shop_id)->first();
        // $setting = Holiday::where('shop_id', $product->shop_id)->select('shop_id')->first();
        // //dd($setting);

        return view(
            'user.show',
            [
                // "calendar" => $calendar,
                // "setting" => $setting,
                // //"holiday" => $holiday,
                // "FLAG_OPEN" => Holiday::OPEN,
                // "FLAG_CLOSE" => Holiday::CLOSE
            ],
            compact('product', 'quantity')
        );
    }
}
