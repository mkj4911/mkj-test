<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Image;
use App\Models\Product;
use App\Models\Time;
use App\Models\User;

class Member extends Authenticatable
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function image()
    {
        return $this->hasMany(Image::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }

    public function time()
    {
        return $this->hasMany(Time::class);
    }

    public function user()
    {
        return $this->belongsToMany(User::class, 'sales')
            ->withPivot(['id', 'quantity', 'price']);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'sales')
            ->withPivot(['id', 'quantity', 'price']);
    }
}
