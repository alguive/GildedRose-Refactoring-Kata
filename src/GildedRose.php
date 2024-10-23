<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\Items\AgedBrie;
use GildedRose\Items\BackstagePasses;
use GildedRose\ItemUpdater\AgedBrieUpdater;
use GildedRose\ItemUpdater\BackStagePassesUpdater;

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
            }
        }
    }
}
