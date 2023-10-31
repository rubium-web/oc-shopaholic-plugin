<?php namespace Lovata\Shopaholic\Classes\Store\Offer;

use Lovata\Toolbox\Classes\Store\AbstractStoreWithParam;

use Lovata\Shopaholic\Models\Offer;

/**
 * @package Lovata\Shopaholic\Classes\Store\Offer
 * @author  Andrey Kharanenka, a.khoronenko@lovata.com, LOVATA Group
 */
class ListByWarehouseStore extends AbstractStoreWithParam
{
    protected static $instance;

    /**
     * Get ID list from database
     * @return array
     */
    protected function getIDListFromDB() : array
    {
        $arElementIDList = (array) Offer::whereHas('warehouse', function($obQuery) {
            return $obQuery->where('id', $this->sValue);
        })
            ->pluck('id')
            ->all();

        return $arElementIDList;
    }
}
