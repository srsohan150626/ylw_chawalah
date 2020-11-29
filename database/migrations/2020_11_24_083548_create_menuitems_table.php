<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuitemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menuitems', function (Blueprint $table) {
            $table->integer('item_id', true);
			$table->text('item_image', 65535)->nullable();
			$table->decimal('item_price', 15);
			$table->dateTime('item_date_added')->index('idx_item_date_added');
			$table->dateTime('item_last_modified')->nullable();
			$table->boolean('item_status');
            $table->boolean('is_new')->default(0);
            $table->string('products_name', 191)->default('')->index('products_name');
			$table->text('products_description', 65535)->nullable();
            $table->string('item_slug', 191);
			$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menuitems');
    }
}
