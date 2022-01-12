<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin;
use App\Models\Shop;
use Yasumi\Yasumi;

class Holiday extends Model
{
    use HasFactory;

    const OPEN = 1;
    const CLOSE = 2;

    protected $table = "holidays";

    protected $fillable = [
        'admin_id',
        "flag_mon",
        "flag_tue",
        "flag_wed",
        "flag_thu",
        "flag_fri",
        "flag_sat",
        "flag_sun",
        "flag_holiday",
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    function isOpenMonday()
    {
        return $this->flag_mon == Holiday::OPEN;
    }
    function isOpenTuesday()
    {
        return $this->flag_tue == Holiday::OPEN;
    }
    function isOpenWednesday()
    {
        return $this->flag_wed == Holiday::OPEN;
    }
    function isOpenThursday()
    {
        return $this->flag_thu == Holiday::OPEN;
    }
    function isOpenFriday()
    {
        return $this->flag_fri == Holiday::OPEN;
    }
    function isOpenSaturday()
    {
        return $this->flag_sat == Holiday::OPEN;
    }
    function isOpenSunday()
    {
        return $this->flag_sun == Holiday::OPEN;
    }
    function isOpenHoliday()
    {
        return $this->flag_holiday == Holiday::OPEN;
    }
    function isCloseMonday()
    {
        return $this->flag_mon == Holiday::CLOSE;
    }
    function isCloseTuesday()
    {
        return $this->flag_tue == Holiday::CLOSE;
    }
    function isCloseWednesday()
    {
        return $this->flag_wed == Holiday::CLOSE;
    }
    function isCloseThursday()
    {
        return $this->flag_thu == Holiday::CLOSE;
    }
    function isCloseFriday()
    {
        return $this->flag_fri == Holiday::CLOSE;
    }
    function isCloseSaturday()
    {
        return $this->flag_sat == Holiday::CLOSE;
    }
    function isCloseSunday()
    {
        return $this->flag_sun == Holiday::CLOSE;
    }
    function isCloseHoliday()
    {
        return $this->flag_holiday == Holiday::CLOSE;
    }

    private $holidays = null;
    //public $holidays = null;

    function loadHoliday($year)
    {
        $this->holidays = Yasumi::create("Japan", $year, "ja_JP");
    }

    function isHoliday($date)
    {
        if (!$this->holidays) return false;
        return $this->holidays->isHoliday($date);
    }
}
