<?php

namespace Hyqo\Measure;

readonly class Result
{
    public float $milliseconds;
    public float $microseconds;

    public function __construct(protected float $seconds)
    {
        $this->milliseconds = $this->seconds * 1e3;
        $this->microseconds = $this->milliseconds * 1e3;
    }

    public function __toString(): string
    {
        return $this->prettify();
    }

    protected function prettify(): string
    {
        if ($this->seconds > 1) {
            return sprintf("%.2f s", $this->seconds);
        }

        if ($this->milliseconds > 1) {
            return sprintf("%.2f ms", $this->milliseconds);
        }

        return sprintf("%.2f us", $this->microseconds);
    }
}
