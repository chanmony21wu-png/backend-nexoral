<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        if (Product::count() > 0) {
            return; // only fills an empty table
        }

        $items = json_decode(<<<'JSON'
[
  {
    "name": "AULA F75 Pro Keyboard",
    "cat": "keyboard",
    "section": "shop",
    "price": 80,
    "note": "Hot-swappable, wireless",
    "desc": "A compact 75% keyboard with a metal case, per-key RGB and a smooth typing feel. Connects by Bluetooth, 2.4 GHz or USB-C.",
    "specs": [
      "Layout: 75%, 82 keys",
      "Switches: hot-swappable",
      "Battery: 4000 mAh",
      "Connection: Bluetooth / 2.4 GHz / USB-C"
    ],
    "img": "/images/1.png"
  },
  {
    "name": "Vortex Pro Mouse",
    "cat": "mouse",
    "section": "shop",
    "price": 79,
    "note": "26K DPI, 58 g",
    "desc": "A lightweight mouse with a flawless sensor and a comfortable shell. Designed for long sessions without fatigue.",
    "specs": [
      "Weight: 58 g",
      "DPI: 26,000",
      "Battery: 70 h",
      "Connection: Bluetooth / 2.4 GHz / USB-C"
    ],
    "img": "/images/2.png"
  },
  {
    "name": "Aero 14 Laptop",
    "cat": "laptop",
    "section": "shop",
    "price": 1199,
    "note": "14-inch OLED, 18 h battery",
    "desc": "A 14-inch laptop with an aluminium body under 1.2 kg and an OLED screen that stays sharp in daylight. Perfect for work and play.",
    "specs": [
      "Screen: 14-inch OLED, 2880x1800",
      "Weight: 1.18 kg",
      "Battery: 18 h",
      "CPU: Intel i7-13700H",
      "GPU: RTX 4060"
    ],
    "img": "/images/3.png"
  },
  {
    "name": "Pulse TKL Keyboard",
    "cat": "keyboard",
    "section": "shop",
    "price": 99,
    "note": "Tactile switches",
    "desc": "A tenkeyless keyboard with a metal case, per-key RGB and a smooth typing feel. Connects by Bluetooth, 2.4 GHz or USB-C.",
    "specs": [
      "Layout: TKL, 87 keys",
      "Switches: tactile",
      "Battery: 4000 mAh",
      "Connection: Bluetooth / 2.4 GHz / USB-C"
    ],
    "img": "/images/7.png"
  },
  {
    "name": "Glide Ultralight Mouse",
    "cat": "mouse",
    "section": "shop",
    "price": 69,
    "note": "Wireless, 70 h battery",
    "desc": "A wireless ultralight mouse with a flawless sensor and a comfortable shell. Designed for long sessions without fatigue.",
    "specs": [
      "Weight: 58 g",
      "DPI: 26,000",
      "Battery: 70 h",
      "Connection: Bluetooth / 2.4 GHz / USB-C"
    ],
    "img": "/images/5.png"
  },
  {
    "name": "ROG ZEPHYRUS G16",
    "cat": "laptop",
    "section": "shop",
    "price": 1599,
    "note": "NVIDIA® GeForce RTX™ 5090, 240hz",
    "desc": "A 16-inch gaming laptop with a high refresh rate display and powerful RTX graphics. Perfect for gaming and content creation.",
    "specs": [
      "Screen: 16-inch, 2560x1600, 240 Hz",
      "Weight: 1.85 kg",
      "Battery: 160W",
      "CPU: Intel® Core™Ultra 9 386H",
      "GPU: RTX 5090"
    ],
    "img": "/images/6.png"
  },
  {
    "name": "MSI Optix MAG270VC",
    "cat": "monitor",
    "section": "shop",
    "price": 299,
    "note": "4K UHD, 144 Hz",
    "desc": "A 27-inch monitor with 4K UHD resolution and a 144 Hz refresh rate. Perfect for gaming and productivity.",
    "specs": [
      "Screen: 27-inch, 4K UHD",
      "Refresh Rate: 144 Hz",
      "Response Time: 1 ms",
      "Connectivity: HDMI / DisplayPort / USB-C"
    ],
    "img": "/images/4.png"
  },
  {
    "name": "ROG Strix XG27AQM",
    "cat": "monitor",
    "section": "shop",
    "price": 399,
    "note": "Curved, 165 Hz",
    "desc": "A 32-inch curved monitor with a high refresh rate and immersive viewing experience. Perfect for gaming and entertainment.",
    "specs": [
      "Screen: 32-inch, 2560x1440, Curved",
      "Refresh Rate: 165 Hz",
      "Response Time: 1 ms",
      "Connectivity: HDMI / DisplayPort / USB-C"
    ],
    "img": "/images/8.png"
  },
  {
    "name": "Nova Gaming Headset",
    "cat": "headset",
    "section": "collection",
    "price": 89,
    "note": "7.1 surround, wireless",
    "desc": "A wireless gaming headset with clear 7.1 surround sound and a soft, comfortable fit for long sessions.",
    "specs": [
      "Sound: 7.1 surround",
      "Battery: 40 h",
      "Microphone: detachable",
      "Connection: 2.4 GHz / Bluetooth"
    ],
    "img": "/images/9.png"
  },
  {
    "name": "Stealth XL Mousepad",
    "cat": "mousepad",
    "section": "collection",
    "price": 25,
    "note": "Extra large, RGB edge",
    "desc": "An extra large mousepad with a smooth surface and a glowing RGB edge. It covers your keyboard and mouse.",
    "specs": [
      "Size: 900 x 400 mm",
      "Surface: smooth cloth",
      "Lighting: RGB edge",
      "Base: non-slip rubber"
    ],
    "img": "/images/13.png"
  },
  {
    "name": "Lumen 1080p Webcam",
    "cat": "webcam",
    "section": "collection",
    "price": 59,
    "note": "Full HD, auto focus",
    "desc": "A Full HD webcam with fast auto focus and a built-in microphone. Great for streaming and video calls.",
    "specs": [
      "Video: 1080p, 60 fps",
      "Focus: auto",
      "Microphone: built-in stereo",
      "Connection: USB-C"
    ],
    "img": "/images/11.png"
  },
  {
    "name": "Titan Gaming Chair",
    "cat": "chair",
    "section": "collection",
    "price": 249,
    "note": "Ergonomic, adjustable",
    "desc": "An ergonomic gaming chair with adjustable arms, a reclining back and strong support for long hours.",
    "specs": [
      "Recline: up to 180°",
      "Armrests: 4D adjustable",
      "Load: up to 150 kg",
      "Material: breathable leather"
    ],
    "img": "/images/12.png"
  }
]
JSON, true);

        foreach ($items as $p) {
            Product::create([
                'name' => $p['name'],
                'cat' => $p['cat'],
                'section' => $p['section'],
                'price' => $p['price'],
                'note' => $p['note'],
                'description' => $p['desc'],
                'specs' => $p['specs'],
                'img' => $p['img'],
            ]);
        }
    }
}
