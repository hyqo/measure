<?php

namespace Hyqo\Measure;

class Measure
{
    protected static array $stack = [];

    /**
     * @var array<string,Result[]>
     */
    protected static array $results = [];

    public static function start(string $name): void
    {
        self::$stack[$name] = (float)microtime(true);
        self::$results[$name] = null;
    }

    public static function stop(string $name): ?Result
    {
        if (!count(self::$stack)) {
            return null;
        }

        if (array_key_exists($name, self::$stack)) {
            $started = self::$stack[$name];
        } else {
            return null;
        }

        unset(self::$stack[$name]);

        $seconds = microtime(true) - $started;

        return self::$results[$name] = new Result($seconds);
    }

    /**
     * @return array<string,Result[]>
     */
    public static function getResults(): array
    {
        return self::$results;
    }
}
