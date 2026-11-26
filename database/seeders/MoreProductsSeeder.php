<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class MoreProductsSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'name' => 'Razer BlackWidow V4',
                'cat' => 'keyboard',
                'section' => 'shop',
                'price' => 159,
                'note' => 'Mechanical, RGB',
                'description' => 'A full-size mechanical keyboard with RGB lighting.',
                'specs' => ['Layout: full size', 'Switches: mechanical', 'Connection: USB-C'],
                'img' => '/images/16.png',
            ],
            [

                'name' => 'Razer BlackWidow V4',
                'cat' => 'keyboard',
                'section' => 'shop',
                'price' => 159,
                'note' => 'Mechanical, RGB',
                'description' => 'A full-size mechanical keyboard with RGB lighting.',
                'specs' => ['Layout: full size', 'Switches: mechanical', 'Connection: USB-C'],
                'img' => '/images/14.png',
            ],
            // copy the block above for each new item
        ];

        foreach ($items as $item) {
            // skips an item that already exists, so you can run this again safely
            Product::firstOrCreate(['name' => $item['name']], $item);
        }
    }
}
