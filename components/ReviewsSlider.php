<?php namespace Hounddd\Reviews\Components;

use Lang;
use Hounddd\Reviews\Components\BaseReviewsComponent;
use Hounddd\Reviews\Models\Review;
use Winter\Storm\Database\Collection;

class ReviewsSlider extends BaseReviewsComponent
{
    /**
     * Max reviews to display
     */
    public ?int $maxReviews;

    /**
     * Type of slider to use
     */
    public ?string $sliderType;

    /**
     * Show the slider control buttons
     */
    public ?bool $showControls;

    /**
     * Show the slider counter
     */
    public ?bool $showCounter;

    /**
     * Show the slider dots that represent reviews
     */
    public ?bool $showDots;

    /**
     * Auto play delay to slide to next review
     */
    public ?string $autoPlay;

    /**
     * Requested vendor scripts need to be load
     */
    public ?bool $loadScripts;

    /**
     * The attributes on which the post list can be ordered.
     * @var array
     */
    public static $allowedSliderTypesOptions = [
        'tiny_slider'     => 'hounddd.reviews::lang.components.reviews_slider.types.tiny_slider',
        'tailwind_alpine' => 'hounddd.reviews::lang.components.reviews_slider.types.tailwind_alpine',
    ];

    /**
     * Gets the details for the component
     */
    public function componentDetails()
    {
        return [
            'name'        => 'hounddd.reviews::lang.components.reviews_slider.name',
            'description' => 'hounddd.reviews::lang.components.reviews_slider.description'
        ];
    }

    /**
     * Returns the properties provided by the component
     */
    public function defineProperties()
    {
        return array_merge(
            [
                'sliderType' => [
                    'title'   => 'hounddd.reviews::lang.components.reviews_slider.slider_type',
                    'type'    => 'dropdown',
                    'default' => 'tiny_slider',
                ],
            ],
            parent::getDefaultProperties(),
            [
                'maxReviews' => [
                    'title'             => 'hounddd.reviews::lang.components.reviews_slider.max_reviews',
                    'type'              => 'string',
                    'validationPattern' => '^[0-9]+$',
                    'default'           => 0,
                    'group'             => 'hounddd.reviews::lang.components.general.group_display',
                ],
                'showDots' => [
                    'title'   => 'hounddd.reviews::lang.components.reviews_slider.show_dots',
                    'type'    => 'checkbox',
                    'default' => 0,
                    'group'   => 'hounddd.reviews::lang.components.general.group_display',
                ],
                'showControls' => [
                    'title'   => 'hounddd.reviews::lang.components.reviews_slider.show_controls',
                    'type'    => 'checkbox',
                    'default' => 0,
                    'group'   => 'hounddd.reviews::lang.components.general.group_display',
                ],
                'showCounter' => [
                    'title'   => 'hounddd.reviews::lang.components.reviews_slider.show_counter',
                    'type'    => 'checkbox',
                    'default' => 0,
                    'group'   => 'hounddd.reviews::lang.components.general.group_display',
                ],
                'autoPlay' => [
                    'title'             => 'hounddd.reviews::lang.components.reviews_slider.auto_play',
                    'description'       => 'hounddd.reviews::lang.components.reviews_slider.auto_play_description',
                    'type'              => 'string',
                    'validationPattern' => '^[0-9]+$',
                    'validationMessage' => 'hounddd.reviews::lang.components.reviews_slider.auto_play_validation',
                    'default'           => '0',
                    'group'             => 'hounddd.reviews::lang.components.general.group_display',
                ],
                'loadScripts' => [
                    'title'       => 'hounddd.reviews::lang.components.reviews_slider.lorad_scripts',
                    'description' => 'hounddd.reviews::lang.components.reviews_slider.lorad_scripts_description',
                    'type'        => 'checkbox',
                    'default'     => 1,
                    'group'       => 'hounddd.reviews::lang.components.general.group_display',
                ],
            ]
        );

    }


    public function getSliderTypeOptions()
    {
        $options = self::$allowedSliderTypesOptions;

        foreach ($options as $key => $value) {
            $options[$key] = Lang::get($value);
        }

        return $options;
    }

    public function onRun()
    {
        parent::onRun();

        if ($this->loadScripts && $this->sliderType == 'tiny_slider') {
            $this->addCss([
                '$/hounddd/reviews/assets/vendors/tinyslider/css/styles.css',
                '$/hounddd/reviews/assets/vendors/tinyslider/tinyslider-294.css',
            ]);
            $this->addJs('/plugins/hounddd/reviews/assets/vendors/tinyslider/tinyslider-294.js');
        }

        if ($this->loadScripts && $this->sliderType == 'tailwind_alpine') {
            $this->addJs('/plugins/hounddd/reviews/assets/vendors/alpinejs/aplinejs-3xx.min.js');
        }
    }


    protected function prepareVars()
    {
        $this->maxReviews   = $this->page['maxReviews']   = $this->property('maxReviews');
        $this->sliderType   = $this->page['sliderType']   = $this->property('sliderType');
        $this->showControls = $this->page['showControls'] = $this->property('showControls');
        $this->showCounter  = $this->page['showCounter']  = $this->property('showCounter');
        $this->showDots     = $this->page['showDots']     = $this->property('showDots');
        $this->autoPlay     = $this->page['autoPlay']     = $this->property('autoPlay');
        $this->loadScripts  = $this->page['loadScripts']  = $this->property('loadScripts');

        $this->noReviewsMessage = $this->page['noReviewsMessage'] = $this->property('noReviewsMessage');
    }

    /**
     * Get reviews.
     */
    protected function listReviews(): Collection|null
    {
        $category = $this->category ? $this->category->id : null;

        /*
         * List all the reviews, eager load their categories
         */
        $isApproved = !$this->checkEditor();

        $reviews = Review::with(['categories', 'avatar'])->listFrontEnd([
            'sort'         => $this->property('sortOrder'),
            'featuredFirst' => $this->property('featuredFirst'),
            'category'     => $category,
            'approved'     => $isApproved,
        ])->get();

        if ($this->maxReviews > 0) {
            $reviews = $reviews->take($this->maxReviews);
        }

        return $reviews;
    }
}
