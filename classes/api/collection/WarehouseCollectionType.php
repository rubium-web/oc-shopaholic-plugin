<?php namespace Lovata\Shopaholic\Classes\Api\Collection;

use GraphQL\Type\Definition\Type;

use Lovata\Shopaholic\Classes\Api\Item\WarehouseItemType;
use Lovata\Shopaholic\Classes\Collection\WarehouseCollection;

use Lovata\Toolbox\Classes\Api\Collection\AbstractCollectionType;
use Lovata\Toolbox\Classes\Api\Type\TypeFactory;

/**
 * Class WarehouseCollectionType
 * @package Lovata\Shopaholic\Classes\Api\Collection
 */
class WarehouseCollectionType extends AbstractCollectionType
{
    const COLLECTION_CLASS = WarehouseCollection::class;
    const RELATED_ITEM_TYPE_CLASS = WarehouseItemType::class;
    const TYPE_ALIAS = 'warehouseList';

    /** @var WarehouseCollectionType */
    protected static $instance;

    /**
     * Get type fields
     * @return array
     * @throws \GraphQL\Error\Error
     */
    protected function getFieldList(): array
    {
        $arFieldList = parent::getFieldList();
        $arFieldList['list'] = Type::listOf(TypeFactory::instance()->get(WarehouseItemType::TYPE_ALIAS));
        $arFieldList['item'] = TypeFactory::instance()->get(WarehouseItemType::TYPE_ALIAS);
        $arFieldList['id'] = Type::id();

        return $arFieldList;
    }

    /**
     * @inheritDoc
     */
    protected function extendResolveMethod($arArgumentList)
    {
        $this->obList = $this->obList->active();
    }
}
