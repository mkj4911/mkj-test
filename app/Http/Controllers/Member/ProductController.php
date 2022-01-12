<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Image;
use App\Models\Member;
use App\Models\PrimaryCategory;
use App\Models\Shop;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:members');

        $this->middleware(function ($request, $next) {

            $id = $request->route()->parameter('product');
            if (!is_null($id)) {
                $productsMemberId = Product::findOrFail($id)->member->id;
                $productId = (int)$productsMemberId;
                $memberId = Auth::id();
                if ($productId !== $memberId) {
                    abort(404);
                }
            }
            return $next($request);
        });
    }

    public function index()
    {
        //$products = Owner::findOrFail(Auth::id())->shop->product;

        $memberInfo = Member::with('product.imageOne')
            ->where('id', Auth::id())
            ->get();

        return view(
            'member.products.index',
            compact('memberInfo')
        );
    }

    public function create()
    {
        //$members = Member::where('member_id', Auth::id())->select('id', 'name')->get();
        $images = Image::where('member_id', Auth::id())->select('id', 'title', 'filename')
            ->orderBy('updated_at', 'desc')->get();
        $categories = PrimaryCategory::with('secondary')->get();

        return view('member.products.create', compact('images', 'categories'));
    }

    public function store(ProductRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $product = Product::create([
                    'name' => $request->name,
                    'information' => $request->information,
                    'price' => $request->price,
                    'sort_order' => $request->sort_order,
                    'member_id' => Auth::id(),
                    'secondary_category_id' => $request->category,
                    'image1' => $request->image1,
                    'image2' => $request->image2,
                    'image3' => $request->image3,
                    'image4' => $request->image4,
                    'image5' => $request->image5,
                    'image6' => $request->image6,
                    'image7' => $request->image7,
                    'image8' => $request->image8,
                    'image9' => $request->image9,
                    'is_selling' => $request->is_selling,
                ]);

                Stock::create([
                    'product_id' => $product->id,
                    'type' => 1,
                    'quantity' => $request->quantity,
                ]);
            }, 2);
        } catch (Throwable $e) {
            Log::error($e);
            throw $e;
        }

        return redirect()
            ->route('member.products.index')
            ->with([
                'message' => '商品登録しました。',
                'status' => 'info'
            ]);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $quantity = Stock::where('product_id', $product->id)
            ->sum('quantity');

        $images = Image::where('member_id', Auth::id())->select('id', 'title', 'filename')
            ->orderBy('updated_at', 'desc')->get();
        $categories = PrimaryCategory::with('secondary')->get();

        return view(
            'member.products.edit',
            compact('product', 'quantity', 'images', 'categories')
        );
    }

    public function update(ProductRequest $request, $id)
    {
        $request->validate([
            'current_quantity' => 'required|integer',
        ]);

        $product = Product::findOrFail($id);
        $quantity = Stock::where('product_id', $product->id)
            ->sum('quantity');

        if ($request->current_quantity * 1 !== $quantity * 1) {
            $id = $request->route()->parameter('product');
            return redirect()->route('member.products.edit', ['product' => $id])
                ->with([
                    'message' => '在庫数が変更されています。再度確認してください。',
                    'status' => 'alert'
                ]);
        } else {
            try {
                DB::transaction(function () use ($request, $product) {
                    $product->name = $request->name;
                    $product->information = $request->information;
                    $product->price = $request->price;
                    $product->sort_order = $request->sort_order;
                    $product->member_id = Auth::id();
                    $product->secondary_category_id = $request->category;
                    $product->image1 = $request->image1;
                    $product->image2 = $request->image2;
                    $product->image3 = $request->image3;
                    $product->image4 = $request->image4;
                    $product->image5 = $request->image5;
                    $product->image6 = $request->image6;
                    $product->image7 = $request->image7;
                    $product->image8 = $request->image8;
                    $product->image9 = $request->image9;
                    $product->is_selling = $request->is_selling;
                    $product->save();

                    if ($request->type === \Constant::PRODUCT_LIST['add']) {
                        $newQuantity = $request->quantity;
                    }
                    if ($request->type === \Constant::PRODUCT_LIST['reduce']) {
                        $newQuantity = $request->quantity * -1;
                    }
                    Stock::create([
                        'product_id' => $product->id,
                        'type' => $request->type,
                        'quantity' => $newQuantity,
                    ]);
                }, 2);
            } catch (Throwable $e) {
                Log::error($e);
                throw $e;
            }

            return redirect()
                ->route('member.products.index')
                ->with([
                    'message' => '商品情報を更新しました。',
                    'status' => 'info'
                ]);
        }
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();

        return redirect()
            ->route('member.products.index')
            ->with([
                'message' => '商品を削除しました。',
                'status' => 'alert'
            ]);
    }

    public function deletedProductIndex()
    {
        $deletedProducts = Product::onlyTrashed()->where('member_id', Auth::id())->get();
        return view('member.deleted.index', compact('deletedProducts'));
    }

    public function deletedProductUpdate($id)
    {
        Product::onlyTrashed()->findOrFail($id)->restore();

        return redirect()
            ->route('member.deleted.index')
            ->with([
                'message' => '商品を復元しました。',
                'status' => 'info'
            ]);
    }

    public function deletedProductDestroy($id)
    {
        Product::onlyTrashed()->findOrFail($id)->forceDelete();

        return redirect()
            ->route('member.deleted.index')
            ->with([
                'message' => '商品を完全に削除しました。',
                'status' => 'alert'
            ]);
    }
}
