<?php namespace Hounddd\Reviews\FormWidgets;

use Backend\Classes\FormWidgetBase;

/**
 * StarRating Form Widget
 */
class StarRating extends FormWidgetBase
{
    //
    // Configurable properties
    //

    /**
     * @var bool Allow reset button
     */
    public $allowReset = false;

    /**
     * @var int Max number of stars
     */
    public $maxStars = 5;

    /**
     * @var string Stars color scheme
     */
    public $color;

    //
    // Object properties
    //

    /**
     * @inheritDoc
     */
    protected $defaultAlias = 'starrating';

    /**
     * @inheritDoc
     */
    public function init()
    {
        $this->fillFromConfig([
            'allowReset',
            'maxStars',
            'color',
        ]);
    }

    /**
     * @inheritDoc
     */
    public function render()
    {
        $this->prepareVars();
        return $this->makePartial('starrating');
    }

    /**
     * Prepares the form widget view data
     */
    public function prepareVars()
    {
        $this->vars['name'] = $this->formField->getName();
        $this->vars['value'] = $this->getLoadValue();
        $this->vars['model'] = $this->model;
        $this->vars['allowReset'] = $this->allowReset;
        $this->vars['maxStars'] = $this->maxStars;
        $this->vars['color'] = $this->color;
    }

    /**
     * @inheritDoc
     */
    public function loadAssets()
    {
        $this->addCss('css/starrating.css', 'Hounddd.Reviews');
    }

    /**
     * @inheritDoc
     */
    public function getSaveValue($value)
    {
        return $value;
    }
}
