<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Member;
use App\Models\Shop;
use App\Models\Stock;
use App\Models\PrimaryCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');

        // $this->middleware(function ($request, $next) {

        //     $id = $request->route()->parameter('item');
        //     if (!is_null($id)) {
        //         $itemId = Product::availableItems()->where('product_id', $id)->exists();
        //         if (!$itemId) {
        //             abort(404);
        //         }
        //     }
        //     return $next($request);
        // });
    }

    public function index(Request $request)
    {
        //dd($request);
        $categories = primaryCategory::with('secondary')
            ->get();

        $members = Member::select('id', 'name')->get();

        $products = Product::withTrashed()
            ->managementItems()
            ->selectMember($request->member ?? '0')
            ->searchKeyword($request->keyword)
            ->sortOrder($request->sort)
            ->paginate($request->pagination ?? '20');

        return view('admin.management.index', compact('products', 'categories', 'members'));
    }

    public function show($id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        $quantity = Stock::where('product_id', $product->id)->sum('quantity');
        $stocks = Stock::where('product_id', $product->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view(
            'admin.management.show',
            compact('product', 'quantity', 'stocks')
        );
    }
}
