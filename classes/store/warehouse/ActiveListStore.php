<?php namespace Lovata\Shopaholic\Classes\Store\Warehouse;

use Lovata\Toolbox\Classes\Store\AbstractStoreWithoutParam;

use Lovata\Shopaholic\Models\Warehouse;

/**
 * Class ActiveListStore
 * @package Lovata\Shopaholic\Classes\Store\Warehouse
 * @author  Andrey Kharanenka, a.khoronenko@lovata.com, LOVATA Group
 */
class ActiveListStore extends AbstractStoreWithoutParam
{
    protected static $instance;

    /**
     * Get ID list from database
     * @return array
     */
    protected function getIDListFromDB() : array
    {
        $arElementIDList = (array) Warehouse::active()->pluck('id')->all();

        return $arElementIDList;
    }
}
