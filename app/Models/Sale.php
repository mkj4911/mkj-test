<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'member_id',
        'product_id',
        'quantity',
        'price',
        'processing',
    ];

    public function scopeSalesHistory($query)
    {
        return $query
            ->join('members', 'sales.member_id', '=', 'members.id')
            ->join('users', 'sales.user_id', '=', 'users.id')
            ->join('products', 'sales.product_id', '=', 'products.id')
            ->join('images as image1', 'products.image1', '=', 'image1.id')
            ->select(
                'sales.id',
                'sales.member_id',
                'members.name as member_name',
                'sales.user_id',
                'users.name as user_name',
                'users.email as user_email',
                'products.name as product_name',
                'sales.product_id as product_id',
                'sales.price as price',
                'sales.quantity as quantity',
                'sales.created_at as created_at',
                'image1.filename as filename',
                'sales.processing'
            )
            ->orderBy('sales.created_at', 'desc');
    }
}
