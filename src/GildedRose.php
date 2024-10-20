<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\Items\AgedBrie;
use GildedRose\Items\BackstagePasses;
use GildedRose\Items\Sulfuras;

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

            if (!$item instanceof AgedBrie && !$item instanceof BackstagePasses) {
                if ($item->quality > 0) {
                    if (!$item instanceof Sulfuras) {
                        $item->quality = $item->quality - 1;
                    }
                }
            } else {
                if ($item->quality < 50) {
                    $item->quality = $item->quality + 1;
                    if ($item instanceof BackstagePasses) {
                        if ($item->sellIn < 11) {
                            if ($item->quality < 50) {
                                $item->quality = $item->quality + 1;
                            }
                        } else if ($item->sellIn < 6) {
                            if ($item->quality < 50) {
                                $item->quality = $item->quality + 1;
                            }
                        }
                    }
                }
            }

            if (!$item instanceof Sulfuras) {
                $item->sellIn = $item->sellIn - 1;
            }

            if ($item->sellIn < 0) {
                if (!$item instanceof AgedBrie) {
                    if (!$item instanceof BackstagePasses) {
                        if ($item->quality > 0) {
                            if (!$item instanceof Sulfuras) {
                                $item->quality = $item->quality - 1;
                            }
                        }
                    } else {
                        $item->quality = $item->quality - $item->quality;
                    }
                } else {
                    if ($item->quality < 50) {
                        $item->quality = $item->quality + 1;
                    }
                }
            }
        }
    }
}
