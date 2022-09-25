<?php
namespace Messi\Base\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\ArrayShape;
use Messi\Base\Models\Slug as Eloquent;
use Messi\Base\Repositories\Contracts\SlugRepository;

trait Sluggable
{
    /**
     * override eloquent method boot
     */
    protected static function bootSluggable(): void
    {
        static::saved(function ($model) {
            self::storeSlug($model);
        });

        static::deleted(function ($model) {
            self::deleteSlug($model);
        });
    }

    /**
     * @return array
     */
    #[ArrayShape(['source' => "string"])]
    protected function sluggable(): array
    {
        return [
            'source' => 'title'
        ];
    }

    /**
     * @param Model $model
     */
    protected static function storeSlug(Model $model)
    {
        $settings = $model->sluggable();
        if ($source = Arr::get($settings, 'source')) {
            /** @var SlugRepository $slugRepo */
            $slugRepo = app(SlugRepository::class);

            $slugRepo->createOrUpdate([
                'key' => self::generateSlug($slugRepo, Str::slug($model->{$source})),
                'reference_id' => $model->id,
                'reference_type' => get_class($model)
            ], [
                'reference_id' => $model->id,
                'reference_type' => get_class($model)
            ]);
        }
    }

    /**
     * @param SlugRepository $slugRepo
     * @param string $slug
     * @return string
     */
    public static function generateSlug(SlugRepository $slugRepo, string $slug): string
    {
        while ($slugRepo->count(['key' => $slug]) !== 0) {
            $slug .= strtolower(Str::random(3));
        }
        return $slug;
    }

    /**
     * @param Model $model
     */
    protected static function deleteSlug(Model $model): void
    {
        /** @var SlugRepository $slugRepo */
        $slugRepo = app(SlugRepository::class);
        $slugRepo->deleteBy([
            'reference_id' => $model->id,
            'reference_type' => get_class($model)
        ]);
    }

    /**
     * @return HasOne
     */
    public function slugRelation() : HasOne
    {
        return $this->hasOne(Eloquent::class, 'reference_id')->where([
            'reference_type' => __CLASS__
        ]);
    }

    /**
     * @return mixed
     */
    public function getSlugAttribute(): mixed
    {
        $slug = $this->slugRelation;
        return $slug->key;
    }
}
