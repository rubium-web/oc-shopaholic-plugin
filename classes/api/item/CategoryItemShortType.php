<?php namespace Lovata\Shopaholic\Classes\Api\Item;

use GraphQL\Type\Definition\Type;

use Lovata\Shopaholic\Classes\Item\CategoryItem;

use Lovata\Toolbox\Classes\Api\Item\AbstractItemType;
use Lovata\Toolbox\Classes\Api\Type\Custom\Type as CustomType;

/**
 * Class CategoryItemShortType
 * @package Lovata\Shopaholic\Classes\Api\Item
 */
class CategoryItemShortType extends AbstractItemType
{
    const ITEM_CLASS = CategoryItem::class;
    const TYPE_ALIAS = 'category_short';

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
            'id'               => Type::nonNull(Type::id()),
            'name'             => Type::string(),
            'slug'             => Type::string(),
            'code'             => Type::string(),
            'nest_depth'       => Type::int(),
            'parent_id'        => Type::id(),
            'product_count'    => Type::int(),
            'preview_text'     => Type::string(),
            'description'      => Type::string(),
            'updated_at'       => Type::string(),
            'children_id_list' => CustomType::array(),
        ];

        $arPreviewImageFields = $this->getAttachOneFileFields('preview_image');
        $arIconFields = $this->getAttachOneFileFields('icon');
        $arImagesFields = $this->getAttachManyFileFields('images');
        $arFieldList = array_merge($arFieldList, $arPreviewImageFields, $arIconFields, $arImagesFields);

        return $arFieldList;
    }
}
