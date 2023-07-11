<?php namespace Hounddd\Reviews\Components;

use Lang;
use Hounddd\Reviews\Components\BaseReviewsComponent;
use Hounddd\Reviews\Models\Review;
use Illuminate\Pagination\LengthAwarePaginator;
use Winter\Storm\Database\Collection;

class Reviews extends BaseReviewsComponent
{
    /**
     * Parameter to use for the page number
     */
    public ?string $pageParam;


    /**
     * Gets the details for the component
     */
    public function componentDetails(): array
    {
        return [
            'name'        => 'hounddd.reviews::lang.components.reviews.name',
            'description' => 'hounddd.reviews::lang.components.reviews.description'
        ];
    }

    /**
     * Returns the properties provided by the component
     */
    public function defineProperties(): array
    {
        return array_merge(
            [
                'pageNumber' => [
                    'title'       => 'hounddd.reviews::lang.components.reviews.pagination',
                    'description' => 'hounddd.reviews::lang.components.reviews.pagination_description',
                    'type'        => 'string',
                    'default'     => '{{ :page }}',
                ],
                'reviewsPerPage' => [
                    'title'             => 'hounddd.reviews::lang.components.reviews.per_page',
                    'type'              => 'string',
                    'validationPattern' => '^[0-9]+$',
                    'validationMessage' => 'hounddd.reviews::lang.components.reviews.per_page_validation',
                    'default'           => '10',
                ],
            ],
            parent::getDefaultProperties()
        );
    }

    protected function prepareVars()
    {
        $this->pageParam = $this->page['pageParam'] = $this->paramName('pageNumber');
        $this->noReviewsMessage = $this->page['noReviewsMessage'] = $this->property('noReviewsMessage');
    }

    /**
     * Get reviews.
     */
    protected function listReviews(): LengthAwarePaginator|Collection|null
    {
        $category = $this->category ? $this->category->id : null;

        /*
         * List all the reviews, eager load their categories
         */
        $isApproved = !$this->checkEditor();

        $reviews = Review::with(['categories', 'avatar'])->listFrontEnd([
            'sort'         => $this->property('sortOrder'),
            'category'     => $category,
            'approved'     => $isApproved,
        ])->paginate($this->property('reviewsPerPage'), $this->property('pageNumber'));

        return $reviews;
    }
}
