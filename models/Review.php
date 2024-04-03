<?php namespace Hounddd\Reviews\Models;

use Model;
use Hounddd\Reviews\Components\BaseReviewsComponent;
use Winter\Storm\Database\Builder;
use System\Models\File;

/**
 * Review Model
 */
class Review extends Model
{
    use \Winter\Storm\Database\Traits\Validation;
    use \Winter\Storm\Database\Traits\SoftDelete;
    use \Winter\Storm\Database\Traits\Sortable;

    public $implement = ['@Winter.Translate.Behaviors.TranslatableModel'];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'hounddd_reviews_reviews';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [
        'email',
        'name',
        'title',
        'rating',
        'content',
        'approved',
    ];

    /**
     * @var array Validation rules for attributes
     */
    public $rules = [
        'name' => 'required',
        'email' => 'email',
        'rating' => 'nullable',
        'approved' => 'boolean',
        'content' => 'required',
    ];

    /**
     * @var array Attributes that support translation, if available.
     */
    public $translatable = [
        'name',
        'title',
        'content',
        'metadata',
    ];

    /**
     * @var array Attributes to be cast to native types
     */
    protected $casts = [];

    /**
     * @var array Attributes to be cast to JSON
     */
    protected $jsonable = ['metadata'];

    /**
     * @var array Attributes to be appended to the API representation of the model (ex. toArray())
     */
    protected $appends = [];

    /**
     * @var array Attributes to be removed from the API representation of the model (ex. toArray())
     */
    protected $hidden = [];

    /**
     * @var array Attributes to be cast to Argon (Carbon) instances
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $hasOneThrough = [];
    public $hasManyThrough = [];
    public $belongsTo = [];
    public $belongsToMany = [
        'categories' => [
            Category::class,
            'table' => 'hounddd_reviews_reviews_categories',
            'order' => 'name asc',
            'scope' => 'isEnabled',
            // 'timestamps' => true,
        ]
    ];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [
        'avatar'  => [
            File::class,
        ],
    ];
    public $attachMany = [];



    //
    // Scopes
    //

    /**
     * Scope - Approved reviews.
     */
    public function scopeIsApproved(\Winter\Storm\Database\Builder $query): \Winter\Storm\Database\Builder
    {
        return $query->where('approved', true);
    }

    /**
     * Scope - Not approved reviews.
     */
    public function scopeNotApproved(\Winter\Storm\Database\Builder $query): \Winter\Storm\Database\Builder
    {
        return $query->where('approved', false);
    }


    /**
     * Lists reviews for the frontend
     */
    public function scopeListFrontEnd($query, array $options = []): Builder
    {
        /*
         * Default options
         */
        extract(array_merge([
            'sort'             => 'created_desc',
            'featuredFirst'    => false,
            'category'         => null,
            'approved'         => true
        ], $options));

        if ($approved) {
            $query->isApproved();
        }

        /*
         * Featuring
         */
        if ($featuredFirst) {
            $query->orderBy('featured', 'desc');
        }

        /*
         * Sorting
         */
        if (in_array($sort, array_keys(BaseReviewsComponent::$allowedSortingOptions))) {
            if ($sort == 'random') {
                $query->inRandomOrder();
            } else {
                @list($sortField, $sortDirection) = explode(' ', $sort);

                if (is_null($sortDirection)) {
                    $sortDirection = "desc";
                }

                $query->orderBy($sortField, $sortDirection);
            }
        }

        /*
         * Category, including children
         */
        if ($category !== null) {
            $category = Category::find($category);

            $categories = $category->getAllChildrenAndSelf()->lists('id');
            $query->whereHas('categories', function($q) use ($categories) {
                $q->withoutGlobalScope(NestedTreeScope::class)->whereIn('id', $categories);
            });
        }

        return $query;
    }
}
