<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Member;
use App\Models\User;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Stock;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:members');

        $this->middleware(function ($request, $next) {

            $id = $request->route()->parameter('sale');
            if (!is_null($id)) {
                $salesMemberId = Sale::findOrFail($id)->member_id;
                $salesId = (int)$salesMemberId;
                $memberId = Auth::id();
                if ($salesId !== $memberId) {
                    abort(404);
                }
            }
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $member = Member::findOrFail(Auth::id());
        $sales = Sale::SalesHistory()
            ->where('sales.member_id', Auth::id())->get();

        return view('member.sales.index', compact('sales'));
    }

    public function edit($id)
    {
        $sale = Sale::findOrFail($id);
        $sales = Sale::SalesHistory()
            ->where('sales.id', $sale->id)->get();
        //dd($sales);

        return view('member.sales.edit', compact('sales'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'processing' => 'required',
        ]);

        $sale = Sale::findOrFail($id);
        $sale->processing = $request->processing;
        $sale->save();

        return redirect()
            ->route('member.sales.index')
            ->with([
                'message' => '販売履歴を更新しました。',
                'status' => 'info'
            ]);
    }

    public function destroy($id)
    {
        $sales = Sale::findOrFail($id);
        $member = Member::findOrFail(Auth::id());
        $i = 0;

        foreach ($member->products as $product) {
            if ($i >= 1) {
                break;
            } else {
                Stock::create([
                    'product_id' => $product->id,
                    'type' => \Constant::PRODUCT_LIST['return'],
                    'quantity' => $sales->quantity,
                ]);
                $i++;
            }
        }

        Sale::findOrFail($id)->delete();

        return back()
            ->with([
                'message' => '販売履歴を削除しました。',
                'status' => 'alert'
            ]);
    }
}
