<?php
namespace Messi\Blog\Models;


use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Messi\Base\Models\BaseModel;
use Messi\Base\Traits\ModelTrait;
use Messi\Base\Traits\Sluggable;

class Tag extends BaseModel
{
    use ModelTrait, Sluggable;
    /**
     * The date fields for the model.clear
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'status',
        'created_id',
        'updated_id',
    ];

    /**
     * @return BelongsToMany
     */
    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'post_tags');
    }
}