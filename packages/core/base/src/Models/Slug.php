<?php

namespace Messi\Base\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Slug extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'key',
        'reference_type',
        'reference_id',
        'prefix',
    ];

    public $timestamps = false;

    /**
     * @return BelongsTo
     */
    public function reference()
    {
        return $this->morphTo();
    }
}