<?php

namespace Messi\Media\Providers;

use Messi\Base\Traits\LoadPublishServiceTrait;
use Messi\Media\Chunks\Storage\ChunkStorage;
use Messi\Media\Commands\ClearChunksCommand;
use Messi\Media\Commands\DeleteThumbnailCommand;
use Messi\Media\Commands\GenerateThumbnailCommand;
use Messi\Media\Facades\MediaFacade;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Messi\Media\Repositories\Eloquent\MediaFileRepository;
use Messi\Media\Repositories\Eloquent\MediaFolderRepository;
use Messi\Media\Repositories\Eloquent\MediaSettingRepository;
use Messi\Media\Repositories\Interfaces\MediaFileInterface;
use Messi\Media\Repositories\Interfaces\MediaFolderInterface;
use Messi\Media\Repositories\Interfaces\MediaSettingInterface;

/**
 * @since 02/07/2016 09:50 AM
 */
class MediaServiceProvider extends ServiceProvider
{
    use LoadPublishServiceTrait;

    /**
     * @var bool
     */
    protected $defer = true;

    public function register()
    {
        $this->app->bind(MediaFileInterface::class, MediaFileRepository::class);
        $this->app->bind(MediaFolderInterface::class, MediaFolderRepository::class);
        $this->app->bind(MediaSettingInterface::class, MediaSettingRepository::class);

        AliasLoader::getInstance()->alias('Media', MediaFacade::class);
    }

    public function boot()
    {
        $this->setNamespace('core/media')
            ->loadPublishConfigurations(['permissions', 'media'])
            ->loadMigrations()
            ->loadAndPublishTranslations()
            ->loadPublishViews()
            ->loadRoutes()
            ->publishAssets();

        $this->commands([
            GenerateThumbnailCommand::class,
            DeleteThumbnailCommand::class,
            ClearChunksCommand::class,
        ]);

        $this->app->booted(function () {
            if ($this->app->make('config')->get('core.media.media.chunk.clear.schedule.enabled')) {
                $schedule = $this->app->make(Schedule::class);

                $schedule->command('cms:media:chunks:clear')
                    ->cron($this->app->make('config')->get('core.media.media.chunk.clear.schedule.cron'));
            }
        });

        $this->app->singleton(ChunkStorage::class, function () {
            return new ChunkStorage;
        });
    }
}
