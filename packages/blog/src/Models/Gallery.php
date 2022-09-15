<?php
namespace Messi\Blog\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Messi\Base\Models\BaseModel;
use Messi\Base\Traits\ModelTrait;
use Messi\Base\Traits\MetaBox;
use Messi\Base\Traits\Sluggable;

class Gallery extends BaseModel
{
    use SoftDeletes, ModelTrait, MetaBox, Sluggable;

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
        'thumbnail',
        'is_featured',
        'status',
        'created_id',
        'updated_id',
        'values'
    ];

    protected $casts = [
        'values' => 'array'
    ];

    /**
     * @deprecated
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault();
    }
}