<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\Items\AgedBrie;

final class GildedRose
{
    /**
     * @param Item[] $items
     */
    public function __construct(
        private array $items
    ) {
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            if ($item instanceof AgedBrie) {
                $this->manageAgedBrie($item);
            }
        }
    }

    /**
     * Manage Aged Brie
     *      Aged Brie actually increases in Quality the older it gets.
     *      When date expired (SellIn) then the quality (Quality) increases double every day.
     *
     * @param Item $item
     * @return void
     */
    protected function manageAgedBrie(Item &$item): void
    {
        $this->increaseQuality($item);
        $this->decreaseSellIn($item);

        if ($item->sellIn < 0) {
            $this->increaseQuality($item, 1);
        }
    }

    /**
     * Check if Quality is minor than 50, if it is, then increases Quality on 1
     *
     * @param Item $item
     * @return void
     */
    protected function increaseQuality(Item &$item): void
    {
        if ($item->quality < 50) {
            $item->quality = $item->quality + 1;
        }
    }

    /**
     * Decreases SellIn  on 1
     *
     * @param Item $item
     * @param integer $quantityToDecrease
     * @return void
     */
    protected function decreaseSellIn(Item &$item): void
    {
        $item->sellIn = $item->sellIn - 1;
    }

}
