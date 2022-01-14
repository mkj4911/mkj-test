<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Cart;
use App\Models\Member;


class CartService
{
    public static function getItemsInCart($items)
    {
        $products = [];

        foreach ($items as $item) {
            $p = Product::findOrFail($item->product_id);
            $m = Product::where('id', $item->product_id)
                ->select('member_id')->get();
            $members = Member::findOrFail($m)->first();
            $member = Member::where('id', $members->id)
                ->select('name', 'email')->get()->first()->toArray();
            $values = array_values($member);
            $keys = ['memberName', 'email'];
            $memberInfo = array_combine($keys, $values);
            $product = Product::where('id', $item->product_id)
                ->select('id', 'name', 'price')->get()->toArray();
            $quantity = Cart::where('product_id', $item->product_id)
                ->select('quantity')->get()->toArray();
            $result = array_merge($product[0], $memberInfo, $quantity[0]);
            array_push($products, $result);
        }
        //dd($products);

        return $products;
    }
}
