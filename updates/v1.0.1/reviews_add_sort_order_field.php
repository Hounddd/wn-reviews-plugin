<?php namespace Hounddd\Reviews\Updates;

use Hounddd\Reviews\Models\Review;
use Schema;
use Winter\Storm\Database\Updates\Migration;

return new class extends Migration
{
    public function up()
    {
        if (Schema::hasColumn('hounddd_reviews_reviews', 'sort_order')) {
            return;
        }

        Schema::table('hounddd_reviews_reviews', function ($table) {
            $table->integer('sort_order')->after('approved')->nullable()->unsigned();
        });

        // Set default sorting based on update date
        $reviews = Review::orderBy('updated_at')->get();

        $i = 1;
        $reviews->each(function ($review) use (&$i) {
            $review->update(['sort_order' => $i]);
            $i++;
        });
    }

    public function down()
    {
        if (Schema::hasColumn('hounddd_reviews_reviews', 'sort_order')) {
            Schema::table('hounddd_reviews_reviews', function ($table) {
                $table->dropColumn('sort_order');
            });
        }
    }
};
