<?php

return [
    'plugin' => [
        'name' => 'Reviews',
        'description' => 'Customer reviews and testimonials',
    ],
    'permissions' => [
        'manage_reviews' => 'Manage reviews and testimonials',
        'manage_categories' => 'Manage categories',
    ],
    'models' => [
        'general' => [
            'id' => 'ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
            'enabled' => 'Enabled',
            'name' => 'Name',
            'slug' => 'Slug',
            'title' => 'Title',
        ],
        'review' => [
            'label' => 'Review',
            'label_plural' => 'Reviews',
            'approved' => 'Approved',
            'approved_comment' => 'only approved reviews are publicly visible',
            'avatar' => 'Avatar',
            'content' => 'Content',
            'email' => 'Email',
            'rating' => 'Rating',
        ],
        'category' => [
            'label' => 'Category',
            'label_plural' => 'Categories',
            'description' => 'Description',
            'sort_order' => 'Sort order',
        ],
    ],
    'components' => [
        'general' => [
            'category_filter' => 'Category filter',
            'category_filter_description' => 'Enter a category slug or URL parameter to filter the reviews by. Leave empty to show all reviews.',
            'group_display' => 'Display',
            'no_reviews' => 'No reviews message',
            'no_reviews_description' => 'Message to display in the review list in case if there are no reviews. This property is used by the default component partial.',
            'no_reviews_default' => 'No reviews found',
            'order' => 'Review order',
            'order_description' => 'Attribute on which the reviews should be ordered',
            'rating' => '{1} :value star out of :stars|[2,*] :value stars out of :stars',
            'rating_display' => 'Rating display',
            'star' => 'star',
            'rating_display_types' => [
                'none' => 'None',
                'stars' => 'Stars only',
                'text' => 'Text only',
                'both' => 'Both stars and text',
            ],
        ],
        'reviews' => [
            'name' => 'Reviews',
            'description' => 'Show a paginated list of reviews',
            'pagination' => 'Page number',
            'pagination_description' => 'This value is used to determine what page the user is on.',
            'per_page' => 'Reviews per page',
            'per_page_validation' => 'Invalid format of the reviews per page value',
        ],
        'reviews_slider' => [
            'name' => 'Reviews slider',
            'description' => 'Show reviews in a slider',
            'auto_play' => 'Auto play delay (in s)',
            'auto_play_description' => 'Slide to next reviews after X seconds. If set to 0, auto play will be disable.',
            'auto_play_validation' => 'Invalid format of the auto play delay value',
            'loadScripts' => 'Load requested scripts',
            'slider_type' => 'Slider type',
            'show_controls' => 'Show slider control buttons',
            'show_counter' => 'Show slider counter',
            'show_dots' => 'Show slider dots',
            'types' => [
                'tiny_slider' => 'Tiny Slider 2',
                'tailwind_alpine' => 'Alpine JS & Tailwind CSS',
            ],
        ],
    ],
    'tabs' => [
        'general' => 'General',
        'categories' => 'Categories',
    ],
    'sorting' => [
        'title_asc' => 'Title (ascending)',
        'title_desc' => 'Title (descending)',
        'created_asc' => 'Created (ascending)',
        'created_desc' => 'Created (descending)',
        'updated_asc' => 'Updated (ascending)',
        'updated_desc' => 'Updated (descending)',
        'rating_asc' => 'Rating (ascending)',
        'rating_desc' => 'Rating (descending)',
        'random' => 'Random'
    ],
    'seeds' => [
        'general' => 'General',
    ],
];
