<?php namespace Lovata\Shopaholic\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * Class CreateTableOfferWarehouse
 * @package Lovata\Shopaholic\Updates
 */
class CreateTableOfferWarehouse extends Migration
{
    const TABLE = 'lovata_shopaholic_offer_warehouse';
    /**
     * Apply migration
     */
    public function up()
    {
        if (Schema::hasTable(self::TABLE)) {
            return;
        }

        Schema::create(self::TABLE, function (Blueprint $obTable)
        {
            $obTable->engine = 'InnoDB';
            $obTable->integer('offer_id')->unsigned();
            $obTable->integer('warehouse_id')->unsigned();
            $obTable->integer('offer_count')->unsigned()->default(0);
            $obTable->primary(['offer_id', 'warehouse_id']);
        });
    }
    
    /**
     * Rollback migration
     */
    public function down()
    {
        Schema::dropIfExists(self::TABLE);
    }
}
