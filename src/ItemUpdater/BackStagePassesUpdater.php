<?php

declare(strict_types=1);

namespace GildedRose\ItemUpdater;

class BackStagePassesUpdater extends ItemUpdater
{
    protected const SELL_IN_DECREASE = 1;
    protected const QUALITY_INCREASE = 1;

    /**
     * Update Backstage passes
     *      Backstage passes increasses value (Quality) every day
     *      10 days before or less for the concert, increases value x2
     *      5 days before or less for the concert, increases value x3
     *      Quality drops to 0 after the concert
     *
     * @return void
     */
    public function update(): void
    {
        $this->increaseQuality(self::QUALITY_INCREASE);

        if ($this->item->sellIn < 11) {
            $this->increaseQuality(self::QUALITY_INCREASE);
        }

        if ($this->item->sellIn < 6) {
            $this->increaseQuality(self::QUALITY_INCREASE);
        }

        $this->decreaseSellIn(self::SELL_IN_DECREASE);

        if ($this->item->sellIn < 0) {
            $this->item->quality = 0;
        }
    }
}
