<?php

declare(strict_types=1);

namespace GildedRose\Items;

use GildedRose\Item;

class Conjured extends Item
{
    protected const NAME = 'Conjured Mana Cake';

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
