<?php namespace Lovata\Shopaholic\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * Class CreateTableWarehouses
 * @package Lovata\Shopaholic\Classes\Console
 */
class CreateTableWarehouses extends Migration
{
    const TABLE = 'lovata_shopaholic_warehouses';

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
            $obTable->increments('id')->unsigned();
            $obTable->boolean('active')->default(0);
            $obTable->string('name');
            $obTable->string('code')->nullable()->index();
            $obTable->string('address')->nullable();
            $obTable->string('phone')->nullable();
            $obTable->string('email')->nullable();
            $obTable->integer('sort_order')->nullable();
            $obTable->text('description')->nullable();
            $obTable->string('external_id')->nullable()->index();
            $obTable->softDeletes();
            $obTable->timestamps();
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
