<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\Items\AgedBrie;
use GildedRose\Items\BackstagePasses;
use GildedRose\Items\Conjured;
use GildedRose\Items\DexterityVest;
use GildedRose\Items\Elixir;
use GildedRose\Items\Sulfuras;

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

    /**
     * Process quality items method
     *
     * @return void
     */
    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            switch (true) {
                case $item instanceof AgedBrie:
                    $this->manageAgedBrie($item);
                    break;
                case $item instanceof BackstagePasses:
                    $this->manageBackstagePasses($item);
                    break;
                case $item instanceof Conjured:
                    $this->manageConjured($item);
                    break;
                case $item instanceof Sulfuras:
                    // Do nothing
                    break;
                default:
                    $this->manageRegularItems($item);
                    break;
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
        $this->increaseQuality($item, 1);
        $this->decreaseSellIn($item, 1);

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
        $this->increaseQuality($item, 1);

        if ($item->sellIn < 11) {
            $this->increaseQuality($item, 1);
        }
        if ($item->sellIn < 6) {
            $this->increaseQuality($item, 1);
        }

        $this->decreaseSellIn($item, 1);

        if ($item->sellIn < 0) {
            $item->quality = $item->quality - $item->quality;
        }
    }

    /**
     * Manage Regular Items
     *      Those Items doesnt follow special rules:
     *          At the end of the day, SellIn and Quality are decreased.
     *          Once the recommended sell date is gone (SellIn), the Quality decreases double every day.
     *
     * @param Item $item
     * @return void
     */
    protected function manageRegularItems(Item &$item): void
    {
        if ($item->quality > 0) {
            $this->decreaseQuality($item, 1);
        }

        $this->decreaseSellIn($item, 1);

        if ($item->sellIn < 0) {
            if ($item->quality > 0) {
                $this->decreaseQuality($item, 1);
            }
        }
    }

    /**
     * Manage Conjured
     *      "Conjured" items degrade in Quality twice as fast as normal items
     *
     * @param Item $item
     * @return void
     */
    protected function manageConjured(Item &$item): void
    {
        if ($item->quality > 0) {
            $this->decreaseQuality($item, 2);
        }

        $this->decreaseSellIn($item, 1);

        if ($item->sellIn < 0) {
            if ($item->quality > 0) {
                $this->decreaseQuality($item, 2);
            }
        }
    }

    /**
     * Check if Quality is minor than 50, if it is, then increases Quality on quantity required
     *
     * @param Item $item
     * @return void
     */
    protected function increaseQuality(Item &$item, int $quantityToIncrease): void
    {
        if ($item->quality < 50) {
            $item->quality = $item->quality + $quantityToIncrease;
        }
    }

    /**
     * Decrease quality on quantity required
     *
     * @param Item $item
     * @param integer $quantityToDecrease
     * @return void
     */
    protected function decreaseQuality(Item &$item, int $quantityToDecrease): void
    {
        $item->quality = $item->quality - $quantityToDecrease;
    }

    /**
     * Decreases SellIn on quantity required
     *
     * @param Item $item
     * @param integer $quantityToDecrease
     * @return void
     */
    protected function decreaseSellIn(Item &$item, int $quantityToDecrease): void
    {
        $item->sellIn = $item->sellIn - $quantityToDecrease;
    }

}
