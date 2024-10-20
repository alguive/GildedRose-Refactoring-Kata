<?php

declare(strict_types=1);

namespace GildedRose\Items;

use GildedRose\Item;

class AgedBrie extends Item
{
    protected const NAME = 'Aged Brie';

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
