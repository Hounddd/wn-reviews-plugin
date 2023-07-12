<?php namespace Hounddd\Reviews\Tests;

use Hounddd\Reviews\Models\Category;
use System\Tests\Bootstrap\PluginTestCase;

class CategoryModelTest extends PluginTestCase
{
    public function testGetFirstCategory(): void
    {
        $category = Category::find(1);
        $this->assertEquals(1, $category->id);
    }

    public function testCreateFirstCategory(): void
    {
        $category = Category::create(['name' => 'A test category']);
        $this->assertEquals(2, $category->id);
    }
}
