<?php

namespace Tests;

use Kata\GildedRose;
use Kata\Item;
use PHPUnit\Framework\TestCase;

final class GildedRoseTest extends TestCase
{
    /**
     * @dataProvider provider
     */
    public function testItems(Item $item, int $expectedQuality, int $days): void
    {
        $rose = new GildedRose([$item]);

        while ($days > 1) {
            $rose->updateQuality();
            --$days;
        }

        $this->assertEquals($expectedQuality, $item->quality);
    }

    public function provider(): array
    {
        return [
            'foo' => ['item' => new Item('foo', 9, 10), 'expectedQuality' => 2, 'days' => 9],
            'Aged Brie' => ['item' => new Item('Aged Brie', 9, 10), 'expectedQuality' => 18, 'days' => 9],
            'Backstage' => ['item' => new Item('Backstage passes', 9, 10), 'expectedQuality' => 30, 'days' => 9],
            'Backstage2' => ['item' => new Item('Backstage passes', 9, 10), 'expectedQuality' => 0, 'days' => 19],
            'Backstage3' => ['item' => new Item('Backstage passes', 9, 10), 'expectedQuality' => 0, 'days' => 19],
            'Sulfuras1' => ['item' => new Item('Sulfuras', 9, 10), 'expectedQuality' => 80, 'days' => 9],
            'aged-foo' => ['item' => new Item('foo', 3, 14), 'expectedQuality' => 1, 'days' => 9],
            'qualityFoo' => ['item' => new Item('foo', 3, 94), 'expectedQuality' => 39, 'days' => 30],
            'qualityBrie' => ['item' => new Item('Aged Brie', 3, 94), 'expectedQuality' => 94, 'days' => 30],
            'cheapBrie' => ['item' => new Item('Aged Brie', 3, 3), 'expectedQuality' => 50, 'days' => 30],
        ];
    }
}
