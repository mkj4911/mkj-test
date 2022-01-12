<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Member;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'filename',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
