<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsAddonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items_addons', function (Blueprint $table) {
            $table->integer('items_addons_id', true);
			$table->integer('item_id')->index('idx_items_addons_item_id');
			$table->integer('extra_options_id');
			$table->decimal('extra_options_price', 15);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items_addons');
    }
}
