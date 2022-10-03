<?php
namespace Messi\Base\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Messi\Base\Models\MetaBox as Eloquent;
use Messi\Base\Repositories\Contracts\MetaBoxRepository;

trait MetaBox
{
    private static string $metaSeo = 'seo';

    protected static function bootMetaBox(): void
    {
        static::saved(function ($model) {
            static::storeMetaBox($model);
        });

        static::deleted(function ($model) {
            static::deleteMetaBox($model);
        });
    }

    /**
     * @param Model $model
     */
    protected static function storeMetaBox(Model $model)
    {
        if ($metaSeo = request()->seo) {
            /** @var MetaBoxRepository $metaBoxRepo */
            $metaBoxRepo = app(MetaBoxRepository::class);

            $metaBoxRepo->createOrUpdate([
                'key' => self::$metaSeo,
                'data' => $metaSeo,
                'reference_id' => $model->id,
                'reference_type' => get_class($model)
            ], [
                'reference_id' => $model->id,
                'reference_type' => get_class($model)
            ]);
        }
    }

    /**
     * @param Model $model
     */
    protected static function deleteMetaBox(Model $model)
    {
        /** @var MetaBoxRepository $metaBoxRepo */
        $metaBoxRepo = app(MetaBoxRepository::class);
        $metaBoxRepo->deleteBy([
            'reference_id' => $model->id,
            'reference_type' => get_class($model)
        ]);
    }

    /**
     * @return HasOne
     */
    public function metaSeo(): HasOne
    {
        return $this->hasOne(Eloquent::class, 'reference_id')->where([
            'reference_type' => __CLASS__,
            'key' => self::$metaSeo
        ]);
    }
}
