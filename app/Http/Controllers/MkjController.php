<?php

namespace App\Http\Controllers;

use App\Models\PrimaryCategory;
use App\Models\Product;
use App\Models\Shop;
use App\Models\Stock;
use Illuminate\Http\Request;


class MkjController extends Controller
{
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

            return view('mkj.index', compact('products', 'categories'));
        }
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        $quantity = Stock::where('product_id', $product->id)
            ->sum('quantity');
        if ($quantity > 9) {
            $quantity = 9;
        }

        return view('mkj.show', compact('product', 'quantity'));
    }
}
