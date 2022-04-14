<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'image',
        'phone1',
        'phone2',
        'zipcode',
        'address1',
        'address2'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
