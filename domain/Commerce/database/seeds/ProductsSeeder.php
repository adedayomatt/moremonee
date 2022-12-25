<?php
namespace Domain\Commerce\Database\Seeds;

use Domain\Commerce\Models\Product;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'name' => 'Android K11 terminal',
                'short_description' => 'Full touch screen with printer',
                'description' => 'Full touch screen with printer',
                'in_stock' => 100,
                'status' => 'enabled',
                'price' => 150,
                'media' => [
                    [
                        "type" => "image",
                        "url" => "https://moremoneegroup.com/images/phone.png"
                    ],
                    [
                    "type" => "image",
                    "url" => "https://moremoneegroup.com/images/phone.png"
                    ]
                ]
            ]
        ];
        foreach ($products as $product) {
            Product::updateOrCreate(['name' => $product['name']], $product);
        }
    }
}
