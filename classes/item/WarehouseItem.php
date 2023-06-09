<?php namespace Lovata\Shopaholic\Classes\Item;

use Cms\Classes\Page as CmsPage;

use Lovata\Toolbox\Classes\Item\ElementItem;
use Lovata\Toolbox\Classes\Helper\PageHelper;

use Lovata\Shopaholic\Models\Warehouse;

/**
 * Class WarehouseItem
 * @package Lovata\Shopaholic\Classes\Item
 *
 * @property integer $id
 * @property bool $active
 * @property string $name
 * @property string $code
 * @property string $address
 * @property string $phone
 * @property string $email
 * @property string $description
 * @property string $external_id
 * @property int $sort_order
 * @property \October\Rain\Argon\Argon $created_at
 * @property \October\Rain\Argon\Argon $updated_at
 * @property \October\Rain\Argon\Argon $deleted_at
 *
 * Relations
 *
 * @property \Lovata\Shopaholic\Models\Offer $offer
 * @method \October\Rain\Database\Relations\BelongsTo|Offer offer()
 */
class WarehouseItem extends ElementItem
{
    const MODEL_CLASS = Warehouse::class;

    public static $arQueryWith = ['offer'];

    /** @var Warehouse */
    protected $obElement = null;

    /**
     * Returns URL of a brand page.
     * @param string $sPageCode
     * @return string
     */
    public function getPageUrl($sPageCode = 'warehouse')
    {
        //Get URL params
        $arParamList = $this->getPageParamList($sPageCode);

        //Generate page URL
        $sURL = CmsPage::url($sPageCode, $arParamList);

        return $sURL;
    }

    /**
     * Get URL param list by page code
     * @param string $sPageCode
     * @return array
     */
    public function getPageParamList($sPageCode) : array
    {
        $arPageParamList = [];

        //Get URL params for page
        $arParamList = PageHelper::instance()->getUrlParamList($sPageCode, 'WarehousePage');
        if (!empty($arParamList)) {
            $sPageParam = array_shift($arParamList);
            $arPageParamList[$sPageParam] = $this->slug;
        }

        return $arPageParamList;
    }
}
