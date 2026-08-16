<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Realistic demo products for the storefront, grouped by category name.
     *
     * Brand names are fictional (not real trademarks) since this is placeholder
     * demo data; product imagery uses the shared placeholder SVG until real
     * product photography is supplied.
     */
    public function run(): void
    {
        $catalog = [
            'Laptops' => [
                [
                    'name' => 'Kestrel Pro 14 Laptop',
                    'brand' => 'Kestrel',
                    'price' => 1299.00,
                    'sale_price' => 1149.00,
                    'short_description' => 'A 14-inch ultraportable laptop built for everyday productivity.',
                    'specifications' => ['CPU' => '8-core, up to 4.2GHz', 'RAM' => '16GB', 'Storage' => '512GB SSD', 'Display' => '14" 1920x1200'],
                    'stock' => 18,
                    'featured' => true,
                ],
                [
                    'name' => 'Vantage GX Gaming Laptop',
                    'brand' => 'Vantage',
                    'price' => 1899.00,
                    'sale_price' => null,
                    'short_description' => 'High-performance gaming laptop with a dedicated graphics card.',
                    'specifications' => ['CPU' => '8-core, up to 5.0GHz', 'GPU' => 'Dedicated 8GB', 'RAM' => '32GB', 'Storage' => '1TB SSD'],
                    'stock' => 7,
                    'featured' => false,
                ],
                [
                    'name' => 'NovaTech Slim 13 Laptop',
                    'brand' => 'NovaTech',
                    'price' => 899.00,
                    'sale_price' => null,
                    'short_description' => 'Lightweight 13-inch laptop for browsing, office work, and study.',
                    'specifications' => ['CPU' => '4-core, up to 3.6GHz', 'RAM' => '8GB', 'Storage' => '256GB SSD', 'Display' => '13.3" 1920x1080'],
                    'stock' => 25,
                    'featured' => false,
                ],
            ],
            'Smartphones' => [
                [
                    'name' => 'Zenith Nova 12 Smartphone',
                    'brand' => 'Zenith',
                    'price' => 999.00,
                    'sale_price' => 899.00,
                    'short_description' => 'Flagship smartphone with a triple-camera system and all-day battery.',
                    'specifications' => ['Display' => '6.5" OLED', 'Storage' => '256GB', 'RAM' => '8GB', 'Battery' => '4500mAh'],
                    'stock' => 30,
                    'featured' => true,
                ],
                [
                    'name' => 'Acme Spark 5G Smartphone',
                    'brand' => 'Acme',
                    'price' => 549.00,
                    'sale_price' => null,
                    'short_description' => 'Mid-range 5G smartphone with a smooth 120Hz display.',
                    'specifications' => ['Display' => '6.4" LCD 120Hz', 'Storage' => '128GB', 'RAM' => '6GB', 'Battery' => '5000mAh'],
                    'stock' => 40,
                    'featured' => false,
                ],
            ],
            'Tablets' => [
                [
                    'name' => 'Vantage Slate 11 Tablet',
                    'brand' => 'Vantage',
                    'price' => 649.00,
                    'sale_price' => null,
                    'short_description' => 'An 11-inch tablet for creativity, note-taking, and streaming.',
                    'specifications' => ['Display' => '11" Liquid Retina-class', 'Storage' => '128GB', 'RAM' => '6GB'],
                    'stock' => 22,
                    'featured' => true,
                ],
                [
                    'name' => 'NovaTech Pad Mini Tablet',
                    'brand' => 'NovaTech',
                    'price' => 349.00,
                    'sale_price' => 299.00,
                    'short_description' => 'Compact 8-inch tablet, perfect for reading and casual browsing.',
                    'specifications' => ['Display' => '8" LCD', 'Storage' => '64GB', 'RAM' => '4GB'],
                    'stock' => 35,
                    'featured' => false,
                ],
            ],
            'Monitors' => [
                [
                    'name' => 'Kestrel View 27 Monitor',
                    'brand' => 'Kestrel',
                    'price' => 429.00,
                    'sale_price' => null,
                    'short_description' => '27-inch QHD monitor with accurate color for design and office work.',
                    'specifications' => ['Size' => '27"', 'Resolution' => '2560x1440', 'Refresh Rate' => '75Hz', 'Panel' => 'IPS'],
                    'stock' => 15,
                    'featured' => false,
                ],
                [
                    'name' => 'Zenith Curve 32 Gaming Monitor',
                    'brand' => 'Zenith',
                    'price' => 599.00,
                    'sale_price' => 529.00,
                    'short_description' => 'Curved 32-inch gaming monitor with a 165Hz refresh rate.',
                    'specifications' => ['Size' => '32"', 'Resolution' => '2560x1440', 'Refresh Rate' => '165Hz', 'Panel' => 'VA'],
                    'stock' => 10,
                    'featured' => true,
                ],
            ],
            'Keyboards' => [
                [
                    'name' => 'Acme Click Pro Mechanical Keyboard',
                    'brand' => 'Acme',
                    'price' => 129.00,
                    'sale_price' => null,
                    'short_description' => 'Full-size mechanical keyboard with tactile switches and backlighting.',
                    'specifications' => ['Switch Type' => 'Mechanical tactile', 'Layout' => 'Full-size', 'Backlight' => 'RGB'],
                    'stock' => 50,
                    'featured' => false,
                ],
                [
                    'name' => 'NovaTech Slim Wireless Keyboard',
                    'brand' => 'NovaTech',
                    'price' => 59.00,
                    'sale_price' => 45.00,
                    'short_description' => 'Slim wireless keyboard for a quiet, comfortable typing experience.',
                    'specifications' => ['Switch Type' => 'Membrane', 'Connection' => 'Wireless 2.4GHz + Bluetooth', 'Battery' => 'Up to 6 months'],
                    'stock' => 60,
                    'featured' => false,
                ],
            ],
            'Mice' => [
                [
                    'name' => 'Vantage Precision Wireless Mouse',
                    'brand' => 'Vantage',
                    'price' => 49.00,
                    'sale_price' => null,
                    'short_description' => 'Ergonomic wireless mouse with precision tracking.',
                    'specifications' => ['Sensor' => 'Optical', 'DPI' => 'Up to 8000', 'Connection' => 'Wireless 2.4GHz'],
                    'stock' => 70,
                    'featured' => false,
                ],
                [
                    'name' => 'Zenith Strike Gaming Mouse',
                    'brand' => 'Zenith',
                    'price' => 79.00,
                    'sale_price' => 65.00,
                    'short_description' => 'Lightweight gaming mouse with customizable buttons.',
                    'specifications' => ['Sensor' => 'Optical', 'DPI' => 'Up to 16000', 'Buttons' => '7 programmable'],
                    'stock' => 45,
                    'featured' => true,
                ],
            ],
            'Headphones' => [
                [
                    'name' => 'Kestrel Silence ANC Headphones',
                    'brand' => 'Kestrel',
                    'price' => 249.00,
                    'sale_price' => 199.00,
                    'short_description' => 'Over-ear headphones with active noise cancellation.',
                    'specifications' => ['Type' => 'Over-ear', 'Noise Cancellation' => 'Active', 'Battery' => 'Up to 30 hours'],
                    'stock' => 28,
                    'featured' => true,
                ],
                [
                    'name' => 'Acme Buds Air Earbuds',
                    'brand' => 'Acme',
                    'price' => 89.00,
                    'sale_price' => null,
                    'short_description' => 'True wireless earbuds with a compact charging case.',
                    'specifications' => ['Type' => 'In-ear', 'Battery' => 'Up to 24 hours with case', 'Water Resistance' => 'IPX4'],
                    'stock' => 55,
                    'featured' => false,
                ],
            ],
            'Networking' => [
                [
                    'name' => 'NovaTech Mesh WiFi 6 Router',
                    'brand' => 'NovaTech',
                    'price' => 179.00,
                    'sale_price' => null,
                    'short_description' => 'Dual-band WiFi 6 router for fast, reliable home networking.',
                    'specifications' => ['WiFi Standard' => 'WiFi 6', 'Bands' => 'Dual-band', 'Coverage' => 'Up to 2000 sq ft'],
                    'stock' => 20,
                    'featured' => false,
                ],
                [
                    'name' => 'Vantage 8-Port Gigabit Switch',
                    'brand' => 'Vantage',
                    'price' => 59.00,
                    'sale_price' => null,
                    'short_description' => 'Unmanaged 8-port gigabit switch for expanding a wired network.',
                    'specifications' => ['Ports' => '8x Gigabit Ethernet', 'Switching Capacity' => '16 Gbps'],
                    'stock' => 32,
                    'featured' => false,
                ],
            ],
            'Storage' => [
                [
                    'name' => 'Kestrel Portable SSD 1TB',
                    'brand' => 'Kestrel',
                    'price' => 119.00,
                    'sale_price' => 99.00,
                    'short_description' => 'Compact 1TB portable SSD with fast USB-C transfer speeds.',
                    'specifications' => ['Capacity' => '1TB', 'Interface' => 'USB-C 3.2', 'Read Speed' => 'Up to 1050MB/s'],
                    'stock' => 40,
                    'featured' => true,
                ],
                [
                    'name' => 'Acme MicroSD Card 256GB',
                    'brand' => 'Acme',
                    'price' => 34.00,
                    'sale_price' => null,
                    'short_description' => 'High-speed 256GB microSD card for cameras and mobile devices.',
                    'specifications' => ['Capacity' => '256GB', 'Speed Class' => 'U3 / V30', 'Read Speed' => 'Up to 170MB/s'],
                    'stock' => 65,
                    'featured' => false,
                ],
            ],
            'Accessories' => [
                [
                    'name' => 'NovaTech 65W USB-C Charger',
                    'brand' => 'NovaTech',
                    'price' => 39.00,
                    'sale_price' => null,
                    'short_description' => 'Compact 65W USB-C fast charger for laptops and phones.',
                    'specifications' => ['Output' => '65W', 'Ports' => '1x USB-C', 'Compatibility' => 'Universal USB-C'],
                    'stock' => 80,
                    'featured' => false,
                ],
                [
                    'name' => 'Vantage Adjustable Laptop Stand',
                    'brand' => 'Vantage',
                    'price' => 45.00,
                    'sale_price' => 35.00,
                    'short_description' => 'Aluminum adjustable stand for improved laptop ergonomics.',
                    'specifications' => ['Material' => 'Aluminum', 'Compatibility' => '10"-17" laptops', 'Adjustable' => 'Yes'],
                    'stock' => 50,
                    'featured' => false,
                ],
            ],
        ];

        foreach ($catalog as $categoryName => $products) {
            $category = Category::where('slug', Str::slug($categoryName))->first();

            if (! $category) {
                continue;
            }

            foreach ($products as $index => $product) {
                $slug = Str::slug($product['name']);

                Product::updateOrCreate(
                    ['slug' => $slug],
                    [
                        'name' => $product['name'],
                        'sku' => Str::upper(Str::substr($product['brand'], 0, 3)).'-'.Str::upper(Str::substr($categoryName, 0, 3)).'-'.($index + 1001),
                        'category_id' => $category->id,
                        'brand' => $product['brand'],
                        'price' => $product['price'],
                        'sale_price' => $product['sale_price'],
                        'short_description' => $product['short_description'],
                        'description' => $product['short_description'].' Built for reliable everyday performance with a focus on quality materials and thoughtful design, backed by the Urooj Tech standard warranty.',
                        'specifications' => $product['specifications'],
                        'stock' => $product['stock'],
                        'status' => true,
                        'featured' => $product['featured'],
                        'image' => "images/products/{$slug}.jpg",
                    ]
                );
            }
        }
    }
}
