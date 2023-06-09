<?php namespace Lovata\Shopaholic\Models;

use Model;

use Kharanenka\Scope\ActiveField;
use Kharanenka\Scope\CodeField;
use Kharanenka\Scope\ExternalIDField;
use Kharanenka\Scope\NameField;

use October\Rain\Database\Traits\Validation;
use October\Rain\Database\Traits\Sortable;

use Lovata\Toolbox\Traits\Helpers\TraitCached;

/**
 * Class Warehouse
 * @package Lovata\Shopaholic\Models
 *
 * @mixin \October\Rain\Database\Builder
 * @mixin \Eloquent
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
class Warehouse extends Model
{
    use Validation;
    use Sortable;
    use ActiveField;
    use NameField;
    use CodeField;
    use ExternalIDField;
    use TraitCached;

    /** @var string */
    public $table = 'lovata_shopaholic_warehouses';
    /** @var array */
    public $implement = [
        '@RainLab.Translate.Behaviors.TranslatableModel',
    ];
    /** @var array */
    public $translatable = [];
    /** @var array */
    public $attributeNames = [
        'name' => 'lovata.toolbox::lang.field.name',
        'code' => 'lovata.toolbox::lang.field.code',
    ];
    /** @var array */
    public $rules = [
        'name' => 'required',
        'code' => 'required|unique:lovata_shopaholic_warehouses',
    ];
    /** @var array */
    public $slugs = [];
    /** @var array */
    public $jsonable = [];
    /** @var array */
    public $fillable = [
        'id',
        'active',
        'name',
        'code',
        'address',
        'phone',
        'email',
        'description',
        'external_id',
    ];
    /** @var array */
    public $cached = [
        'id',
        'active',
        'name',
        'code',
        'address',
        'phone',
        'email',
        'description',
        'external_id',
    ];
    /** @var array */
    public $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    /** @var array */
    public $casts = [];
    /** @var array */
    public $visible = [];
    /** @var array */
    public $hidden = [];
    /** @var array */
    public $hasOne = [];
    /** @var array */
    public $hasMany = [];
    /** @var array */
    public $belongsTo = [];
    /** @var array */
    public $belongsToMany = [
        'offer' => [
            Offer::class,
            'table' => 'lovata_shopaholic_offer_warehouse',
            'pivot' => ['offer_count']
        ]
    ];
    /** @var array */
    public $morphTo = [];
    /** @var array */
    public $morphOne = [];
    /** @var array */
    public $morphMany = [];
    /** @var array */
    public $attachOne = [];
    /** @var array */
    public $attachMany = [];
}
