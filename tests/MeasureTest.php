<?php

namespace Hyqo\Measure\Test;

use Hyqo\Measure\Measure;
use PHPUnit\Framework\TestCase;

class MeasureTest extends TestCase
{
    public function test_measure()
    {
        Measure::start('foo');
        usleep(100);
        $foo = Measure::stop();

        Measure::start('bar');
        usleep(100);

        Measure::start('baz');

        $bar = Measure::stop('bar');
        $baz = Measure::stop();

        $this->assertEquals([
            'foo' => $foo,
            'bar' => $bar,
            'baz' => $baz,
        ], Measure::getResults());
    }
}
