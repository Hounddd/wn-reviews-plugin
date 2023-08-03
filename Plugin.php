<?php namespace Hounddd\Reviews;

use Backend;
use Backend\Models\UserRole;
use System\Classes\PluginBase;

/**
 * Reviews Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     */
    public function pluginDetails(): array
    {
        return [
            'name'        => 'hounddd.reviews::lang.plugin.name',
            'description' => 'hounddd.reviews::lang.plugin.description',
            'author'      => 'Hounddd',
            'icon'        => 'icon-star-half-o'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     */
    public function register(): void
    {

    }

    /**
     * Boot method, called right before the request route.
     */
    public function boot(): void
    {

    }

    /**
     * Registers any frontend components implemented in this plugin.
     */
    public function registerComponents(): array
    {
        return [
            'Hounddd\Reviews\Components\Reviews' => 'reviews',
            'Hounddd\Reviews\Components\ReviewsSlider' => 'reviewsSlider',
        ];
    }

    /**
     * Registers frontend components as a snippet for Static Pages plugin.
     */
    public function registerPageSnippets(): array
    {
        return [
            'Hounddd\Reviews\Components\Reviews' => 'reviews',
        ];
    }

    /**
     * Registers any backend permissions used by this plugin.
     */
    public function registerPermissions(): array
    {
        return [
            'hounddd.reviews.manage_reviews' => [
                'tab' => 'hounddd.reviews::lang.plugin.name',
                'label' => 'hounddd.reviews::lang.permissions.manage_reviews',
                'roles' => [UserRole::CODE_DEVELOPER, UserRole::CODE_PUBLISHER],
            ],
            'hounddd.reviews.manage_categories' => [
                'tab' => 'hounddd.reviews::lang.plugin.name',
                'label' => 'hounddd.reviews::lang.permissions.manage_categories',
                'roles' => [UserRole::CODE_DEVELOPER, UserRole::CODE_PUBLISHER],
            ],
        ];
    }

    /**
     * Registers backend navigation items for this plugin.
     */
    public function registerNavigation(): array
    {
        return [
            'reviews' => [
                'label'       => 'hounddd.reviews::lang.plugin.name',
                'url'         => Backend::url('hounddd/reviews/reviews'),
                'icon'        => 'icon-star-half-o',
                'permissions' => ['hounddd.reviews.*'],
                'order'       => 500,

                'sideMenu' => [
                    'reviews' => [
                        'label' => 'hounddd.reviews::lang.models.review.label_plural',
                        'url' => Backend::url('hounddd/reviews/reviews'),
                        'icon' => 'icon-star-half-o',
                        'permissions' => ['hounddd.reviews.manage_reviews'],
                        'order' => 100,
                    ],
                    'categories' => [
                        'label' => 'hounddd.reviews::lang.models.category.label_plural',
                        'url' => Backend::url('hounddd/reviews/categories'),
                        'icon' => 'icon-list-ul',
                        'permissions' => ['hounddd.reviews.manage_categories'],
                        'order' => 200,
                    ],
                ],
            ],
        ];
    }

    /**
     * Register backend form widgets
     */
    public function registerFormWidgets(): array
    {
        return [
            'Hounddd\Reviews\FormWidgets\StarRating' => 'starrating',
        ];
    }

    /**
     * Register custom list column types
     */
    public function registerListColumnTypes(): array
    {
        return [
            'starrating' => function($value) { return str_repeat('&starf;', $value); }
        ];
    }
}
