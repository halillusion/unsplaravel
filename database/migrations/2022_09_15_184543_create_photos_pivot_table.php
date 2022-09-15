<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotosPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photos_pivot', function (Blueprint $table) {
            $table->id();
            $table->string('photo_id')->unique();
            $table->string('raw_url');
            $table->string('full_url');
            $table->string('regular_url');
            $table->string('small_url');
            $table->string('thumb_url');
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
        Schema::dropIfExists('photos_pivot');
    }
}
