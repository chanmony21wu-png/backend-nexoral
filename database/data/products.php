<?php

// ADD YOUR PRODUCTS HERE, then run this in the terminal:   php artisan product:sync
//
// Each block { ... } is one product. Copy a block to add another one.
//   'section' => 'shop'        shows it in "Shop all gear"
//   'section' => 'collection'  shows it in the Collection cards
//   'img'  => a picture in your React project, inside public\images
//
// The name is the key: a product that already exists with the same name is UPDATED, never doubled.
// Products that are not in this file are not touched.

return [
    [
        'name' => 'ROG Strix',
        'cat' => 'laptop',
        'section' => 'shop',
        'price' => 1790,
        'note' => 'Mechanical, RGB',
        'desc' => 'A full-size mechanical keyboard with RGB lighting.',
        'specs' => ['Layout: full size', 'Switches: mechanical', 'Connection: USB-C'],
        'img' => '/images/17.png',
    ],
    [
        'name' => 'GeForce RTX™ 5090 32G LIGHTNING Z',
        'cat' => 'graphics card',
        'section' => 'collection',
        'price' => 5090,
        'note' => 'The future ignites. The legend returns.',
        'desc' => 'GeForce RTX™ 5090 32G LIGHTNING Z is the ultimate graphics card for gamers and creators.',
        'specs' => ['8-Inch GPU Display', '32GB GDDR6X Memory', '3x DisplayPort 2.1', '1x HDMI 2.1a', 'Dual BIOS', 'RGB Fusion 2.0'],
        'img' => '/images/19.png',
    ],
    [
        'name' => 'MEG Ai1600T PCIE5',
        'cat' => 'power supply',
        'section' => 'collection',
        'price' => 700,
        'note' => 'TMSIs flagship MEG series exemplifies relentless innovation.',
        'desc' => 'The MEG Ai1600T PCIE5 is the ultimate power supply for high-performance gaming and content creation.',
        'specs' => ['Wattage: 1600 Watts', 'Efficiency Certification: 80 Plus', 'GPU Power Connectors: Features dual native 12V-2x6 connectors', 'Internal Components: Server-grade Silicon Carbide (SiC)', 'Cooling: 135mm', 'Smart Features: Integrated Microcontroller Unit (MCU)'],
        'img' => '/images/20.png',
    ],

    // copy the block above here for the next product
];