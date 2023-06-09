<?php namespace Lovata\Shopaholic\Classes\Api\Item;

use GraphQL\Type\Definition\Type;
use Lovata\Shopaholic\Classes\Item\WarehouseItem;
use Lovata\Toolbox\Classes\Api\Item\AbstractItemType;

/**
 * Class WarehouseItemType
 * @package Lovata\Shopaholic\Classes\Api\Item
 */
class WarehouseItemType extends AbstractItemType
{
    const ITEM_CLASS = WarehouseItem::class;
    const TYPE_ALIAS = 'warehouse';

    /* @var WarehouseItemType */
    protected static $instance;

    /**
     * Get type fields
     * @return array
     * @throws \GraphQL\Error\Error
     */
    protected function getFieldList(): array
    {
        $arFieldList = [
            'id'   => Type::id(),
            'active' => Type::boolean(),
            'code' => Type::string(),
            'name' => Type::string(),
            'description' => Type::string(),
            'address' => Type::string(),
            'phone' => Type::string(),
            'sort_order' => Type::int(),
        ];

        return $arFieldList;
    }

    /**
     * @inheritDoc
     */
    protected function extendResolveMethod($arArgumentList)
    {
        if (null !== $this->obItem && !$this->obItem->active) {
            $this->obItem = null;
        }
    }
}
