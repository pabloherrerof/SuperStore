<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {



        $products = [
            // Mobile Devices
            ['name' => 'iPhone 14', 'description' => 'Latest Apple iPhone with advanced features', 'price' => 999.99, 'image' => "https://files.refurbed.com/ii/iphone-14-pro-1662623063.jpg?t=fitdesign&h=600&w=800"],
            ['name' => 'Samsung Galaxy S21', 'description' => 'High-end Samsung smartphone with powerful performance', 'price' => 799.99, 'image' => "https://m.media-amazon.com/images/I/618nXc9a7gL._AC_UF894,1000_QL80_.jpg"],

            // Tablets
            ['name' => 'iPad Pro', 'description' => 'Apple iPad Pro with M1 chip and stunning display', 'price' => 1099.99, 'image' => "https://store.storeimages.cdn-apple.com/4668/as-images.apple.com/is/refurb-ipad-pro-12-wifi-spacegray-2020?wid=1144&hei=1144&fmt=jpeg&qlt=90&.v=1626721066000"],
            ['name' => 'Samsung Galaxy Tab S7', 'description' => 'Samsung tablet with high-performance and S Pen support', 'price' => 649.99, 'image' => "https://images.samsung.com/is/image/samsung/p6pim/es/sm-x716bzaaeub/gallery/es-galaxy-tab-s9-5g-x716-sm-x716bzaaeub-537981327?$650_519_PNG$"],

            // Laptop
            ['name' => 'MacBook Pro', 'description' => 'Apple MacBook Pro with M1 chip and sleek design', 'price' => 1299.99, 'image' => "https://thumb.pccomponentes.com/w-530-530/articles/1081/10817690/1286-apple-macbook-pro-intel-core-i5-8gb-256gb-ssd-133-gris-espacial-teclado-ingles-especificaciones.jpg"],
            ['name' => 'Dell XPS 13', 'description' => 'Dell XPS 13 with InfinityEdge display and powerful specs', 'price' => 999.99, 'image' => "https://m.media-amazon.com/images/I/61bkMA-SC0L._AC_UF894,1000_QL80_.jpg"],

            // Desktop
            ['name' => 'iMac', 'description' => 'Apple iMac with Retina display and M1 chip', 'price' => 1399.99, 'image' => "https://store.storeimages.cdn-apple.com/4668/as-images.apple.com/is/imac-24-silver-cto-hero-202310?wid=1254&hei=1132&fmt=jpeg&qlt=90&.v=1697301251973"],
            ['name' => 'HP Pavilion', 'description' => 'HP Pavilion desktop with reliable performance', 'price' => 799.99, 'image' => "https://www.hp.com/es-es/shop/Html/Merch/Images/806Y7EA-ABE_2_1750x1285.jpg"],

            // TVs
            ['name' => 'Samsung QLED 8K', 'description' => 'Samsung 8K TV with QLED technology', 'price' => 4999.99, 'image' => "https://images.samsung.com/is/image/samsung/es-fhd-t530-ue32t5305akxxc-frontblack-227502935?$650_519_PNG$"],
            ['name' => 'LG OLED CX', 'description' => 'LG OLED TV with stunning picture quality', 'price' => 1799.99, 'image' => "https://www.lg.com/content/dam/channel/wcms/es/images/television/55ur80006lj_aeu_eees_es_c/55UR80006LJ_AEU_EEES_ES_C-450x450.jpg"],

            // Consoles
            ['name' => 'PlayStation 5', 'description' => 'Sony PlayStation 5 with next-gen gaming performance', 'price' => 499.99, 'image' => "https://m.media-amazon.com/images/I/51f6iZlNnvL._AC_UF894,1000_QL80_.jpg"],
            ['name' => 'Xbox Series X', 'description' => 'Microsoft Xbox Series X with powerful gaming capabilities', 'price' => 499.99, 'image' => "https://assets.xboxservices.com/assets/fb/d2/fbd2cb56-5c25-414d-9f46-e6a164cdf5be.png?n=XBX_A-BuyBoxBGImage01-D.png"],

            // Headphones
            ['name' => 'Sony WH-1000XM4', 'description' => 'Sony noise-canceling headphones with superior sound quality', 'price' => 349.99, 'image' => "https://www.sony.es/image/5d02da5df552836db894cead8a68f5f3?fmt=pjpeg&wid=330&bgcolor=FFFFFF&bgc=FFFFFF"],
            ['name' => 'Bose QuietComfort 35 II', 'description' => 'Bose headphones with noise-canceling technology', 'price' => 299.99, 'image' => "https://m.media-amazon.com/images/I/51NC9ErIQtL._AC_UF894,1000_QL80_.jpg"],

            // Speakers
            ['name' => 'Sonos One', 'description' => 'Sonos One smart speaker with excellent sound', 'price' => 199.99, 'image' => "https://media.sonos.com/images/znqtjj88/production/253c32d3e93db9ee17d931d2cfc3e6ba88306b29-1280x1280.png?w=3840&q=100&fit=clip&auto=format"],
            ['name' => 'JBL Charge 4', 'description' => 'JBL portable speaker with powerful sound', 'price' => 149.99, 'image' => "https://cdn.mos.cms.futurecdn.net/tpQtt7A9ayMPAKyCCA7i3e.jpg"],
        ];

        $productCategories = [[1], [1, 2], [3, 2], [3, 2], [4, 2], [4, 2], [5, 2], [5, 2], [6, 2], [6, 2], [7, 2], [7, 2], [8, 2], [8, 2], [9], [9, 2]];

        foreach ($products as $index =>  $product) {
            $createdProduct = Product::create($product);

            foreach ($productCategories[$index] as $categoryId) {
                DB::table("category_product")->insert([
                    'product_id' => $createdProduct->id,
                    'category_id' => $categoryId
                ]);
            }
        }
    }
}
