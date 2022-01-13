<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Cart;


class CartService
{
    public static function getItemsInCart($items)
    {
        $products = [];

        foreach ($items as $item) {
            $p = Product::findOrFail($item->product_id);
            $member = $p->member->select('name', 'email')->first()->toArray();
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

        return $products;
    }
}
