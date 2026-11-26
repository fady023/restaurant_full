<?php

namespace Database\Seeders;

use App\Models\MenuItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
         $items = [
            ['Fried Eggs',         9.99,  'Breakfast',   'fried-eggs.png',         'Two eggs fried to order with toast and fresh herbs.'],
            ['Hawaiian Pizza',     15.99, 'Main Dishes', 'hawaiian-pizza.png',     'Ham, pineapple and mozzarella on a thin crust.'],
            ['Martinez Cocktail',  7.25,  'Drinks',      'martinez-cocktail.png',  'Gin, sweet vermouth and a hint of maraschino.'],
            ['Butterscotch Cake',  20.99, 'Desserts',    'butterscotch-cake.png',  'Soft sponge layered with butterscotch cream.'],
            ['Mint Lemonade',      12.55, 'Drinks',      'mint-lemonade.png',      'Fresh lemon juice with crushed mint and ice.'],
            ['Chocolate Icecream', 12.55, 'Desserts',    'chocolate-icecream.png', 'Rich chocolate ice cream with cocoa flakes.'],
            ['Cheese Burger',      12.55, 'Main Dishes', 'cheese-burger.png',      'Beef patty, cheddar, lettuce and house sauce.'],
            ['Classic Waffles',    12.55, 'Desserts',    'classic-waffles.png',    'Golden waffles served with maple syrup.'],
        ];

        foreach($items as [$name,$price,$category,$image,$description]){
            MenuItem::updateOrCreate(["name"=>$name],
            ["price"=>$price,
             "category"=>$category,
             "image"=>"images/menu/$image",
             "description"=>$description
            ]);
        }
    }
}
