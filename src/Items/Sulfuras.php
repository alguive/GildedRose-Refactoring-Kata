<?php

declare(strict_types=1);

namespace GildedRose\Items;

use GildedRose\Item;

class Sulfuras extends Item
{
    protected const NAME = 'Sulfuras, Hand of Ragnaros';

    public function __construct(
        public int $sellIn,
        public int $quantity
    ) {
        parent::__construct(
            self::NAME,
            $sellIn,
            $quantity
        );
    }
}
