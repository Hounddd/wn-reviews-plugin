<?php namespace Hounddd\Reviews\Components;

use Lang;
use BackendAuth;
use Cms\Classes\ComponentBase;
use Hounddd\Reviews\Models\Category as reviewCategory;
use Hounddd\Reviews\Models\Review;
use Illuminate\Pagination\LengthAwarePaginator;
use Winter\Storm\Database\Collection;


abstract class BaseReviewsComponent extends ComponentBase
{
    /**
     * The attributes on which the post list can be ordered.
     * @var array
     */
    public static $allowedSortingOptions = [
        'title asc'       => 'hounddd.reviews::lang.sorting.title_asc',
        'title desc'      => 'hounddd.reviews::lang.sorting.title_desc',
        'rating asc'      => 'hounddd.reviews::lang.sorting.rating_asc',
        'rating desc'     => 'hounddd.reviews::lang.sorting.rating_desc',
        'date asc'        => 'hounddd.reviews::lang.sorting.date_asc',
        'date desc'       => 'hounddd.reviews::lang.sorting.date_desc',
        'sort_order asc'  => 'hounddd.reviews::lang.sorting.sort_order_asc',
        'sort_order desc' => 'hounddd.reviews::lang.sorting.sort_order_desc',
        'random'          => 'hounddd.reviews::lang.sorting.random',
        'created_at asc'  => 'hounddd.reviews::lang.sorting.created_asc',
        'created_at desc' => 'hounddd.reviews::lang.sorting.created_desc',
        'updated_at asc'  => 'hounddd.reviews::lang.sorting.updated_asc',
        'updated_at desc' => 'hounddd.reviews::lang.sorting.updated_desc',
    ];

    /**
     * The attributes on which the post list can be ordered.
     * @var array
     */
    public static $ratingDisplayOptions = [
        'none'  => 'hounddd.reviews::lang.components.general.rating_display_types.none',
        'stars' => 'hounddd.reviews::lang.components.general.rating_display_types.stars',
        'text'  => 'hounddd.reviews::lang.components.general.rating_display_types.text',
        'both'  => 'hounddd.reviews::lang.components.general.rating_display_types.both',
    ];

    /**
     * Collection of reviews to display
     */
    public LengthAwarePaginator|Collection|null  $reviews;

    /**
     * If the review list should be filtered by a category, the model to use
     */
    public ?reviewCategory $category;

    /**
     * Message to display when there are no reviews
     */
    public ?string $noReviewsMessage;

    /**
     * Rating display type
     */
    public ?string $ratingDisplay;

    /**
     * Display featured reviews first
     */
    public ?bool $featuredFirst;

    /**
     * Returns the properties provided by the component
     */
    public function getDefaultProperties(): array
    {
        return [
            'categoryFilter' => [
                'title'       => 'hounddd.reviews::lang.components.general.category_filter',
                'description' => 'hounddd.reviews::lang.components.general.category_filter_description',
                'type'        => 'string',
                'default'     => '',
            ],
            'noReviewsMessage' => [
                'title'             => 'hounddd.reviews::lang.components.general.no_reviews',
                'description'       => 'hounddd.reviews::lang.components.general.no_reviews_description',
                'type'              => 'string',
                'default'           => Lang::get('hounddd.reviews::lang.components.general.no_reviews_default'),
                'showExternalParam' => false,
            ],
            'sortOrder' => [
                'title'       => 'hounddd.reviews::lang.components.general.order',
                'description' => 'hounddd.reviews::lang.components.general.order_description',
                'type'        => 'dropdown',
                'default'     => 'created_at desc',
            ],
            'featuredFirst' => [
                'title'       => 'hounddd.reviews::lang.components.general.featured_first',
                'description' => 'hounddd.reviews::lang.components.general.featured_first_description',
                'type'        => 'checkbox',
                'default'     => 0,
            ],
            'ratingDisplay' => [
                'title'   => 'hounddd.reviews::lang.components.general.rating_display',
                'type'    => 'dropdown',
                'default' => 'both',
                'group'   => 'hounddd.reviews::lang.components.general.group_display',
            ],
        ];
    }

    public function getSortOrderOptions()
    {
        $options = static::$allowedSortingOptions;

        foreach ($options as $key => $value) {
            $options[$key] = Lang::get($value);
        }

        return $options;
    }

    public function getRatingDisplayOptions()
    {
        $options = static::$ratingDisplayOptions;

        foreach ($options as $key => $value) {
            $options[$key] = Lang::get($value);
        }

        return $options;
    }

    public function onRun()
    {
        $this->prepareVars();

        $this->ratingDisplay = $this->page['ratingDisplay'] = $this->property('ratingDisplay');
        $this->featuredFirst = $this->page['featuredFirst'] = $this->property('featuredFirst');

        $this->category = $this->page['category'] = $this->loadCategory();
        $this->reviews = $this->page['reviews'] = $this->listReviews();
    }

    protected function loadCategory(): ?reviewCategory
    {
        if (!$slug = $this->property('categoryFilter')) {
            return null;
        }

        $category = new reviewCategory;

        $category = $category->isClassExtendedWith('Winter.Translate.Behaviors.TranslatableModel')
            ? $category->transWhere('slug', $slug)
            : $category->where('slug', $slug);

        $category = $category->first();

        return $category ?: null;
    }

    protected function checkEditor()
    {
        $backendUser = BackendAuth::getUser();

        return $backendUser; // && $backendUser->hasAccess('winter.blog.access_reviews') && BlogSettings::get('show_all_reviews', true);
    }
}
