<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'name',
        'information',
        'filename',
        'is_selling',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
