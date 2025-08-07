<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pizza;

class PizzaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pizzas = [
            [
                'title' => 'Spinach Pizza',
                // 'image' => 'images/spinach-pizza.jpg',
                'description' => 'This cheesy spinach pie combines store-bought Alfredo sauce with delicate baby spinach and chopped tomatoes. For extra pizazz, top it with chopped artichoke hearts.',
                'price_small' => 8.99,
                'price_medium' => 11.99,
                'price_large' => 14.99,
                'price_x_large' => 17.99,
            ],
            [
                'title' => 'Wild Mushroom Pizza',
                // 'image' => 'images/mushroom-pizza.jpg',
                'description' => 'Earthy mushrooms were made for this elegant white pizza, which features three types of cheese: Gruyere, Parmesan and cream cheese. Mix and match your favorite mushroom varieties with fresh herbs like rosemary, sage or chives.',
                'price_small' => 9.99,
                'price_medium' => 12.99,
                'price_large' => 15.99,
                'price_x_large' => 18.99,
            ],
            [
                'title' => 'Margherita Pizza',
                // 'image' => 'images/margherita-pizza.jpg',
                'description' => 'This recipe is a classic for a reason! Margherita is one of the easiest vegetarian pizzas, and its simplicity really allows the flavors of the tomato sauce and crust to shine.',
                'price_small' => 7.99,
                'price_medium' => 10.99,
                'price_large' => 13.99,
                'price_x_large' => 16.99,
            ],
            [
                'title' => 'Pesto Pizza',
                // 'image' => 'images/pesto-pizza.jpg',
                'description' => 'Made with homemade pesto spread atop this crowd-pleasing pizza. Simple with just pesto, mozzarella cheese and sliced tomatoes, but perfect for adding grilled veggies, olives or burrata.',
                'price_small' => 8.49,
                'price_medium' => 11.49,
                'price_large' => 14.49,
                'price_x_large' => 17.49,
            ],
            [
                'title' => 'Zucchini Crust Pizza',
                // 'image' => 'images/zucchini-crust-pizza.jpg',
                'description' => 'Besides the veggie toppings, this pizza also has a veggie crust! This zucchini crust pizza is loaded with wholesome ingredients you can feel good about.',
                'price_small' => 9.49,
                'price_medium' => 12.49,
                'price_large' => 15.49,
                'price_x_large' => 18.49,
            ],
            [
                'title' => 'Grilled Veggie Pizza',
                'image' => 'images/grilled-veggie-pizza.jpg',
                'description' => 'Grilling pizza instead of baking it adds a touch of charred flavor. This loaded veggie pie uses prebaked whole-wheat pizza crust with a variety of grilled vegetables.',
                'price_small' => 10.99,
                'price_medium' => 13.99,
                'price_large' => 16.99,
                'price_x_large' => 19.99,
            ],
            [
                'title' => 'New York-Style Pizza',
                // 'image' => 'images/ny-style-pizza.jpg',
                'description' => 'Defined by its thin, floppy crust and extra-large size. Made with homemade dough, tomato sauce and shredded mozzarella cheese. Can be made as a white pizza with different cheese types.',
                'price_small' => 8.99,
                'price_medium' => 11.99,
                'price_large' => 14.99,
                'price_x_large' => 17.99,
            ],
            [
                'title' => 'White Pizza',
                // 'image' => 'images/white-pizza.jpg',
                'description' => 'The key to perfect white pizza is high-quality cheese and loads of aromatic garlic. Olive oil plays a big role in the flavor, creating a rich and indulgent experience.',
                'price_small' => 9.49,
                'price_medium' => 12.49,
                'price_large' => 15.49,
                'price_x_large' => 18.49,
            ],
            [
                'title' => 'Loaded Mexican Pizza',
                // 'image' => 'images/mexican-pizza.jpg',
                'description' => 'A zesty, black bean-topped pizza inspired by taco flavors. Perfect served with pico de gallo or guacamole on the side for an authentic Mexican experience.',
                'price_small' => 10.49,
                'price_medium' => 13.49,
                'price_large' => 16.49,
                'price_x_large' => 19.49,
            ],
            [
                'title' => 'Italian-Style Mini Pizzas',
                // 'image' => 'images/italian-style-pizzas.jpg',
                'description' => 'Party-friendly mini pizzas loaded with your favorite vegetarian toppings. Made with mini crusts, pita bread or naan for perfect individual servings.',
                'price_small' => 7.49,
                'price_medium' => 10.49,
                'price_large' => 13.49,
                'price_x_large' => 16.49,
            ],
            [
                'title' => 'Greek Isle Pizza',
                // 'image' => 'images/greek-pizza.jpg',
                'description' => 'Mediterranean-inspired pie with crumbly feta, briny olives and sun-dried tomatoes. Cherry tomatoes, marinated olives, roasted red peppers and pepperoncini make perfect additions.',
                'price_small' => 9.99,
                'price_medium' => 12.99,
                'price_large' => 15.99,
                'price_x_large' => 18.99,
            ],
            [
                'title' => 'Cauliflower Crust Pizza',
                // 'image' => 'images/cauliflower-pizza.jpg',
                'description' => 'Golden, cheesy cauliflower crust is naturally gluten-free and tastes just as good as traditional crust. The nutty crust pairs perfectly with any sauce, cheese and toppings.',
                'price_small' => 10.99,
                'price_medium' => 13.99,
                'price_large' => 16.99,
                'price_x_large' => 19.99,
            ],
            [
                'title' => 'Shakshuka Breakfast Pizza',
                // 'image' => 'images/shakshuka-pizza.jpg',
                'description' => 'Richly spiced eggs poached in aromatic tomato sauce on pizza form. Perfect for brunch parties served alongside fresh fruit and mimosas.',
                'price_small' => 11.49,
                'price_medium' => 14.49,
                'price_large' => 17.49,
                'price_x_large' => 20.49,
            ],
            [
                'title' => 'Pizza Caprese',
                // 'image' => 'images/pizza-caprese.jpg',
                'description' => 'A delicious riff on the classic Italian caprese salad. Simple and satisfying with fresh mozzarella, tomatoes, and basil on a crispy crust.',
                'price_small' => 8.99,
                'price_medium' => 11.99,
                'price_large' => 14.99,
                'price_x_large' => 17.99,
            ],
            [
                'title' => 'Vegan Pizza',
                // 'image' => 'images/vegan-pizza.jpg',
                'description' => 'Dairy-free pizza with a crackling homemade crust and colorful roasted vegetables. Made with plant-based cheese alternatives for a completely vegan experience.',
                'price_small' => 10.49,
                'price_medium' => 13.49,
                'price_large' => 16.49,
                'price_x_large' => 19.49,
            ],
            [
                'title' => 'Flatbread Pizza',
                // 'image' => 'images/flatbread-pizza.jpg',
                'description' => 'Quick and easy pizza that comes together in just 30 minutes including rise time. Made with all-purpose flour and topped with your favorite vegetables.',
                'price_small' => 7.99,
                'price_medium' => 10.99,
                'price_large' => 13.99,
                'price_x_large' => 16.99,
            ],
        ];

        foreach ($pizzas as $pizza) {
            Pizza::create($pizza);
        }
    }
}
