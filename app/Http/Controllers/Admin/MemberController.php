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
use Illuminate\Support\Facades\Storage;
use InterventionImage;
use App\Http\Requests\UploadImageRequest;
use App\Services\ImageService;

class MemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $members = Member::select('id', 'name', 'email', 'filename', 'created_at')->paginate(9);

        return view(
            'admin.members.index',
            compact('members')
        );
    }

    public function create()
    {
        return view('admin.members.create');
    }

    public function store(UploadImageRequest $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:members',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $member = Member::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'filename' => '',
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

    public function update(UploadImageRequest $request, $id)
    {
        $imageFile = $request->image;
        if (!is_null($imageFile) && $imageFile->isValid()) {
            $fileNameToStore = ImageService::upload($imageFile, 'members');
        }

        $member = Member::findOrFail($id);
        $member->name = $request->name;
        $member->email = $request->email;
        $member->password = Hash::make($request->password);
        if (!is_null($imageFile) && $imageFile->isValid()) {
            $member->filename = $fileNameToStore;
        }
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
