<?php

require_once 'vendor/autoload.php';

use Thgs\Pomodoro\Timer;

stream_set_blocking(STDIN, false);

$pomodoroTimer = new Timer(25);
$startedAt = $pomodoroTimer->start();
e("Pomodoro started " . $startedAt->format('H:i:s'));

$dotTimer = new Timer(1);
$dotTimer->start();
while (!$pomodoroTimer->hasFinished()) {
    if ($input = fgetc(STDIN)) {
        processInput($input);
    }
    usleep(1000000);
    if ($dotTimer->hasFinished()) {
        echo '.';
        $dotTimer->start();
    }
}

$breakTimer = new Timer(5);
$breakStartedAt = $breakTimer = $breakTimer->start();

e('');
e("Break started " . $breakStartedAt->format('H:i:s'));

function processInput(string $input)
{
    $clean = strtolower(trim($input));
    switch ($clean) {
        case 'q':
            e('Bye!');
            exit();
        default:
            return;
    }
}

function e(string $text): void
{
    echo $text . PHP_EOL;
}