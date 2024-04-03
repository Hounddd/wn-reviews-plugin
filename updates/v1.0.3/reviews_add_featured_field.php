<?php namespace Hounddd\Reviews\Updates;

use Hounddd\Reviews\Models\Review;
use Schema;
use Winter\Storm\Database\Updates\Migration;

return new class extends Migration
{
    public function up()
    {
        if (Schema::hasColumn('hounddd_reviews_reviews', 'featured')) {
            return;
        }

        Schema::table('hounddd_reviews_reviews', function ($table) {
            $table->boolean('featured')->after('rating')->nullable()->default(false);
        });
    }

    public function down()
    {
        if (Schema::hasColumn('hounddd_reviews_reviews', 'featured')) {
            Schema::table('hounddd_reviews_reviews', function ($table) {
                $table->dropColumn('featured');
            });
        }
    }
};
