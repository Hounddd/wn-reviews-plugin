<?php

namespace Hounddd\Reviews\Updates;

use Schema;
use Winter\Storm\Database\Schema\Blueprint;
use Winter\Storm\Database\Updates\Migration;

class CreateReviewsTable extends Migration
{
    public function up()
    {
        Schema::create('hounddd_reviews_reviews', function (Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('email')->nullable();
            $table->string('name')->nullable();
            $table->string('title')->nullable();
            $table->integer('rating')->nullable();
            $table->text('content')->nullable();
            $table->boolean('approved')->default(false);
            $table->mediumText('metadata')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hounddd_reviews_reviews');
    }
}
