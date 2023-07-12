<?php namespace Hounddd\Reviews\Tests;

use Hounddd\Reviews\Models\Category;
use Hounddd\Reviews\Models\Review;
use System\Tests\Bootstrap\PluginTestCase;

class ReviewModelTest extends PluginTestCase
{
    public function testCreateFirstReview(): Review
    {
        $review = Review::create([
            'email' => 'tony@stark-industries.com',
            'name' => 'Tony Stark',
            'title' => 'Awesome service',
            'rating' => 5,
            'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit, laborum.',
            'approved' => true,
        ]);

        $this->assertEquals(1, Review::count());
        $this->assertEquals(1, $review->id);
        $this->assertNull($review->deleted_at);
        $this->assertIsBool($review->approved);

        return $review;
    }

    /**
     * @depends testCreateFirstReview
     */
    public function testAssignCategoryToReview(Review $review): Review
    {
        $category = Category::find(1);
        $review->categories()->add($category);

        // Test relationship
        $this->assertInstanceOf(Category::class, $review->categories->first());

        return $review;
    }

    /**
     * @depends testAssignCategoryToReview
     */
    public function testSoftDeleteReview(Review $review): void
    {
        $review->delete();

        $this->assertNotNull($review->deleted_at);
        $this->assertInstanceOf('Winter\Storm\Argon\Argon', $review->deleted_at);
    }
}
