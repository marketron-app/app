<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('templates', function (Blueprint $table) {
            $table->id();
            $table->string("identifier")->unique()->index();
            $table->string("title");
            $table->mediumText("description");
            $table->text("url");
            $table->text("thumbnail_url");
            $table->json("coordinates");
            $table->integer("screenshot_width");
            $table->integer("screenshot_height");
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
        Schema::dropIfExists('templates');
    }
};
