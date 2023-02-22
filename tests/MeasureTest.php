<?php

namespace Hyqo\Measure\Test;

use Hyqo\Measure\Measure;
use PHPUnit\Framework\TestCase;

class MeasureTest extends TestCase
{
    public function test_measure(): void
    {
        Measure::start('foo');
        Measure::start('bar');
        Measure::start('baz');

        $foo = Measure::stop('foo');

        usleep(1000);

        $bar = Measure::stop('bar');

        $this->assertNull(Measure::stop('abc'));

        sleep(1);

        $baz = Measure::stop('baz');

        $this->assertNull(Measure::stop('baz'));
        $this->assertEquals([
            'foo' => $foo,
            'bar' => $bar,
            'baz' => $baz,
        ], Measure::getResults());

        $this->assertMatchesRegularExpression('/\d+\.\d+ us/',(string)$foo);
        $this->assertMatchesRegularExpression('/\d+\.\d+ ms/',(string)$bar);
        $this->assertMatchesRegularExpression('/\d+\.\d+ s/',(string)$baz);
    }
}
