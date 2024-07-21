<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGalleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_block')->default(false);
            $table->string('link')->nullable();
            $table->string('type');
            $table->timestamps();
        });

        Schema::create('gallery_translations', function(Blueprint $table) {
            $table->increments('id');
            $table->string('locale')->index();
            $table->string('title');
            $table->longText('description');
            $table->foreignId('gallery_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->unique(['gallery_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('gallery_translations');
        Schema::dropIfExists('galleries');
    }
}
