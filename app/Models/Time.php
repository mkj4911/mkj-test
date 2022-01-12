<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Member;

class Time extends Model
{
    use HasFactory;

    protected $fillable = ['member_id', 'punchIn', 'punchOut', 'month', 'day', 'workTime', 'year'];


    //任意の月の勤怠をスコープ
    public function scopeGetMonthAttendance($query, $month)
    {
        return $query->where('month', $month);
    }

    //任意の月の勤怠をスコープ
    public function scopeGetDayAttendance($query, $day)
    {
        return $query->where('day', $day);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
