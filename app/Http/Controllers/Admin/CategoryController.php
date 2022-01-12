<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PrimaryCategory;
use App\Models\SecondaryCategory;
use Illuminate\Support\Facades\DB; //QueryBuilder クエリビルダ

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $primaries = PrimaryCategory::select('id', 'name', 'sort_order', 'created_at')
            ->orderBy('sort_order', 'asc')
            ->paginate(5);

        return view(
            'admin.categories.index',
            compact('primaries')
        );
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:20',
            'sort_order' => 'required|integer|max:50',
        ]);

        PrimaryCategory::create([
            'name' => $request->name,
            'sort_order' => $request->sort_order,
        ]);

        return redirect()
            ->route('admin.categories.index')
            ->with([
                'message' => 'カテゴリーの登録を実施しました。',
                'status' => 'info'
            ]);
    }

    public function edit($id)
    {
        $primary = PrimaryCategory::findOrFail($id);

        return view('admin.categories.edit', compact('primary'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:20',
            'sort_order' => 'required|integer|max:50',
        ]);

        $primary = PrimaryCategory::findOrFail($id);
        $primary->name = $request->name;
        $primary->sort_order = $request->sort_order;
        $primary->save();

        return redirect()
            ->route('admin.categories.index')
            ->with([
                'message' => 'カテゴリーを更新しました。',
                'status' => 'info'
            ]);
    }

    public function destroy($id)
    {
        PrimaryCategory::findOrFail($id)->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with([
                'message' => 'カテゴリーを削除しました。',
                'status' => 'alert'
            ]);
    }

    public function subindex($id)
    {
        $primary = PrimaryCategory::findOrFail($id);

        $primaries = SecondaryCategory::where('primary_category_id', $primary->id)
            ->select('id', 'name', 'sort_order', 'primary_category_id', 'created_at')
            ->orderBy('sort_order', 'asc')
            ->paginate(5);

        //dd($primaries);

        return view(
            'admin.categories.subindex',
            compact('primaries', 'primary')
        );
    }

    public function substore(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:20',
            'sort_order' => 'required|integer|max:50',
        ]);

        $primary = PrimaryCategory::findOrFail($id);

        SecondaryCategory::create([
            'name' => $request->name,
            'sort_order' => $request->sort_order,
            'primary_category_id' => $request->primary_category_id,
        ]);

        return redirect()
            ->route('admin.categories.subindex', compact('primary'))
            ->with([
                'message' => 'カテゴリーの登録を実施しました。',
                'status' => 'info'
            ]);
    }

    public function subdestroy($id)
    {
        SecondaryCategory::findOrFail($id)->delete();

        return back()
            ->with([
                'message' => 'カテゴリーを削除しました。',
                'status' => 'alert'
            ]);
    }
}
