<?php

namespace App\Calendar;

use Carbon\Carbon;
use App\Models\Holiday;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CalendarView
{

    private $carbon;

    function __construct($date)
    {
        $this->carbon = new Carbon($date);
    }
    /**
     * タイトル
     */
    public function getTitle()
    {
        return $this->carbon->format('Y年n月');
    }

    /**
     * カレンダーを出力する
     */
    function render()
    {
        //HolidaySetting
        $setting = Holiday::where('admin_id', Auth::id())->first();
        //$setting = Holiday::firstOrNew();
        $setting->loadHoliday($this->carbon->format("Y"));
        $html = [];
        $html[] = '<div class="container">';
        $html[] = '<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">';
        $html[] = '<table class="table-auto w-full text-left whitespace-nowrap">';
        $html[] = '<thead>';
        $html[] = '<tr>';
        $html[] = '<th class="px-4 py-2 text-center text-gray-900 bg-gray-100 border">月</th>';
        $html[] = '<th class="px-4 py-2 text-center text-gray-900 bg-gray-100 border">火</th>';
        $html[] = '<th class="px-4 py-2 text-center text-gray-900 bg-gray-100 border">水</th>';
        $html[] = '<th class="px-4 py-2 text-center text-gray-900 bg-gray-100 border">木</th>';
        $html[] = '<th class="px-4 py-2 text-center text-gray-900 bg-gray-100 border">金</th>';
        $html[] = '<th class="px-4 py-2 text-center text-gray-900 bg-gray-100 border">土</th>';
        $html[] = '<th class="px-4 py-2 text-center text-gray-900 bg-gray-100 border">日</th>';
        $html[] = '</tr>';
        $html[] = '</thead>';

        $html[] = '<tbody>';

        $weeks = $this->getWeeks();
        foreach ($weeks as $week) {
            $html[] = '<tr class="' . $week->getClassName() . '">';
            $days = $week->getDays($setting);
            foreach ($days as $day) {
                $html[] = '<td class="px-2 py-6 mx-auto border-2 ' . $day->getClassName() . '">';
                $html[] = $day->render();
                $html[] = '</td>';
            }
            $html[] = '</tr>';
        }

        $html[] = '</tbody>';

        $html[] = '</table>';
        return implode("", $html);
    }

    protected function getWeeks()
    {
        $weeks = [];

        //初日
        $firstDay = $this->carbon->copy()->firstOfMonth();

        //月末まで
        $lastDay = $this->carbon->copy()->lastOfMonth();

        //1週目
        $week = new CalendarWeek($firstDay->copy());
        $weeks[] = $week;

        //作業用の日
        $tmpDay = $firstDay->copy()->addDay(7)->startOfWeek();

        //月末までループさせる
        while ($tmpDay->lte($lastDay)) {
            //週カレンダーViewを作成する
            $week = new CalendarWeek($tmpDay, count($weeks));
            $weeks[] = $week;

            //次の週=+7日する
            $tmpDay->addDay(7);
        }

        return $weeks;
    }

    /**
     * 次の月
     */
    public function getNextMonth()
    {
        return $this->carbon->copy()->addMonthsNoOverflow()->format('Y-m');
    }
    /**
     * 前の月
     */
    public function getPreviousMonth()
    {
        return $this->carbon->copy()->subMonthsNoOverflow()->format('Y-m');
    }
}
