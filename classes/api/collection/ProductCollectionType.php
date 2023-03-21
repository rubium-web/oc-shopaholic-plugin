<?php namespace Lovata\Shopaholic\Classes\Api\Collection;

use Lovata\Shopaholic\Classes\Api\Item\ProductItemType;
use Lovata\Shopaholic\Classes\Api\Type\Enum\ProductCollectionSortingEnumType;
use Lovata\Shopaholic\Classes\Api\Type\Input\FilterProductCollectionInputType;
use Lovata\Shopaholic\Classes\Collection\ProductCollection;
use Lovata\Toolbox\Classes\Api\Collection\AbstractCollectionType;
use Lovata\Shopaholic\Classes\Api\Type\PriceDataType;

/**
 * Class ProductCollectionType
 * @package Lovata\Shopaholic\Classes\Api\Collection
 */
class ProductCollectionType extends AbstractCollectionType
{
    const COLLECTION_CLASS = ProductCollection::class;
    const RELATED_ITEM_TYPE_CLASS = ProductItemType::class;

    const TYPE_ALIAS = 'productList';

    /** @var ProductCollectionType */
    protected static $instance;

    /** @var ProductCollection */
    protected $obList;

    /** @var PriceDataType */
    protected $obPriceMin;

    /** @var PriceDataType */
    protected $obPriceMax;

    protected $sFilterInputTypeClass = FilterProductCollectionInputType::class;
    protected $sSortEnumInputTypeClass = ProductCollectionSortingEnumType::class;

    /**
     * @inheritDoc
     */
    protected function extendResolveMethod($arArgumentList)
    {
        $this->obList->active();
    }

    /**
     * Apply filters
     * @param $arArgumentList
     * @return void
     * @throws MethodNotFoundException
     */
    protected function applyFilters($arArgumentList)
    {
        parent::applyFilters($arArgumentList);

        // After filtering
        $this->obPriceMin = $this->obList->getOfferMinPrice();
        $this->obPriceMax = $this->obList->getOfferMaxPrice();
    }

    /**
     * Get type fields
     * @return array
     * @throws \GraphQL\Error\Error
     */
    protected function getFieldList(): array
    {
        $arFieldList = parent::getFieldList();

        $arFieldList['price_min'] = [
            'type'    => $this->getRelationType(PriceDataType::TYPE_ALIAS),
            'resolve' => function () {
                /** @var PriceDataType $obPriceDataType */
                return $this->obPriceMin;
            },
        ];

        $arFieldList['price_max'] = [
            'type'    => $this->getRelationType(PriceDataType::TYPE_ALIAS),
            'resolve' => function () {
                /** @var PriceDataType $obPriceDataType */
                return $this->obPriceMax;
            },
        ];

        return $arFieldList;
    }

    //
    // Filter methods
    //

    /**
     * Filter by brand ID
     * @param $iBrandId
     * @return void
     */
    protected function filterByBrand($iBrandId)
    {
        $this->obList->brand($iBrandId);
    }

    /**
     * Filter by category ID list
     * @param $arFilterInput
     * @return void
     */
    protected function filterByCategory($arFilterInput)
    {
        $this->obList->category($arFilterInput['categoryIdList'], $arFilterInput['includeChildren']);
    }

    /**
     * Filter by promo block ID
     * @param $iPromoBlockId
     * @return void
     */
    protected function filterByPromoBlock($iPromoBlockId)
    {
        $this->obList->promoBlock($iPromoBlockId);
    }
}
