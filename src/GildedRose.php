<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\Items\AgedBrie;
use GildedRose\Items\BackstagePasses;
use GildedRose\Items\Conjured;
use GildedRose\Items\Sulfuras;
use GildedRose\ItemUpdater\AgedBrieUpdater;
use GildedRose\ItemUpdater\BackStagePassesUpdater;
use GildedRose\ItemUpdater\ConjuredUpdater;
use GildedRose\ItemUpdater\RegularItemUpdater;
use GildedRose\ItemUpdater\SulfurasUpdater;

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
                    $brieUpdater = new AgedBrieUpdater($item);
                    $brieUpdater->update();
                    break;
                case $item instanceof BackstagePasses:
                    $backstagePassesUpdater = new BackStagePassesUpdater($item);
                    $backstagePassesUpdater->update();
                    break;
                case $item instanceof Conjured:
                    $conjuredItemUpdater = new ConjuredUpdater($item);
                    $conjuredItemUpdater->update();
                    break;
                case $item instanceof Sulfuras:
                    $sulfurasUpdater = new SulfurasUpdater($item);
                    $sulfurasUpdater->update();
                    break;
                default: // DexterityVest && Elixir
                    $regularItemUpdater = new RegularItemUpdater($item);
                    $regularItemUpdater->update();
                    break;
            }
        }
    }
}
