<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Member; //Eloquent エロクアント
use Illuminate\Support\Facades\DB; //QueryBuilder クエリビルダ
use Carbon\Carbon;
use Throwable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class MemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        // $date_now = Carbon::now();
        // $date_parse = Carbon::parse(now());
        // echo $date_now->year;
        // echo $date_parse;

        // $e_all = Owner::all();
        // $q_get = DB::table('owners')->select('name', 'created_at')->get();
        // $q_first = DB::table('owners')->select('name')->first();

        // $c_test = collect([
        //     'name' => 'test'
        // ]);

        // var_dump($q_first);

        // dd($e_all, $q_get, $q_first, $c_test);
        $members = Member::select('id', 'name', 'email', 'created_at')->paginate(5);

        return view(
            'admin.members.index',
            compact('members')
        );
    }

    public function create()
    {
        return view('admin.members.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:members',
            'password' => 'required|string|confirmed|min:8',
        ]);

        Member::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()
            ->route('admin.members.index')
            ->with([
                'message' => 'スタッフ登録を実施しました。',
                'status' => 'info'
            ]);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $member = Member::findOrFail($id);
        // dd($owner);
        return view('admin.members.edit', compact('member'));
    }

    public function update(Request $request, $id)
    {
        $member = Member::findOrFail($id);
        $member->name = $request->name;
        $member->email = $request->email;
        $member->password = Hash::make($request->password);
        $member->save();

        return redirect()
            ->route('admin.members.index')
            ->with([
                'message' => 'スタッフの情報を更新しました。',
                'status' => 'info'
            ]);
    }

    public function destroy($id)
    {
        Member::findOrFail($id)->delete();

        return redirect()
            ->route('admin.members.index')
            ->with([
                'message' => 'スタッフの登録を解除しました。',
                'status' => 'alert'
            ]);
    }

    public function expiredMemberIndex()
    {
        $expiredMembers = Member::onlyTrashed()->get();
        return view('admin.expired-members', compact('expiredMembers'));
    }

    public function expiredMemberDestroy($id)
    {
        Member::onlyTrashed()->findOrFail($id)->forceDelete();
        return redirect()
            ->route('admin.expired-members.index')
            ->with([
                'message' => 'スタッフの情報を削除しました。',
                'status' => 'alert'
            ]);
    }

    public function expiredMemberUpdate($id)
    {
        Member::onlyTrashed()->findOrFail($id)->restore();
        return redirect()
            ->route('admin.expired-members.index')
            ->with([
                'message' => 'スタッフの情報を復元しました。',
                'status' => 'info'
            ]);
    }
}
