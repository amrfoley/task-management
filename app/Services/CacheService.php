<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CacheService
{
    public static function get(string $key, $default = null)
    {
        return Cache::get($key, $default);
    }

    public static function store(string $key, Collection $values)
    {
        Cache::put($key, $values);

        return self::get($key);
    }

    public static function add(string $key, Collection $value)
    {
        Cache::add($key, $value);

        return self::get($key);
    }

    public static function edit(string $key, Model $value)
    {
        self::remove($key, $value);

        Cache::add($key, $value);

        return self::get($key);
    }

    public static function remove(string $key, Model $value)
    {
        return Cache::put($key, $value, 0);
    }
}