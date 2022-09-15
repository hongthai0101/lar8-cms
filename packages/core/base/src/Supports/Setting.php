<?php

namespace Messi\Base\Supports;


use Illuminate\Database\DatabaseManager;

class Setting
{
    /**
     * Registry config
     *
     * @var array
     */
    protected $config;


    /**
     * Database manager instance
     *
     * @var \Illuminate\Database\DatabaseManager
     */
    protected $database;

    /**
     * Cache
     *
     * @var Cache
     */
    protected $cache;

    /**
     * Constructor
     *
     * @param DatabaseManager $database
     * @param Cache $cache
     * @param array $config
     */
    public function __construct(DatabaseManager $database, Cache $cache, $config = array ())
    {
        $this->database = $database;
        $this->config   = $config;
        $this->cache    = $cache;
    }

    /**
     * Gets a value
     *
     * @param  string $key
     * @param  string $default
     *
     * @return mixed
     */
    public function get($key, $default = null)
    {
        $value = $this->fetch($key);

        if(!is_null($value))
            return $value;
        else if($default != null)
            return $default;
        else
            return $default;
    }

    /**
     * @param $key
     *
     * @return mixed|null
     */
    private function fetch($key)
    {
        if ($this->cache->hasKey($key)) {
            return $this->cache->get($key);
        }

        $row = $this->database->table('settings')->where('key', $key)->first(['value']);

        return (!is_null($row)) ? $this->cache->set($key, unserialize($row->value)) : null;
    }


    /**
     * Checks if setting exists
     *
     * @param $key
     *
     * @return bool
     */
    public function hasKey($key)
    {
        if ($this->cache->hasKey($key)) {
            return true;
        }
        $row = $this->database->table('settings')->where('key', $key)->first(['value']);

        return (count($row) > 0);
    }

    /**
     * Store value into registry
     *
     * @param  string $key
     * @param  mixed  $value
     *
     * @return mixed
     */
    public function set($key, $value)
    {
        $value = $value ? serialize($value) : null;
        $setting = $this->database->table('settings')->where('key', $key)->first();

        if (is_null($setting)) {
            $this->database->table('settings')
                ->insert(['key' => $key, 'value' => $value]);
        } else {
            $this->database->table('settings')
                ->where('key', $key)
                ->update(['value' => $value]);
        }

        $this->cache->set($key, unserialize($value));

        return $value;
    }


    /**
     * Remove a setting
     *
     * @param  string $key
     *
     * @return void
     */
    public function forget($key)
    {
        $this->database->table('settings')->where('key', $key)->delete();
        $this->cache->forget($key);
    }

    /**
     * Remove all settings
     *
     * @return bool
     */
    public function flush()
    {
        $this->cache->flush();

        return $this->database->table('settings')->delete();
    }

    /**
     * Fetch all values
     *
     * @return mixed
     */
    public function getAll()
    {
        return $this->cache->getAll();
    }
}