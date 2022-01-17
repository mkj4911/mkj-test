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

    //ハッシュタグレポートを取得
    public static function scopeGetDate($query, $from, $until)
    {
        return $query
            //created_atが20xx/xx/xx ~ 20xx/xx/xxのデータを取得
            ->whereBetween('punchIn', [$from, $until])
            ->orwhereDate('punchIn', [$until]);
    }

    public static function scopeGetDate1($query, $from)
    {
        return $query
            //created_atが20xx/xx/xx ~ 20xx/xx/xxのデータを取得
            ->whereDate('punchIn', [$from]);
    }

    public function scopeSelectMembers($query, $memberId)
    {
        if ($memberId !== '0') {
            return $query->where('member_id', $memberId);
        } else {
            return;
        }
    }
}
