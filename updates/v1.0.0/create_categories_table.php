<?php

namespace Hounddd\Reviews\Updates;

use Schema;
use Winter\Storm\Database\Schema\Blueprint;
use Winter\Storm\Database\Updates\Migration;

class CreateCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('hounddd_reviews_categories', function (Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('slug')->nullable()->index();
            $table->text('description')->nullable();
            $table->boolean('enabled')->default(true);
            $table->smallInteger('sort_order')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('hounddd_reviews_reviews_categories', function ($table) {
            $table->engine = 'InnoDB';
            $table->integer('review_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->primary(['review_id', 'category_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('hounddd_reviews_categories');
        Schema::dropIfExists('hounddd_reviews_reviews_categories');
    }
}
