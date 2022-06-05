<?php

namespace Hyqo\Measure;

class Measure
{
    protected static $stack = [];

    protected static $results = [];

    public static function start(string $name): void
    {
        self::$stack[$name] = (float)microtime(true);
        self::$results[$name] = null;
    }

    public static function stop(?string $name = null): ?string
    {
        if (!count(self::$stack)) {
            return null;
        }

        if (null === $name) {
            end(self::$stack);
            $name = (string)key(self::$stack);
            $started = current(self::$stack);
        } elseif (array_key_exists($name, self::$stack)) {
            $started = self::$stack[$name];
        } else {
            return null;
        }

        unset(self::$stack[$name]);

        $result = microtime(true) - $started;

        return self::$results[$name] = self::prettify($result);
    }

    public static function getResults(): array
    {
        return self::$results;
    }

    protected static function prettify(float $result): string
    {
        if ($result > 1) {
            return sprintf("%.2fs", $result);
        }

        if ($result > 1e-3) {
            return sprintf("%.2fms", $result * 1e3);
        }

        if ($result > 1e-6) {
            return sprintf("%.2fus", $result * 1e6);
        }

        return sprintf("%.2fns", $result * 1e9);
    }
}
