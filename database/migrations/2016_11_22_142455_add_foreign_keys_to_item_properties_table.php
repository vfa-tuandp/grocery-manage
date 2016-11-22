<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToItemPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item_properties', function (Blueprint $table) {

            $table->foreign('property_id', 'fk_item_properties_m_property1')->references('id')->on('m_property')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('item_id', 'fk_item_properties_items1')->references('id')->on('items')->onUpdate('NO ACTION')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('item_properties', function (Blueprint $table) {

            $table->dropForeign('fk_item_properties_m_property1');
            $table->dropForeign('fk_item_properties_items1');
        });
    }
}
