<?php namespace Hounddd\Reviews\Models;

use Model;
use Str;

/**
 * Category Model
 */
class Category extends Model
{
    use \Winter\Storm\Database\Traits\Validation;
    use \Winter\Storm\Database\Traits\SoftDelete;
    use \Winter\Storm\Database\Traits\Sortable;

    public $implement = [
        '@Winter.Translate.Behaviors.TranslatableModel'
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'hounddd_reviews_categories';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Validation rules for attributes
     */
    public $rules = [
        'name' => 'required|max:255',
        'slug' => 'required|unique:hounddd_reviews_categories',
        'enabled' => 'boolean',
        'description' => 'max:10000',
    ];

    /**
     * @var array Attributes that support translation, if available.
     */
    public $translatable = [
        'name',
        'description',
        ['slug', 'index' => true],
    ];

    /**
     * @var array Attributes to be cast to native types
     */
    protected $casts = [];

    /**
     * @var array Attributes to be cast to JSON
     */
    protected $jsonable = [];

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
        'reviews' => [
            Review::class,
            'table' => 'hounddd_reviews_reviews_categories',
            'order' => 'published_at desc',
            'scope' => 'isPublished',
        ],
        'reviews_count' => [
            Review::class,
            'table' => 'hounddd_reviews_reviews_categories',
            'scope' => 'isPublished',
            'count' => true,
        ]
    ];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];


    public function beforeValidate()
    {
        // Generate a URL slug for this model
        if (!$this->exists && !$this->slug) {
            $this->slug = Str::slug($this->name);
        }
    }

    public function afterDelete()
    {
        $this->reviews()->detach();
    }

    /**
     * Returns the number of reviews in this category
     */
    public function getReviewCountAttribute(): int
    {
        return optional($this->reviews_count->first())->count ?? 0;
    }


    //
    // Scopes
    //

    /**
     * Undocumented function
     */
    public function scopeIsEnabled(\Winter\Storm\Database\Builder $query): \Winter\Storm\Database\Builder
    {
        return $query->where('enabled', true);
    }
}
