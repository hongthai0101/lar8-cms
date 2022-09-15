<?php

namespace Messi\Base\Supports;


use File;

/**
 * Class Cache
 * @package Elidev\LaravelSettings
 */
class Cache
{

    /**
     * Path to cache file
     *
     * @var string
     */
    protected $cacheFile;

    /**
     * Cached Settings
     *
     * @var array
     */
    protected $settings;


    /**
     * Constructor
     *
     * @param string $cacheFile
     */
    public function __construct($cacheFile)
    {
        $this->cacheFile = storage_path($cacheFile);
        $this->checkCacheFile();

        $this->settings = $this->getAll();
    }

    /**
     * Sets a value
     *
     * @param $key
     * @param $value
     *
     * @return mixed
     */
    public function set($key, $value)
    {
        $this->settings[$key] = $value;
        $this->store();

        return $value;
    }

    /**
     * Gets a value
     *
     * @param      $key
     * @param null $default
     *
     * @return mixed
     */
    public function get($key, $default = null)
    {
        return (array_key_exists($key, $this->settings) ? $this->settings[$key] : $default);
    }

    /**
     * Checks if $key is cached
     *
     * @param $key
     *
     * @return bool
     */
    public function hasKey($key)
    {
        return array_key_exists($key, $this->settings);
    }

    /**
     * Gets all cached settings
     *
     * @return array
     */
    public function getAll()
    {
        $values = json_decode(File::get($this->cacheFile), true);

        $result = [];
        if ($values) {
            foreach ($values as $key => $value) {
                $result[$key] = unserialize($value);
            }
        }
        return $result;
    }

    /**
     * Stores all settings to the cache file
     *
     * @return void
     */
    private function store()
    {
        $settings = [];
        foreach ($this->settings as $key => $value) {
            $settings[$key] = serialize($value);
        }
        File::put($this->cacheFile, json_encode($settings));
    }

    /**
     * Removes a value
     *
     * @return void
     */
    public function forget($key)
    {
        if (array_key_exists($key, $this->settings)) {
            unset($this->settings[$key]);
        }
        $this->store();
    }

    /**
     * Removes all values
     *
     * @return void
     */
    public function flush()
    {
        // Create master, default, or client id folder
        if (!is_dir(dirname($this->cacheFile, 2))) {
            File::makeDirectory(dirname($this->cacheFile, 2));
        }

        // Create storage folder
        if (!is_dir(dirname($this->cacheFile))) {
            File::makeDirectory(dirname($this->cacheFile));
        }

        File::put($this->cacheFile, json_encode([]));
        // fixed the set after immediately the flush, should be returned empty
        $this->settings = [];
    }

    /**
     * Checks if the cache file exists and creates it if not
     *
     * @return void
     */
    private function checkCacheFile()
    {
        if (! File::exists($this->cacheFile) ) {
            $this->flush();
        }
    }
}