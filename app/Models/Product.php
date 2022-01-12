<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Member;
use App\Models\SecondaryCategory;
use App\Models\Image;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'member_id',
        'name',
        'information',
        'price',
        'is_selling',
        'sort_order',
        'secondary_category_id',
        'image1',
        'image2',
        'image3',
        'image4',
        'image5',
        'image6',
        'image7',
        'image8',
        'image9',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function category()
    {
        return $this->belongsTo(SecondaryCategory::class, 'secondary_category_id');
    }

    public function imageOne()
    {
        return $this->belongsTo(Image::class, 'image1', 'id');
    }

    public function imageTwo()
    {
        return $this->belongsTo(Image::class, 'image2', 'id');
    }

    public function imageThree()
    {
        return $this->belongsTo(Image::class, 'image3', 'id');
    }

    public function imageFour()
    {
        return $this->belongsTo(Image::class, 'image4', 'id');
    }

    public function imageFive()
    {
        return $this->belongsTo(Image::class, 'image5', 'id');
    }

    public function imageSix()
    {
        return $this->belongsTo(Image::class, 'image6', 'id');
    }

    public function imageSeven()
    {
        return $this->belongsTo(Image::class, 'image7', 'id');
    }

    public function imageEight()
    {
        return $this->belongsTo(Image::class, 'image8', 'id');
    }

    public function imageNine()
    {
        return $this->belongsTo(Image::class, 'image9', 'id');
    }

    public function stock()
    {
        return $this->hasMany(Stock::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'carts')
            ->withPivot(['id', 'quantity']);
    }

    public function members()
    {
        return $this->belongsToMany(Member::class, 'sales')
            ->withPivot(['id', 'quantity', 'price']);
    }

    public function user()
    {
        return $this->belongsToMany(User::class, 'sales')
            ->withPivot(['id', 'quantity', 'price']);
    }

    public function scopeAvailableItems($query)
    {
        $stocks = DB::table('t_stocks')
            ->select('product_id', DB::raw('sum(quantity) as quantity'))
            ->groupBy('product_id')
            ->having('quantity', '>', 1);

        return $query
            ->joinSub($stocks, 'stock', function ($join) {
                $join->on('products.id', '=', 'stock.product_id');
            })
            ->join('members', 'products.member_id', '=', 'members.id')
            ->join('secondary_categories', 'products.secondary_category_id', '=', 'secondary_categories.id')
            ->join('images as image1', 'products.image1', '=', 'image1.id')
            ->where('products.is_selling', true)
            ->select(
                'products.id as id',
                'products.name as name',
                'members.name as member_name',
                'products.price',
                'products.sort_order as sort_order',
                'products.information',
                'secondary_categories.name as category',
                'image1.filename as filename',
                'products.image1',
            );
    }

    public function scopeSortOrder($query, $sortOrder)
    {
        if ($sortOrder === null || $sortOrder === \Constant::SORT_ORDER['recommend']) {
            return $query->orderBy('sort_order', 'asc');
        }
        if ($sortOrder === \Constant::SORT_ORDER['higherPrice']) {
            return $query->orderBy('price', 'desc');
        }
        if ($sortOrder === \Constant::SORT_ORDER['lowerPrice']) {
            return $query->orderBy('price', 'asc');
        }
        if ($sortOrder === \Constant::SORT_ORDER['later']) {
            return $query->orderBy('products.created_at', 'desc');
        }
        if ($sortOrder === \Constant::SORT_ORDER['older']) {
            return $query->orderBy('products.created_at', 'asc');
        }
    }

    public function scopeSearchOrder($query, $searchOrder)
    {
        if ($searchOrder === null || $searchOrder === \Constant::SEARCH_ORDER['later']) {
            return $query->orderBy('products.created_at', 'desc');
        }
        if ($searchOrder === \Constant::SEARCH_ORDER['older']) {
            return $query->orderBy('products.created_at', 'asc');
        }
        if ($searchOrder === \Constant::SEARCH_ORDER['delete']) {
            return $query->orderBy('products.deleted_at', 'desc');
        }
        if ($searchOrder === \Constant::SEARCH_ORDER['saleok']) {
            return $query->orderBy('products.is_selling', true);
        }
        if ($searchOrder === \Constant::SEARCH_ORDER['saleno']) {
            return $query->orderBy('products.id_selling', false);
        }
    }

    public function scopeSelectCategory($query, $categoryId)
    {
        if ($categoryId !== '0') {
            return $query->where('secondary_category_id', $categoryId);
        } else {
            return;
        }
    }

    public function scopeSelectMember($query, $memberId)
    {
        if ($memberId !== '0') {
            return $query->where('members.id', $memberId);
        } else {
            return;
        }
    }

    public function scopeSearchKeyword($query, $keyword)
    {
        if (!is_null($keyword)) {
            $spaceConvert = mb_convert_kana($keyword, 's'); //全角スペースを半角に
            $keywords = preg_split('/[\s]+/', $spaceConvert, -1, PREG_SPLIT_NO_EMPTY); //空白で区切る
            foreach ($keywords as $word) //単語をループで回す
            {
                $query->where('products.name', 'like', '%' . $word . '%');
            }
            return $query;
        } else {
            return;
        }
    }

    public function scopeManagementItems($query)
    {
        $stocks = DB::table('t_stocks')
            ->select('product_id', DB::raw('sum(quantity) as quantity'))
            ->groupBy('product_id');
        //->having('quantity', '>=', 0);

        return $query
            ->joinSub($stocks, 'stock', function ($join) {
                $join->on('products.id', '=', 'stock.product_id');
            })
            ->join('members', 'products.member_id', '=', 'members.id')
            ->join('secondary_categories', 'products.secondary_category_id', '=', 'secondary_categories.id')
            ->join('images as image1', 'products.image1', '=', 'image1.id')
            //->where('products.is_selling', true)
            ->select(
                'products.id as id',
                'products.name as name',
                'members.name as member_name',
                'products.price',
                'products.is_selling',
                'products.sort_order as sort_order',
                'products.information',
                'products.created_at',
                'products.deleted_at',
                'secondary_categories.name as category',
                'image1.filename as filename',
                'products.image1',
                'stock.quantity as quantity',
            );
    }
}
