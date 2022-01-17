<?php

namespace App\Constants;

class Common
{
    const PRODUCT_ADD = '1';
    const PRODUCT_REDUCE = '2';
    const PRODUCT_SALES = '3';
    const PRODUCT_CANCEL = '4';
    const PRODUCT_RETURN = '5';

    const PRODUCT_LIST = [
        'add' => self::PRODUCT_ADD,
        'reduce' => self::PRODUCT_REDUCE,
        'sales' => self::PRODUCT_SALES,
        'cancel' => self::PRODUCT_CANCEL,
        'return' => self::PRODUCT_RETURN,
    ];

    const ORDER_RECOMMEND = '0';
    const ORDER_HIGHER = '1';
    const ORDER_LOWER = '2';
    const ORDER_LATER = '3';
    const ORDER_OLDER = '4';

    const SORT_ORDER = [
        'recommend' => self::ORDER_RECOMMEND,
        'higherPrice' => self::ORDER_HIGHER,
        'lowerPrice' => self::ORDER_LOWER,
        'later' => self::ORDER_LATER,
        'older' => self::ORDER_OLDER
    ];

    const SEARCH_RECOMMEND = '0';
    const SEARCH_DELETED = '1';
    const SEARCH_SALEOK = '2';
    const SEARCH_SALENG = '3';

    const SEARCH_ORDER = [
        'recommend' => self::SEARCH_RECOMMEND,
        'deleted' => self::SEARCH_DELETED,
        'saleok' => self::SEARCH_SALEOK,
        'saleng' => self::SEARCH_SALENG
    ];
}
