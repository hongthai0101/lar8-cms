<?php

namespace Messi\Base\Traits;

use Exception;
use Illuminate\Support\ServiceProvider;
use ReflectionClass;

/**
 * @mixin ServiceProvider
 */
trait LoadPublishServiceTrait
{
    /**
     * @var string
     */
    protected $namespace = null;

    /**
     * @var string
     */
    protected $basePath = null;

    /**
     * @param string $namespace
     * @return $this
     */
    public function setNamespace(string $namespace): self
    {
        $this->namespace = ltrim(rtrim($namespace, '/'), '/');

        return $this;
    }

    /**
     * Publish the given configuration file name (without extension) and the given module
     * @param array|string $fileNames
     * @param string $groups
     * @throws Exception
     */
    public function loadPublishConfigurations(mixed $fileNames, string $groups = 'base-config'): self
    {
        if (!is_array($fileNames)) {
            $fileNames = [$fileNames];
        }
        foreach ($fileNames as $fileName) {
            $this->mergeConfigFrom($this->getConfigFilePath($fileName), $this->getDotedNamespace() . '.' . $fileName);
            if ($this->app->runningInConsole()) {
                $this->publishes([
                    $this->getConfigFilePath($fileName) => config_path($this->getDashedNamespace() . '/' . $fileName . '.php'),
                ], $groups);
            }
        }

        return $this;
    }

    /**
     * Get path of the give file name in the given module
     * @param string $file
     * @return string
     * @throws Exception
     */
    protected function getConfigFilePath($file): string
    {
        $file = $this->getBasePath() . $this->getDashedNamespace() . '/config/' . $file . '.php';

        if (!file_exists($file)) {
            $this->throwInvalidPluginError();
        }

        return $file;
    }

    /**
     * @return string
     */
    public function getBasePath(): string
    {
        return $this->basePath ?? base_path('packages/');
    }

    /**
     * @param string $path
     * @return $this
     */
    public function setBasePath($path): self
    {
        $this->basePath = $path;

        return $this;
    }

    /**
     * @return string
     */
    protected function getDashedNamespace(): string
    {
        return str_replace('.', '/', $this->namespace);
    }

    /**
     * @return string
     */
    protected function getDotedNamespace(): string
    {
        return str_replace('/', '.', $this->namespace);
    }

    /**
     * Publish the given configuration file name (without extension) and the given module
     * @param array $fileNames
     * @return self
     */
    public function loadRoutes(array $fileNames = ['web']): self
    {
        if (!is_array($fileNames)) {
            $fileNames = [$fileNames];
        }

        foreach ($fileNames as $fileName) {
            $this->loadRoutesFrom($this->getRouteFilePath($fileName));
        }

        return $this;
    }

    /**
     * @param string $file
     * @return string
     */
    protected function getRouteFilePath(string $file): string
    {
        $file = $this->getBasePath() . $this->getDashedNamespace() . '/routes/' . $file . '.php';

        if (!file_exists($file)) {
            $this->throwInvalidPluginError();
        }

        return $file;
    }

    /**
     * @return $this
     */
    public function loadPublishViews(): self
    {
        $this->loadViewsFrom($this->getViewsPath(), $this->getDashedNamespace());
        if ($this->app->runningInConsole()) {
            $this->publishes([$this->getViewsPath() => resource_path('views/vendor/' . $this->getDashedNamespace())],
                'base-views');
        }

        return $this;
    }

    /**
     * @return string
     */
    protected function getViewsPath(): string
    {
        return $this->getBasePath() . $this->getDashedNamespace() . '/resources/views/';
    }

    /**
     * @return $this
     */
    public function loadAndPublishTranslations(): self
    {
        $this->loadTranslationsFrom($this->getTranslationsPath(), $this->getDashedNamespace());
        $this->publishes([$this->getTranslationsPath() => resource_path('lang/vendor/' . $this->getDashedNamespace())],
            'base-lang');

        return $this;
    }

    /**
     * @return string
     */
    protected function getTranslationsPath(): string
    {
        return $this->getBasePath() . $this->getDashedNamespace() . '/resources/lang/';
    }

    /**
     * @return $this
     */
    public function loadMigrations(): self
    {
        $this->loadMigrationsFrom($this->getMigrationsPath());

        return $this;
    }

    /**
     * @return string
     */
    protected function getMigrationsPath(): string
    {
        return $this->getBasePath() . $this->getDashedNamespace() . '/database/migrations/';
    }

    /**
     * @param string|null $path
     * @return $this
     */
    public function publishAssets($path = null): self
    {
        if ($this->app->runningInConsole()) {
            if (empty($path)) {
                $path = 'vendor/' . $this->getDashedNamespace();
            }
            $this->publishes([$this->getAssetsPath() => public_path($path)], 'base-public');
        }

        return $this;
    }

    /**
     * @return string
     */
    protected function getAssetsPath(): string
    {
        return $this->getBasePath() . $this->getDashedNamespace() . '/public/';
    }

    /**
     * @param null $path
     * @return LoadPublishServiceTrait
     */
    public function publishSeeders($path = null) : self
    {
        if ($this->app->runningInConsole()) {
            if (empty($path)) {
                $path = database_path('seeders');
            }
            $this->publishes([$this->getSeedersPath() => $path], 'base-seeder');
        }

        return $this;
    }

    /**
     * @return string
     */
    protected function getSeedersPath(): string
    {
        return $this->getBasePath() . $this->getDashedNamespace() . '/database/seeders/';
    }

    /**
     * @throws Exception
     */
    protected function throwInvalidPluginError()
    {
        $reflection = new ReflectionClass($this);

        $from = str_replace('/src/Providers', '', dirname($reflection->getFilename()));
        $from = str_replace(base_path(), '', $from);

        $to = $this->getBasePath() . $this->getDashedNamespace();
        $to = str_replace(base_path(), '', $to);

        if ($from != $to) {
            throw new Exception(sprintf('Plugin folder is invalid. Need to rename folder %s to %s', $from, $to));
        }
    }
}
