<?php

declare(strict_types=1);

namespace GildedRose\ItemUpdater;

class AgedBrieUpdater extends ItemUpdater
{
    protected const SELL_IN_DECREASE = 1;
    protected const QUALITY_INCREASE = 1;

    /**
     * Update Aged Brie
     *      Aged Brie actually increases in Quality the older it gets.
     *      When date expired (SellIn) then the quality (Quality) increases double every day.
     *
     * @return void
     */
    public function update(): void
    {
        $this->increaseQuality(self::QUALITY_INCREASE);
        $this->decreaseSellIn(self::SELL_IN_DECREASE);

        if ($this->item->sellIn < 0) {
            $this->increaseQuality(self::QUALITY_INCREASE);
        }
    }
}
