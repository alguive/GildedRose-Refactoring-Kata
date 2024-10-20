<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\Item;

class Elixir extends Item
{
    protected const NAME = 'Elixir of the Mongoose';

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
