<?php namespace Lovata\Shopaholic\Classes\Api\Item;

use GraphQL\Type\Definition\Type;
use Lovata\Shopaholic\Classes\Item\CategoryItem;
use Lovata\Toolbox\Classes\Api\Item\AbstractItemType;
use Lovata\Toolbox\Classes\Api\Type\Custom\ImageFileType;

use Illuminate\Support\Arr;

/**
 * Class CategoryItemShortType
 * @package Lovata\Shopaholic\Classes\Api\Item
 */
class CategoryItemShortType extends AbstractItemType
{
    const ITEM_CLASS = CategoryItem::class;
    const TYPE_ALIAS = 'categoryShort';

    /* @var CategoryItemShortType */
    protected static $instance;

    /**
     * Get type fields
     * @return array
     * @throws \GraphQL\Error\Error
     */
    protected function getFieldList(): array
    {
        $arFieldList = [
            'id'               => Type::id(),
            'name'             => Type::string(),
            'slug'             => Type::string(),
            'code'             => Type::string(),
            'nest_depth'       => Type::int(),
            'parent_id'        => Type::id(),
            'product_count'    => Type::int(),
            'preview_text'     => Type::string(),
            'description'      => Type::string(),
            'updated_at'       => Type::string(),
            'children_id_list' => Type::listOf(Type::id()),
            'preview_image'    => [
                'type'    => $this->getRelationType(ImageFileType::TYPE_ALIAS),
                'resolve' => function ($obCategoryItem) {
                    /* @var CategoryItem $obCategoryItem */
                    return $obCategoryItem->preview_image;
                },
            ],
            'icon'             => [
                'type'    => $this->getRelationType(ImageFileType::TYPE_ALIAS),
                'resolve' => function ($obCategoryItem) {
                    /* @var CategoryItem $obCategoryItem */
                    return $obCategoryItem->icon;
                },
            ],
            'images'           => [
                'type'    => Type::listOf($this->getRelationType(ImageFileType::TYPE_ALIAS)),
                'resolve' => function ($obCategoryItem) {
                    /* @var CategoryItem $obCategoryItem */
                    return $obCategoryItem->images;
                },
            ],
        ];

        return $arFieldList;
    }

    /**
     * @inheritDoc
     */
    protected function getArguments(): ?array
    {
        $arArgumentList = [
            'slug'     => [
                'type' => Type::string(),
                'description' => 'category slug',
            ]
        ];

        return array_merge(parent::getArguments(), $arArgumentList);
    }

    /**
     * @inheritDoc
     */
    protected function getDescription(): string
    {
        return 'Category short data';
    }

    /**
     * @inheritDoc
     */
    protected function extendResolveMethod($arArgumentList)
    {
        if(null !== $sSlug = Arr::get($arArgumentList, 'slug')){
               
           $sModelClass = self::ITEM_CLASS::MODEL_CLASS; // >=php8.1
           
           $obElement = $sModelClass::active()->getBySlug($sSlug)->first();

            if (!empty($obElement)) {
                $sItemClass = static::ITEM_CLASS;
                $this->obItem = $sItemClass::make($obElement->id, $obElement);
            }
        }

        if (null !== $this->obItem && !$this->obItem->active) {
            $this->obItem = null;
        }
    }
}
