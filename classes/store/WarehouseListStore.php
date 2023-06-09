<?php namespace Lovata\Shopaholic\Classes\Store;

use Lovata\Toolbox\Classes\Store\AbstractListStore;

use Lovata\Shopaholic\Classes\Store\Warehouse\ActiveListStore;
use Lovata\Shopaholic\Classes\Store\Warehouse\SortingListStore;

/**
 * Class WarehouseListStore
 * @package Lovata\Shopaholic\Classes\Store
 * @author  Andrey Kharanenka, a.khoronenko@lovata.com, LOVATA Group
 * @property ActiveListStore     $active
 * @property SortingListStore    $sorting
 */
class WarehouseListStore extends AbstractListStore
{
    protected static $instance;

    /**
     * Init store method
     */
    protected function init()
    {
        $this->addToStoreList('active', ActiveListStore::class);
        $this->addToStoreList('sorting', SortingListStore::class);
    }
}
