<?php

namespace App\Calendar1;

/**
 * 余白を出力するためのクラス
 */
class CalendarWeekBlankDay1 extends CalendarWeekDay1
{

    function getClassName()
    {
        return "day-blank";
    }

    /**
     * @return 
     */
    function render()
    {
        return '';
    }
}
