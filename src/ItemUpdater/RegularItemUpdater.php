<?php

declare(strict_types=1);

namespace GildedRose\ItemUpdater;

class RegularItemUpdater extends ItemUpdater
{
    protected const SELL_IN_DECREASE = 1;
    protected const QUALITY_DECREASE = 1;

    /**
     * Update Regular Items
     *      Those Items doesnt follow special rules:
     *          At the end of the day, SellIn and Quality are decreased.
     *          Once the recommended sell date is gone (SellIn), the Quality decreases double every day.
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
