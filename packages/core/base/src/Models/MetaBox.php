<?php

namespace Messi\Base\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MetaBox extends Model
{

    protected $fillable = [
        'key', 'data', 'reference_id', 'reference_type'
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'meta_boxes';

    /**
     * @var array
     */
    protected $casts = [
        'data' => 'json',
    ];

    public $timestamps = false;

    /**
     * @return BelongsTo
     */
    public function reference(): BelongsTo
    {
        return $this->morphTo();
    }
}
