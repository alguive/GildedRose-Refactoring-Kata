<?php

declare(strict_types=1);

namespace GildedRose\ItemUpdater;

class ConjuredUpdater extends ItemUpdater
{
    protected const SELL_IN_DECREASE = 1;
    protected const QUALITY_DECREASE = 2;

    /**
     * Update Conjured
     *      "Conjured" items degrade in Quality twice as fast as normal items
     *
     * @return void
     */
    public function update(): void
    {
        if ($this->item->quality > 0) {
            $this->decreaseQuality(self::QUALITY_DECREASE);
        }

        $this->decreaseSellIn(self::SELL_IN_DECREASE);

        if ($this->item->sellIn < 0 && $this->item->quality > 0) {
            $this->decreaseQuality(self::QUALITY_DECREASE);
        }
    }
}
