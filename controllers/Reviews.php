<?php namespace Hounddd\Reviews\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Reviews Backend Controller
 */
class Reviews extends Controller
{
    /**
     * @var array Behaviors that are implemented by this controller.
     */
    public $implement = [
        \Backend\Behaviors\FormController::class,
        \Backend\Behaviors\ListController::class,
    ];

    public $requiredPermissions = ['hounddd.reviews.manage_reviews'];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Hounddd.Reviews', 'reviews', 'reviews');

        $this->bodyClass = 'compact-container';
    }
}
