<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\Item;

class DexterityVest extends Item
{
    protected const NAME = '+5 Dexterity Vest';

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
