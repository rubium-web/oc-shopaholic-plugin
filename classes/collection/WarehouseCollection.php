<?php namespace Lovata\Shopaholic\Classes\Collection;

use Lovata\Toolbox\Classes\Collection\ElementCollection;
use Lovata\Shopaholic\Classes\Item\WarehouseItem;
use Lovata\Shopaholic\Classes\Store\WarehouseListStore;

/**
 * Class WarehouseCollection
 * @package Lovata\Shopaholic\Classes\Collection
 */
class WarehouseCollection extends ElementCollection
{
    const ITEM_CLASS = WarehouseItem::class;

    /**
     * Apply filter by active field
     * @return $this
     */
    public function active()
    {
        $arResultIDList = WarehouseListStore::instance()->active->get();

        return $this->intersect($arResultIDList);
    }

    /**
     * Sort list
     * @return $this
     */
    public function sort()
    {
        $arResultIDList = WarehouseListStore::instance()->sorting->get();

        return $this->applySorting($arResultIDList);
    }
}
