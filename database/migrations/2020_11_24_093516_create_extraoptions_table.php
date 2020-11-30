<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtraoptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extraoptions', function (Blueprint $table) {
            $table->integer('extra_options_id', true);
            $table->string('extra_options_name', 191)->nullable()->default('');
            $table->text('extra_options_image', 65535)->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('extraoptions');
    }
}
