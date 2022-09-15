<?php
namespace Messi\Base\Models;

use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($query) {
            if ( in_array('created_id', $query->fillable) ) {
                $query->created_id = auth()->id();
            }
            if (in_array('updated_id', $query->fillable)) {
                $query->updated_id = auth()->id();
            }
        });

        static::updating(function ($query) {
            if (in_array('updated_id', $query->fillable)) {
                $query->updated_id = auth()->id();
            }
        });
    }
}