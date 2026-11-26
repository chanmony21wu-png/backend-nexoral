<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;

class SyncProducts extends Command
{
    protected $signature = 'product:sync {--file=database/data/products.php : the file that holds your product list}';

    protected $description = 'Put the products from your code file into the shop database (adds new ones, updates existing ones by name)';

    public function handle(): int
    {
        $path = base_path((string) $this->option('file'));

        if (! file_exists($path)) {
            $this->error("File not found: {$path}");

            return self::FAILURE;
        }

        $items = require $path;

        if (! is_array($items)) {
            $this->error('The file must start with "return [" and end with "];"');

            return self::FAILURE;
        }

        $added = 0;
        $updated = 0;

        foreach ($items as $n => $p) {
            $label = 'Product #' . ($n + 1);

            foreach (['name', 'cat', 'price'] as $required) {
                if (! isset($p[$required]) || $p[$required] === '') {
                    $this->warn("{$label} skipped: it has no '{$required}'.");
                    continue 2;
                }
            }

            $section = $p['section'] ?? 'shop';
            if (! in_array($section, ['shop', 'collection'], true)) {
                $this->warn("{$label} ({$p['name']}) skipped: 'section' must be 'shop' or 'collection'.");
                continue;
            }

            if (! is_numeric($p['price']) || $p['price'] < 0) {
                $this->warn("{$label} ({$p['name']}) skipped: 'price' must be a number.");
                continue;
            }

            $product = Product::updateOrCreate(
                ['name' => trim($p['name'])],
                [
                    'cat' => strtolower(trim($p['cat'])),
                    'section' => $section,
                    'price' => $p['price'],
                    'note' => $p['note'] ?? '',
                    'description' => $p['desc'] ?? ($p['description'] ?? ''),
                    'specs' => array_values((array) ($p['specs'] ?? [])),
                    'img' => $p['img'] ?? '',
                ]
            );

            $product->wasRecentlyCreated ? $added++ : $updated++;
        }

        $this->info("Done: {$added} added, {$updated} updated.");

        return self::SUCCESS;
    }
}