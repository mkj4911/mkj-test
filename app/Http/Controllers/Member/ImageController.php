<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UploadImageRequest;
use App\Services\ImageService;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:members');

        $this->middleware(function ($request, $next) {

            $id = $request->route()->parameter('image');
            if (!is_null($id)) {
                $imagesMemberId = Image::findOrFail($id)->member->id;
                $imageId = (int)$imagesMemberId;
                $memberId = Auth::id();
                if ($imageId !== $memberId) {
                    abort(404);
                }
            }
            return $next($request);
        });
    }

    public function index()
    {
        $images = Image::where('member_id', Auth::id())
            ->orderBy('updated_at', 'desc')
            ->paginate(12);

        return view(
            'member.images.index',
            compact('images')
        );
    }

    public function create()
    {
        return view('member.images.create');
    }

    public function store(UploadImageRequest $request)
    {
        $imageFiles = $request->file('files');
        if (!is_null($imageFiles)) {
            foreach ($imageFiles as $imageFile) {
                $fileNameToStore = ImageService::upload($imageFile, 'products');
                Image::create([
                    'member_id' => Auth::id(),
                    'filename' => $fileNameToStore,
                ]);
            }
        }

        return redirect()
            ->route('member.images.index')
            ->with([
                'message' => '画像登録を実施しました。',
                'status' => 'info'
            ]);
    }

    public function edit($id)
    {
        $image = Image::findOrFail($id);
        //dd(Shop::findOrFail($id));
        return view('member.images.edit', compact('image'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'string|max:50|nullable',
        ]);

        $image = Image::findOrFail($id);
        $image->title = $request->title;
        $image->save();

        return redirect()
            ->route('member.images.index')
            ->with([
                'message' => '画像を更新しました。',
                'status' => 'info'
            ]);
    }

    public function destroy($id)
    {
        $image = Image::findOrFail($id);

        $imageInProducts = Product::where('image1', $image->id)
            ->orWhere('image2', $image->id)
            ->orWhere('image3', $image->id)
            ->orWhere('image4', $image->id)
            ->orWhere('image5', $image->id)
            ->orWhere('image6', $image->id)
            ->orWhere('image7', $image->id)
            ->orWhere('image8', $image->id)
            ->orWhere('image9', $image->id)
            ->get();

        if ($imageInProducts) {
            $imageInProducts->each(function ($product) use ($image) {
                if ($product->image1 === $image->id) {
                    $product->image1 = null;
                    $product->save();
                }
                if ($product->image2 === $image->id) {
                    $product->image2 = null;
                    $product->save();
                }
                if ($product->image3 === $image->id) {
                    $product->image3 = null;
                    $product->save();
                }
                if ($product->image4 === $image->id) {
                    $product->image4 = null;
                    $product->save();
                }
                if ($product->image5 === $image->id) {
                    $product->image5 = null;
                    $product->save();
                }
                if ($product->image6 === $image->id) {
                    $product->image6 = null;
                    $product->save();
                }
                if ($product->image7 === $image->id) {
                    $product->image7 = null;
                    $product->save();
                }
                if ($product->image8 === $image->id) {
                    $product->image8 = null;
                    $product->save();
                }
                if ($product->image9 === $image->id) {
                    $product->image9 = null;
                    $product->save();
                }
            });
        }


        $filePath = 'public/products/' . $image->filename;

        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
        }

        Image::findOrFail($id)->delete();

        return redirect()
            ->route('member.images.index')
            ->with([
                'message' => '画像を削除しました。',
                'status' => 'alert'
            ]);
    }
}
