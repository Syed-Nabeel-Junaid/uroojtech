<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * The final, real gaming-hardware catalog, grouped by category name.
     *
     * Owner-supplied products (skuCode prefixed 1-11) keep their exact given
     * names and prices. Products 12-15 were added to round out the catalog
     * and are each priced above PKR 500,000 as required. Specifications
     * reflect only what was supplied or well-known public specs for
     * mass-market consoles — nothing invented beyond that.
     */
    public function run(): void
    {
        // Replace the catalog wholesale rather than diffing it: the dummy
        // catalog and this real one share no products, and updateOrCreate
        // alone would leave old rows orphaned rather than removed.
        Product::query()->delete();

        $catalog = [
            'Gaming PCs' => [
                [
                    'name' => 'ROG Hyperion Dhahab Gaming PC',
                    'skuCode' => 'ASU',
                    'brand' => 'ASUS ROG',
                    'price' => 1600000.00,
                    'short_description' => "ASUS ROG's flagship Dhahab gold-finish gaming PC with an RTX 5090 and Ryzen 7 9800X3D.",
                    'specifications' => ['GPU' => 'NVIDIA GeForce RTX 5090', 'CPU' => 'AMD Ryzen 7 9800X3D', 'RAM' => '32GB', 'Storage' => '2TB SSD'],
                    'stock' => 4,
                    'featured' => true,
                ],
                [
                    'name' => 'ASUS ROG NUC 16',
                    'skuCode' => 'ASU',
                    'brand' => 'ASUS ROG',
                    'price' => 1400000.00,
                    'short_description' => 'Compact ASUS ROG NUC powerhouse with an RTX 5090 and Intel Core Ultra 9.',
                    'specifications' => ['GPU' => 'NVIDIA GeForce RTX 5090', 'CPU' => 'Intel Core Ultra 9', 'RAM' => '64GB DDR5', 'Storage' => '2TB SSD'],
                    'stock' => 5,
                    'featured' => true,
                ],
                [
                    'name' => 'Valve Steam Machine',
                    'skuCode' => 'VLV',
                    'brand' => 'Valve',
                    'price' => 1000000.00,
                    'short_description' => "Valve's living-room gaming PC built around SteamOS for 4K console-style gaming.",
                    'specifications' => ['CPU' => 'AMD Zen 4, 6-core/12-thread', 'GPU' => 'Semi-custom AMD RDNA 3, 28 CU', 'OS' => 'SteamOS'],
                    'stock' => 8,
                    'featured' => true,
                ],
                [
                    'name' => 'ASUS ROG Monster Hyperion Gaming PC',
                    'skuCode' => 'ASU',
                    'brand' => 'ASUS ROG',
                    'price' => 1400000.00,
                    'short_description' => 'High-end ASUS ROG Hyperion build with an RTX 5080 and Ryzen 9 7900X.',
                    'specifications' => ['GPU' => 'NVIDIA GeForce RTX 5080', 'CPU' => 'AMD Ryzen 9 7900X', 'RAM' => '32GB'],
                    'stock' => 4,
                    'featured' => false,
                ],
                [
                    'name' => 'Master TD500 Mesh Gaming PC',
                    'skuCode' => 'CLM',
                    'brand' => 'Cooler Master',
                    'price' => 1300000.00,
                    'short_description' => 'Mesh-front gaming build in a Cooler Master TD500 Mesh chassis with an Intel Core i5-14600KF.',
                    'specifications' => ['CPU' => 'Intel Core i5-14600KF', 'RAM' => '32GB', 'Storage' => '1TB', 'Case' => 'Cooler Master TD500 Mesh'],
                    'stock' => 5,
                    'featured' => false,
                ],
                [
                    'name' => 'EVO Lamborghini Gaming PC',
                    'skuCode' => 'EVO',
                    'brand' => 'EVO (Automobili Lamborghini)',
                    'price' => 1700000.00,
                    'short_description' => 'Automobili Lamborghini-licensed EVO gaming PC with an RTX 5080 OC and Core i9-14900KF.',
                    'specifications' => ['GPU' => 'NVIDIA GeForce RTX 5080 OC 16GB', 'CPU' => 'Intel Core i9-14900KF', 'RAM' => '32GB', 'Storage' => '1TB'],
                    'stock' => 3,
                    'featured' => true,
                ],
            ],
            'Gaming Consoles' => [
                [
                    'name' => 'Sony PlayStation 5 Slim Disc Edition with COD Black Ops 6',
                    'skuCode' => 'SNY',
                    'brand' => 'Sony',
                    'price' => 700000.00,
                    'short_description' => 'PS5 Slim Disc Edition console bundled with Call of Duty: Black Ops 6.',
                    'specifications' => ['Storage' => '1TB SSD', 'Optical Drive' => 'Ultra HD Blu-ray', 'Bundled Game' => 'Call of Duty: Black Ops 6'],
                    'stock' => 10,
                    'featured' => true,
                    'imageExt' => 'webp',
                ],
                [
                    'name' => 'PlayStation 5 Gaming Bundle',
                    'skuCode' => 'SNY',
                    'brand' => 'Sony',
                    'price' => 900000.00,
                    'short_description' => 'PS5 console bundle with extra controller and accessories for multiplayer-ready gaming.',
                    'specifications' => ['Storage' => '1TB SSD', 'Included' => 'Console + extra DualSense controller'],
                    'stock' => 6,
                    'featured' => false,
                    'imageExt' => 'png',
                ],
                [
                    'name' => 'Xbox Series X — 1TB Digital Edition',
                    'skuCode' => 'MSF',
                    'brand' => 'Microsoft',
                    'price' => 700000.00,
                    'short_description' => 'All-digital Xbox Series X with 1TB of storage for 4K gaming.',
                    'specifications' => ['Storage' => '1TB SSD', 'Drive' => 'Digital (no disc drive)', 'Resolution' => 'Up to 4K/120fps'],
                    'stock' => 10,
                    'featured' => false,
                ],
            ],
            'Gaming Laptops' => [
                [
                    'name' => 'HP OMEN MAX 16T-AH000',
                    'skuCode' => 'HP',
                    'brand' => 'HP',
                    'price' => 1399999.00,
                    'short_description' => "HP's flagship 16-inch gaming laptop with an RTX 5090 and Intel Core Ultra 9 275HX.",
                    'specifications' => ['CPU' => 'Intel Core Ultra 9 275HX', 'GPU' => 'NVIDIA GeForce RTX 5090 24GB', 'RAM' => '64GB', 'Storage' => '2TB SSD'],
                    'stock' => 5,
                    'featured' => true,
                ],
                [
                    'name' => 'MSI Titan 18 HX A2WJ',
                    'skuCode' => 'MSI',
                    'brand' => 'MSI',
                    'price' => 2282999.00,
                    'short_description' => "MSI's 18-inch flagship desktop-replacement gaming laptop with an RTX 5090.",
                    'specifications' => ['CPU' => 'Intel Core Ultra 9 290HX Plus', 'GPU' => 'NVIDIA GeForce RTX 5090 24GB', 'RAM' => '64GB', 'Storage' => '2TB SSD'],
                    'stock' => 3,
                    'featured' => true,
                ],
                [
                    'name' => 'Acer Predator Helios 16 AI',
                    'skuCode' => 'ACR',
                    'brand' => 'Acer',
                    'price' => 1349999.00,
                    'short_description' => 'Acer Predator Helios 16 AI gaming laptop with an RTX 5090 and Intel Core Ultra 9.',
                    'specifications' => ['CPU' => 'Intel Core Ultra 9 275HX', 'GPU' => 'NVIDIA GeForce RTX 5090 24GB', 'RAM' => '64GB', 'Storage' => '2TB SSD'],
                    'stock' => 4,
                    'featured' => false,
                ],
            ],
            'Mice & Input' => [
                [
                    'name' => '3Dconnexion SpaceMouse Enterprise',
                    'skuCode' => '3DX',
                    'brand' => '3Dconnexion',
                    'price' => 300000.00,
                    'short_description' => 'Flagship 6-degrees-of-freedom 3D mouse for professional CAD and modeling workflows.',
                    'specifications' => ['Sensor' => '6-Degrees-of-Freedom (6DoF)', 'Programmable Keys' => '31', 'Display' => 'Color LCD', 'Dimensions' => '249 x 154 x 58 mm'],
                    'stock' => 6,
                    'featured' => false,
                ],
                [
                    'name' => 'Gaming Mouse — gold/black limited-edition',
                    'skuCode' => 'FNL',
                    'brand' => 'Finalmouse',
                    'price' => 200000.00,
                    'short_description' => 'Limited-edition gold and black gaming mouse with a premium finish.',
                    'specifications' => ['Color' => 'Gold / Black', 'Edition' => 'Limited'],
                    'stock' => 2,
                    'featured' => false,
                ],
            ],
            'Components' => [
                [
                    'name' => 'ASUS ROG Astral LC RTX 5090 OC Edition 32GB',
                    'skuCode' => 'ASU',
                    'brand' => 'ASUS ROG',
                    'price' => 1450000.00,
                    'short_description' => "ASUS ROG's premium liquid-cooled RTX 5090 graphics card with 32GB GDDR7.",
                    'specifications' => ['GPU' => 'NVIDIA GeForce RTX 5090', 'Memory' => '32GB GDDR7', 'Cooling' => '360mm AIO liquid cooler'],
                    'stock' => 6,
                    'featured' => true,
                ],
            ],
        ];

        foreach ($catalog as $categoryName => $products) {
            foreach ($products as $index => $product) {
                $category = Category::where('slug', Str::slug($categoryName))->first();

                if (! $category) {
                    continue;
                }

                $slug = Str::slug($product['name']);

                Product::updateOrCreate(
                    ['slug' => $slug],
                    [
                        'name' => $product['name'],
                        'sku' => $product['skuCode'].'-'.Str::upper(Str::substr($categoryName, 0, 3)).'-'.(1001 + $index),
                        'category_id' => $category->id,
                        'brand' => $product['brand'],
                        'price' => $product['price'],
                        'sale_price' => null,
                        'short_description' => $product['short_description'],
                        'description' => $product['short_description'].' Available now at Urooj Tech.',
                        'specifications' => $product['specifications'],
                        'stock' => $product['stock'],
                        'status' => true,
                        'featured' => $product['featured'],
                        'image' => "images/products/{$slug}.".($product['imageExt'] ?? 'jpg'),
                    ]
                );
            }
        }
    }
}
