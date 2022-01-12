<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PrimaryCategory;

class SecondaryCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sort_order',
        'primary_category_id',
    ];

    public function primary()
    {
        return $this->belongsTo(PrimaryCategory::class);
    }
}
