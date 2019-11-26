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
    public function testItems(Item $item, int $expected, int $sellIn): void
    {
        $rose = new GildedRose([$item]);

        while ($sellIn > 1) {
            $rose->updateQuality();
            --$sellIn;
        }

        $this->assertEquals($expected, $item->quality);
    }

    public function provider(): array
    {
        return [
            'foo' => ['item' => new Item('foo', 9, 10), 'expected' => 2, 'sellIn' => 9],
            'Aged Brie' => ['item' => new Item('Aged Brie', 9, 10), 'expected' => 18, 'sellIn' => 9],
            'Backstage' => ['item' => new Item('Backstage passes', 9, 10), 'expected' => 30, 'sellIn' => 9],
            'Backstage2' => ['item' => new Item('Backstage passes', 9, 10), 'expected' => 0, 'sellIn' => 19],
            'Backstage3' => ['item' => new Item('Backstage passes', 9, 10), 'expected' => 0, 'sellIn' => 19],
            'Sulfuras1' => ['item' => new Item('Sulfuras', 9, 10), 'expected' => 80, 'sellIn' => 9],
            'aged-foo' => ['item' => new Item('foo', 3, 14), 'expected' => 1, 'sellIn' => 9],
            'qualityFoo' => ['item' => new Item('foo', 3, 94), 'expected' => 39, 'sellIn' => 30],
            'qualityBrie' => ['item' => new Item('Aged Brie', 3, 94), 'expected' => 94, 'sellIn' => 30],
            'cheapBrie' => ['item' => new Item('Aged Brie', 3, 3), 'expected' => 50, 'sellIn' => 30],
        ];
    }
}
