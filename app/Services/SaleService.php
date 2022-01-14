<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\User;
use App\Models\Cart;
use App\Models\Sale;
use DateTime;

class SaleService
{
    public static function getItemsSale($sales)
    {
        $productsSale = [];


        foreach ($sales as $sale) {
            $member = Product::where('id', $sale->product_id)
                ->select('member_id')->get()->toArray();

            $product = Product::where('id', $sale->product_id)
                ->select('price')->get()->toArray();

            $quantity = Cart::where('product_id', $sale->product_id)
                ->select('product_id', 'user_id', 'quantity')->get()->toArray();

            $processing = array('processing' => 1);

            $created_at = array('created_at' => new DateTime());

            $result = array_merge($member[0], $product[0], $quantity[0], $processing, $created_at);

            array_push($productsSale, $result);
        }
        //dd($products);
        DB::table('sales')->insert($productsSale);

        return  $productsSale;
    }
}
