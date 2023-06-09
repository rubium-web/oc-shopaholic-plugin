<?php namespace Lovata\Shopaholic\Classes\Store\Warehouse;

use Lovata\Toolbox\Classes\Store\AbstractStoreWithoutParam;

use Lovata\Shopaholic\Models\Warehouse;

/**
 * Class SortingListStore
 * @package Lovata\Shopaholic\Classes\Store\Warehouse
 * @author Andrey Kharanenka, a.khoronenko@lovata.com, LOVATA Group
 */
class SortingListStore extends AbstractStoreWithoutParam
{
    protected static $instance;

    /**
     * Get ID list from database
     * @return array
     */
    protected function getIDListFromDB() : array
    {
        $arElementIDList = (array) Warehouse::orderBy('sort_order', 'asc')->pluck('id')->all();

        return $arElementIDList;
    }
}
