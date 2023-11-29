<?php namespace Hounddd\Reviews\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

return new class extends Migration
{
    public function up()
    {
        if (Schema::hasColumn('hounddd_reviews_reviews', 'date')) {
            return;
        }

        Schema::table('hounddd_reviews_reviews', function ($table) {
            $table->date('date')->after('rating')->nullable();
        });
    }

    public function down()
    {
        if (Schema::hasColumn('hounddd_reviews_reviews', 'date')) {
            Schema::table('hounddd_reviews_reviews', function ($table) {
                $table->dropColumn('date');
            });
        }
    }
};
