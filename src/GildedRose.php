<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\Items\AgedBrie;
use GildedRose\Items\BackstagePasses;

final class GildedRose
{
    /**
     * @param Item[] $items
     */
    public function __construct(
        private array $items
    ) {
        // Empty constructor
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            if ($item instanceof AgedBrie) {
                $this->manageAgedBrie($item);
            }

            if ($item instanceof BackstagePasses) {
                $this->manageBackstagePasses($item);
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
     * Manage Backstage passes
     *      Backstage passes increasses value (Quality) every day.
     *      10 days before or less for the concert, increases value x2
     *      5 days before or less for the concert, increases value x3
     *
     * @param Item $item
     * @return void
     */
    protected function manageBackstagePasses(Item &$item): void
    {
        $this->increaseQuality($item);

        if ($item->sellIn < 11) {
            $this->increaseQuality($item);
        }
        if ($item->sellIn < 6) {
            $this->increaseQuality($item);
        }

        $this->decreaseSellIn($item);

        if ($item->sellIn < 0) {
            $item->quality = $item->quality - $item->quality;
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
