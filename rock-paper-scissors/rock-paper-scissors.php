<?php

echo "************************" . PHP_EOL;
echo "ROCK PAPER SCISSORS" . PHP_EOL;

$moves = [
    1 => "Rock",
    2 => "Paper",
    3 => "Scissors"
];

echo "Choose your move: " . PHP_EOL;
echo "1 => Rock" . PHP_EOL;
echo "2 => Paper" . PHP_EOL;
echo "3 => Scissors" . PHP_EOL;

$computerMove = array_search($moves[rand(1, 3)], $moves);

$input = (int) readline('Enter a number for your move: ');

if (filter_var($input, FILTER_VALIDATE_INT) && $input >= 1 && $input <= 3) {
    if ($input === $computerMove) {
        echo "Computer choose {$moves[$computerMove]} and its a draw";
    } elseif ($input === 1 && $computerMove === 3) {
        echo "Computer choose {$moves[$computerMove]} and you won";
    } elseif ($input === 2 && $computerMove === 1) {
        echo "Computer choose {$moves[$computerMove]} and you won";
    } elseif ($input === 3 && $computerMove === 2) {
        echo "Computer choose {$moves[$computerMove]} and you won";
    } else {
        echo "Computer choose {$moves[$computerMove]} and you lost";
    }
} else {
    echo "You provided an invalid value!";
}
