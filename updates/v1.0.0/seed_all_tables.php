<?php

namespace Hounddd\Reviews\Updates;

use Carbon\Carbon;
use Hounddd\Reviews\Models\Post;
use Hounddd\Reviews\Models\Category;
use Winter\Storm\Database\Updates\Seeder;

class SeedAllTables extends Seeder
{
    public function run()
    {
        Category::create([
            'name' => trans('hounddd.reviews::lang.seeds.general'),
            // 'slug' => 'general',
        ]);
    }
}
