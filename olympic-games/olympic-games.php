<?php

$runLength = 10;

$playerCount = (int) readline('Enter the amount of players: ');

$players = [];

$game = [];

for ($i = 0; $i < $playerCount; $i++) {
    $players[$i] = readline("Enter a character: ");
}

for ($i = 0; $i < $playerCount; $i++) {
    for ($j = 0; $j < $runLength; $j++) {
        $game[$i][$j] = "_";
    }
    $game[$i][0] = $players[$i];
}

function displayField(array &$game, int $playerCount, int $runLength): void {
    for ($i = 0; $i < $playerCount; $i++) {
        for ($j = 0; $j < $runLength; $j++) {
            echo $game[$i][$j] . " ";
        }
        echo PHP_EOL;
    }
}

displayField($game, $playerCount, $runLength);

$running = true;
$finished = 0;
$winners = [];

while ($running) {

    for ($i = 0; $i < $playerCount; $i++) {
        $currentPosition = array_search($players[$i], $game[$i]);
        $temp = $game[$i][$currentPosition];
        $game[$i][$currentPosition] = "_";
        if ($currentPosition == $runLength - 2) {
            $game[$i][$currentPosition + 1] = $temp;
        } else {
            $game[$i][$currentPosition + rand(1, 2)] = $temp;
        }
    }

    displayField($game, $playerCount, $runLength);
    echo "*********************************" . PHP_EOL;

    for ($i = 0; $i < $playerCount; $i++) {
        if ($game[$i][$runLength - 1] === $players[$i]) {
            $winners[] = $players[$i];
            $finished++;
        }
    }

    if ($finished === $playerCount) $running = false;
    sleep(2);
}

echo "The race has ended" . PHP_EOL;

foreach ($winners as $key => $winner) {
    $key += 1;
    echo "{$key} place is {$winner}" . PHP_EOL;
}