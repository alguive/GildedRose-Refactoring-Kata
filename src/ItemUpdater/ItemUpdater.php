<?php

declare(strict_types=1);

namespace GildedRose\ItemUpdater;

use GildedRose\Item;

abstract class ItemUpdater
{
    /**
     * @param Item $item
     */
    public function __construct(
        protected Item $item
    ) {
    }

    /**
     * Abstract method to update Item by its own logic
     *
     * @return void
     */
    abstract function update(): void;

    /**
     * Increases Quality by 1 (default) or the quantity received
     *
     * @param integer $quality
     * @return void
     */
    public function increaseQuality(int $quality = 1): void
    {
        if ($this->item->quality < 50) {
            $this->item->quality = $this->item->quality + $quality;
        }
    }

    /**
     * Decreases Quality by 1 (default) or the quantity received
     *
     * @param integer $quality
     * @return void
     */
    public function decreaseQuality(int $quality = 1): void
    {
        $this->item->quality = $this->item->quality - $quality;
    }

    /**
     * Decreases Item sellIn by 1 (default) or the quantity received
     *
     * @param integer $sellIn
     * @return void
     */
    public function decreaseSellIn(int $sellIn = 1): void
    {
        $this->item->sellIn = $this->item->sellIn - $sellIn;
    }
}
