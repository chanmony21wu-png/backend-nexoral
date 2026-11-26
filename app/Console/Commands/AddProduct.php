<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;

class AddProduct extends Command
{
    protected $signature = 'product:add
        {name : Product name, in quotes}
        {cat : Category, one word like keyboard, mouse, laptop, monitor}
        {price : Price in dollars, for example 129}
        {--section=shop : shop (Shop all gear) or collection (Collection cards)}
        {--note= : Short line under the name}
        {--desc= : Description shown in the details window}
        {--specs= : Specs separated by the | sign}
        {--img= : Picture path, for example /images/10.png}';

    protected $description = 'Add a product to the shop database (the shop shows it right away)';

    public function handle(): int
    {
        $section = (string) $this->option('section');
        if (! in_array($section, ['shop', 'collection'], true)) {
            $this->error('--section must be shop or collection');

            return self::FAILURE;
        }

        $price = $this->argument('price');
        if (! is_numeric($price) || $price < 0) {
            $this->error('The price must be a number, for example 129');

            return self::FAILURE;
        }

        $specs = array_values(array_filter(array_map('trim', explode('|', (string) $this->option('specs')))));

        $product = Product::create([
            'name' => trim((string) $this->argument('name')),
            'cat' => strtolower(trim((string) $this->argument('cat'))),
            'section' => $section,
            'price' => $price,
            'note' => (string) $this->option('note'),
            'description' => (string) $this->option('desc'),
            'specs' => $specs,
            'img' => (string) $this->option('img'),
        ]);

        $this->info("Added product #{$product->id}: {$product->name} ({$product->section})");

        return self::SUCCESS;
    }
}