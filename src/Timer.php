<?php

namespace Thgs\Pomodoro;

use DateTimeImmutable;

class Timer
{
    private $startedAt;
    private string $target;

    public function __construct(private int $minutes = 25)
    {
        $this->target = $minutes . ' minute';

    }

    public function start(): \DateTimeImmutable
    {
        $this->startedAt = new \DateTime('now');
        return DateTimeImmutable::createFromInterface($this->startedAt);
    }

    public function hasFinished(): bool
    {
        if (!$this->startedAt) {
            return false;
        }

        $now = new \DateTime('now');
        if ($now >= $this->startedAt->modify('+' . $this->target)) {
            return true;
        }

        return false;
    }
}