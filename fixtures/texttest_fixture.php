<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use GildedRose\Items\AgedBrie;
use GildedRose\Items\BackstagePasses;
use GildedRose\Items\DexterityVest;
use GildedRose\Items\Elixir;
use GildedRose\GildedRose;
use GildedRose\Item;
use GildedRose\Items\Sulfuras;

echo 'OMGHAI!' . PHP_EOL;

$items = [
    new DexterityVest(10, 20),
    new AgedBrie(2, 0),
    new Elixir(5, 7),
    new Sulfuras(0, 80),
    new Sulfuras(-1, 80),
    new BackstagePasses(15, 20),
    new BackstagePasses(10, 49),
    new BackstagePasses(5, 49),
    new Item('Conjured Mana Cake', 3, 6),
];

$app = new GildedRose($items);

$days = 2;
if ((is_countable($argv) ? count($argv) : 0) > 1) {
    $days = (int) $argv[1];
}

for ($i = 0; $i < $days; $i++) {
    echo "-------- day {$i} --------" . PHP_EOL;
    echo 'name, sellIn, quality' . PHP_EOL;
    foreach ($items as $item) {
        echo $item . PHP_EOL;
    }
    echo PHP_EOL;
    $app->updateQuality();
}
