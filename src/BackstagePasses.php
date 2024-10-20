<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\Item;

class BackstagePasses extends Item
{
    protected const NAME = 'Backstage passes to a TAFKAL80ETC concert';

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
