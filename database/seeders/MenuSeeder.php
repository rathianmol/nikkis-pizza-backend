<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MenuCategory;
use App\Models\MenuItem;
use App\Models\MenuItemPrice;
use App\Models\MenuItemAddon;
use App\Models\MenuAddonPrice;

class MenuSeeder extends Seeder
{
    public function run()
    {
        // Create Categories
        $pizza = MenuCategory::create(['category_name' => 'Pizza', 'display_order' => 1]);
        $burger = MenuCategory::create(['category_name' => 'Burger', 'display_order' => 2]);
        $coffee = MenuCategory::create(['category_name' => 'Coffee', 'display_order' => 3]);
        $shakes = MenuCategory::create(['category_name' => 'Shakes', 'display_order' => 4]);
        $fries = MenuCategory::create(['category_name' => 'Fries', 'display_order' => 5]);
        $garlicBread = MenuCategory::create(['category_name' => 'Garlic Breads', 'display_order' => 6]);
        $sandwich = MenuCategory::create(['category_name' => 'Sandwich', 'display_order' => 7]);
        $wrap = MenuCategory::create(['category_name' => 'Wrap', 'display_order' => 8]);
        $pasta = MenuCategory::create(['category_name' => 'Pasta', 'display_order' => 9]);
        $hotPockets = MenuCategory::create(['category_name' => 'Hot Pockets', 'display_order' => 10]);
        $coolers = MenuCategory::create(['category_name' => 'Coolers', 'display_order' => 11]);
        $icedTea = MenuCategory::create(['category_name' => 'Iced Tea', 'display_order' => 12]);
        $desserts = MenuCategory::create(['category_name' => 'Desserts', 'display_order' => 13]);

        // PIZZAS (with sizes and addons)
        $margherita = MenuItem::create([
            'category_id' => $pizza->id,
            'title' => 'Margherita',
            'description' => 'Classic pizza with tomato sauce and mozzarella',
            'has_sizes' => true,
            'has_addons' => true,
        ]);
        MenuItemPrice::create(['menu_item_id' => $margherita->id, 'size' => 'regular', 'price' => 119]);
        MenuItemPrice::create(['menu_item_id' => $margherita->id, 'size' => 'medium', 'price' => 229]);
        MenuItemPrice::create(['menu_item_id' => $margherita->id, 'size' => 'large', 'price' => 339]);

        $exoticPineapple = MenuItem::create([
            'category_id' => $pizza->id,
            'title' => 'Exotic Pineapple',
            'description' => 'Sweet pineapple with cheese',
            'has_sizes' => true,
            'has_addons' => true,
        ]);
        MenuItemPrice::create(['menu_item_id' => $exoticPineapple->id, 'size' => 'regular', 'price' => 199]);
        MenuItemPrice::create(['menu_item_id' => $exoticPineapple->id, 'size' => 'medium', 'price' => 399]);
        MenuItemPrice::create(['menu_item_id' => $exoticPineapple->id, 'size' => 'large', 'price' => 499]);

        // Famous Five Pizza
        $famousFive = MenuItem::create([
            'category_id' => $pizza->id,
            'title' => 'Famous Five',
            'description' => 'Five amazing toppings',
            'has_sizes' => true,
            'has_addons' => true,
        ]);
        MenuItemPrice::create(['menu_item_id' => $famousFive->id, 'size' => 'regular', 'price' => 199]);
        MenuItemPrice::create(['menu_item_id' => $famousFive->id, 'size' => 'medium', 'price' => 399]);
        MenuItemPrice::create(['menu_item_id' => $famousFive->id, 'size' => 'large', 'price' => 499]);

        // Add Pizza Add-ons
        $extraCheese = MenuItemAddon::create([
            'menu_item_id' => $margherita->id,
            'addon_name' => 'Extra Cheese',
            'has_sizes' => true,
        ]);
        MenuAddonPrice::create(['addon_id' => $extraCheese->id, 'size' => 'regular', 'price' => 35]);
        MenuAddonPrice::create(['addon_id' => $extraCheese->id, 'size' => 'medium', 'price' => 45]);
        MenuAddonPrice::create(['addon_id' => $extraCheese->id, 'size' => 'large', 'price' => 55]);

        $cheeseDip = MenuItemAddon::create([
            'menu_item_id' => $margherita->id,
            'addon_name' => 'Cheesy Dip',
            'has_sizes' => false,
        ]);
        MenuAddonPrice::create(['addon_id' => $cheeseDip->id, 'size' => 'default', 'price' => 15]);

        $chipotleDip = MenuItemAddon::create([
            'menu_item_id' => $margherita->id,
            'addon_name' => 'Chipotle Dip',
            'has_sizes' => false,
        ]);
        MenuAddonPrice::create(['addon_id' => $chipotleDip->id, 'size' => 'default', 'price' => 15]);

        // BURGERS (no sizes, no addons)
        $alooTikkiBurger = MenuItem::create([
            'category_id' => $burger->id,
            'title' => 'Aloo Tikki Burger',
            'has_sizes' => false,
            'has_addons' => false,
        ]);
        MenuItemPrice::create(['menu_item_id' => $alooTikkiBurger->id, 'size' => 'default', 'price' => 69]);

        $classicVegBurger = MenuItem::create([
            'category_id' => $burger->id,
            'title' => 'Classic Veg Burger',
            'has_sizes' => false,
            'has_addons' => false,
        ]);
        MenuItemPrice::create(['menu_item_id' => $classicVegBurger->id, 'size' => 'default', 'price' => 69]);

        $spicyPaneerBurger = MenuItem::create([
            'category_id' => $burger->id,
            'title' => 'Spicy Paneer Burger',
            'has_sizes' => false,
            'has_addons' => false,
        ]);
        MenuItemPrice::create(['menu_item_id' => $spicyPaneerBurger->id, 'size' => 'default', 'price' => 79]);

        // COFFEE (no sizes, no addons)
        $classicColdCoffee = MenuItem::create([
            'category_id' => $coffee->id,
            'title' => 'Classic Cold Coffee (Lite)',
            'has_sizes' => false,
            'has_addons' => false,
        ]);
        MenuItemPrice::create(['menu_item_id' => $classicColdCoffee->id, 'size' => 'default', 'price' => 79]);

        $hazelnutColdCoffee = MenuItem::create([
            'category_id' => $coffee->id,
            'title' => 'Hazelnut Cold Coffee',
            'has_sizes' => false,
            'has_addons' => false,
        ]);
        MenuItemPrice::create(['menu_item_id' => $hazelnutColdCoffee->id, 'size' => 'default', 'price' => 89]);

        // SHAKES (no sizes, no addons)
        $oreoShake = MenuItem::create([
            'category_id' => $shakes->id,
            'title' => 'Oreo',
            'has_sizes' => false,
            'has_addons' => false,
            ]);
        MenuItemPrice::create(['menu_item_id' => $oreoShake->id, 'size' => 'default', 'price' => 99]);

        $kitkatShake = MenuItem::create([
            'category_id' => $shakes->id,
            'title' => 'Kitkat',
            'has_sizes' => false,
            'has_addons' => false,
        ]);
        MenuItemPrice::create(['menu_item_id' => $kitkatShake->id, 'size' => 'default', 'price' => 99]);

        $strawberryShake = MenuItem::create([
            'category_id' => $shakes->id,
            'title' => 'Strawberry',
            'has_sizes' => false,
            'has_addons' => false,
        ]);
        MenuItemPrice::create(['menu_item_id' => $strawberryShake->id, 'size' => 'default', 'price' => 99]);

        $chocolateShake = MenuItem::create([
            'category_id' => $shakes->id,
            'title' => 'Chocolate',
            'has_sizes' => false,
            'has_addons' => false,
        ]);
        MenuItemPrice::create(['menu_item_id' => $chocolateShake->id, 'size' => 'default', 'price' => 99]);

        // ICE CREAM SHAKES
        $chocoIceCreamShake = MenuItem::create([
            'category_id' => $shakes->id,
            'title' => 'Choco Brownie Ice Cream Shake',
            'has_sizes' => false,
            'has_addons' => false,
        ]);
        MenuItemPrice::create(['menu_item_id' => $chocoIceCreamShake->id, 'size' => 'default', 'price' => 139]);

        $blueberryIceCreamShake = MenuItem::create([
            'category_id' => $shakes->id,
            'title' => 'Very Very Blueberry Ice Cream Shake',
            'has_sizes' => false,
            'has_addons' => false,
        ]);
        MenuItemPrice::create(['menu_item_id' => $blueberryIceCreamShake->id, 'size' => 'default', 'price' => 149]);

        // FRIES (no sizes, no addons)
        $classicFries = MenuItem::create([
            'category_id' => $fries->id,
            'title' => 'Classic Fries',
            'has_sizes' => false,
            'has_addons' => false,
        ]);
        MenuItemPrice::create(['menu_item_id' => $classicFries->id, 'size' => 'default', 'price' => 69]);

        $masalaFries = MenuItem::create([
            'category_id' => $fries->id,
            'title' => 'Masala Fries',
            'has_sizes' => false,
            'has_addons' => false,
        ]);
        MenuItemPrice::create(['menu_item_id' => $masalaFries->id, 'size' => 'default', 'price' => 69]);

        $cheesyLoadedFries = MenuItem::create([
            'category_id' => $fries->id,
            'title' => 'Cheesy Loaded Fries (M-Jar)',
            'description' => 'Loaded with cheese',
            'has_sizes' => false,
            'has_addons' => false,
        ]);
        MenuItemPrice::create(['menu_item_id' => $cheesyLoadedFries->id, 'size' => 'default', 'price' => 89]);

        $perperiCheesyFries = MenuItem::create([
            'category_id' => $fries->id,
            'title' => 'Peri-Peri Cheesy Loaded Fries (M-Jar)',
            'description' => 'Spicy peri-peri with cheese',
            'has_sizes' => false,
            'has_addons' => false,
        ]);
        MenuItemPrice::create(['menu_item_id' => $perperiCheesyFries->id, 'size' => 'default', 'price' => 149]);

        // GARLIC BREADS (no sizes, no addons)
        $cheeseGarlicBread = MenuItem::create([
            'category_id' => $garlicBread->id,
            'title' => 'Cheese Garlic Bread',
            'has_sizes' => false,
            'has_addons' => false,
        ]);
        MenuItemPrice::create(['menu_item_id' => $cheeseGarlicBread->id, 'size' => 'default', 'price' => 89]);

        $cheeseGarlicBreadsticks = MenuItem::create([
            'category_id' => $garlicBread->id,
            'title' => 'Cheese Garlic Breadsticks',
            'has_sizes' => false,
            'has_addons' => false,
        ]);
        MenuItemPrice::create(['menu_item_id' => $cheeseGarlicBreadsticks->id, 'size' => 'default', 'price' => 99]);

        $stuffedGarlicBreadsticks = MenuItem::create([
            'category_id' => $garlicBread->id,
            'title' => 'Stuffed Garlic Breadsticks',
            'has_sizes' => false,
            'has_addons' => false,
        ]);
        MenuItemPrice::create(['menu_item_id' => $stuffedGarlicBreadsticks->id, 'size' => 'default', 'price' => 109]);

        $paneerStuffedGarlicBreadsticks = MenuItem::create([
            'category_id' => $garlicBread->id,
            'title' => 'Paneer Stuffed Garlic Breadsticks',
            'has_sizes' => false,
            'has_addons' => false,
        ]);
        MenuItemPrice::create(['menu_item_id' => $paneerStuffedGarlicBreadsticks->id, 'size' => 'default', 'price' => 139]);

        // SANDWICHES (no sizes, no addons)
        $vegSandwich = MenuItem::create([
            'category_id' => $sandwich->id,
            'title' => 'Veg Sandwich',
            'has_sizes' => false,
            'has_addons' => false,
        ]);
        MenuItemPrice::create(['menu_item_id' => $vegSandwich->id, 'size' => 'default', 'price' => 79]);

        $cornCheeseSandwich = MenuItem::create([
            'category_id' => $sandwich->id,
            'title' => 'Corn Cheese Sandwich',
            'has_sizes' => false,
            'has_addons' => false,
        ]);
        MenuItemPrice::create(['menu_item_id' => $cornCheeseSandwich->id, 'size' => 'default', 'price' => 89]);

        $spicyPaneerSandwich = MenuItem::create([
            'category_id' => $sandwich->id,
            'title' => 'Spicy Paneer Sandwich',
            'has_sizes' => false,
            'has_addons' => false,
        ]);
        MenuItemPrice::create(['menu_item_id' => $spicyPaneerSandwich->id, 'size' => 'default', 'price' => 79]);

        $paneerTikkaSandwich = MenuItem::create([
            'category_id' => $sandwich->id,
            'title' => 'Paneer Tikka Sandwich',
            'has_sizes' => false,
            'has_addons' => false,
        ]);
        MenuItemPrice::create(['menu_item_id' => $paneerTikkaSandwich->id, 'size' => 'default', 'price' => 89]);

        $mushroomCheeseSandwich = MenuItem::create([
            'category_id' => $sandwich->id,
            'title' => 'Mushroom Cheese Sandwich',
            'has_sizes' => false,
            'has_addons' => false,
        ]);
        MenuItemPrice::create(['menu_item_id' => $mushroomCheeseSandwich->id, 'size' => 'default', 'price' => 99]);

        $pizzaSandwich = MenuItem::create([
            'category_id' => $sandwich->id,
            'title' => 'Pizza Sandwich',
            'description' => 'Chef Special',
            'has_sizes' => false,
            'has_addons' => false,
            'is_special' => true,
        ]);
        MenuItemPrice::create(['menu_item_id' => $pizzaSandwich->id, 'size' => 'default', 'price' => 149]);

        // WRAPS (no sizes, no addons)
        $crispyVegWrap = MenuItem::create([
            'category_id' => $wrap->id,
            'title' => 'Crispy Veg Wrap',
            'has_sizes' => false,
            'has_addons' => false,
        ]);
        MenuItemPrice::create(['menu_item_id' => $crispyVegWrap->id, 'size' => 'default', 'price' => 59]);

        $spicyVegWrap = MenuItem::create([
            'category_id' => $wrap->id,
            'title' => 'Spicy Veg Wrap',
            'has_sizes' => false,
            'has_addons' => false,
        ]);
        MenuItemPrice::create(['menu_item_id' => $spicyVegWrap->id, 'size' => 'default', 'price' => 79]);

        $paneerWrap = MenuItem::create([
            'category_id' => $wrap->id,
            'title' => 'Paneer Wrap',
            'has_sizes' => false,
            'has_addons' => false,
        ]);
        MenuItemPrice::create(['menu_item_id' => $paneerWrap->id, 'size' => 'default', 'price' => 89]);

        $tandooriPaneerWrap = MenuItem::create([
            'category_id' => $wrap->id,
            'title' => 'Tandoori Paneer Wrap',
            'has_sizes' => false,
            'has_addons' => false,
        ]);
        MenuItemPrice::create(['menu_item_id' => $tandooriPaneerWrap->id, 'size' => 'default', 'price' => 109]);

        // PASTA (no sizes, no addons)
        $redSaucePasta = MenuItem::create([
            'category_id' => $pasta->id,
            'title' => 'Red Sauce Penne Pasta',
            'has_sizes' => false,
            'has_addons' => false,
        ]);
        MenuItemPrice::create(['menu_item_id' => $redSaucePasta->id, 'size' => 'default', 'price' => 149]);

        $whiteSaucePasta = MenuItem::create([
            'category_id' => $pasta->id,
            'title' => 'White Sauce Penne Pasta',
            'has_sizes' => false,
            'has_addons' => false,
        ]);
        MenuItemPrice::create(['menu_item_id' => $whiteSaucePasta->id, 'size' => 'default', 'price' => 149]);

        $mixSaucePasta = MenuItem::create([
            'category_id' => $pasta->id,
            'title' => 'Mix Sauce Penne Pasta',
            'has_sizes' => false,
            'has_addons' => false,
        ]);
        MenuItemPrice::create(['menu_item_id' => $mixSaucePasta->id, 'size' => 'default', 'price' => 169]);

        $mushroomPasta = MenuItem::create([
            'category_id' => $pasta->id,
            'title' => 'Mushroom Penne Pasta',
            'has_sizes' => false,
            'has_addons' => false,
        ]);
        MenuItemPrice::create(['menu_item_id' => $mushroomPasta->id, 'size' => 'default', 'price' => 179]);

        $pizzakartSpecialPasta = MenuItem::create([
            'category_id' => $pasta->id,
            'title' => 'Pizzakart Special Penne Pasta',
            'has_sizes' => false,
            'has_addons' => false,
            'is_special' => true,
        ]);
        MenuItemPrice::create(['menu_item_id' => $pizzakartSpecialPasta->id, 'size' => 'default', 'price' => 189]);

        // HOT POCKETS (no sizes, no addons)
        $hotPockets = MenuItem::create([
            'category_id' => $hotPockets->id,
            'title' => 'Hot Pockets',
            'has_sizes' => false,
            'has_addons' => false,
        ]);
        MenuItemPrice::create(['menu_item_id' => $hotPockets->id, 'size' => 'default', 'price' => 69]);

        $stuffedHotPockets = MenuItem::create([
            'category_id' => $hotPockets->id,
            'title' => 'Stuffed Hot Pockets',
            'has_sizes' => false,
            'has_addons' => false,
        ]);
        MenuItemPrice::create(['menu_item_id' => $stuffedHotPockets->id, 'size' => 'default', 'price' => 109]);

        $paneerStuffedHotPockets = MenuItem::create([
            'category_id' => $hotPockets->id,
            'title' => 'Paneer Stuffed Hot Pockets',
            'description' => 'Chef Special',
            'has_sizes' => false,
            'has_addons' => false,
            'is_special' => true,
        ]);
        MenuItemPrice::create(['menu_item_id' => $paneerStuffedHotPockets->id, 'size' => 'default', 'price' => 109]);

        $tandooriPaneerHotPockets = MenuItem::create([
            'category_id' => $hotPockets->id,
            'title' => 'Tandoori Paneer Hot Pockets',
            'description' => 'Chef Special',
            'has_sizes' => false,
            'has_addons' => false,
            'is_special' => true,
        ]);
        MenuItemPrice::create(['menu_item_id' => $tandooriPaneerHotPockets->id, 'size' => 'default', 'price' => 129]);

        // COOLERS (no sizes, no addons)
        $mintMojito = MenuItem::create([
            'category_id' => $coolers->id,
            'title' => 'Mint Mojito',
            'has_sizes' => false,
            'has_addons' => false,
        ]);
        MenuItemPrice::create(['menu_item_id' => $mintMojito->id, 'size' => 'default', 'price' => 89]);

        $strawberryMojito = MenuItem::create([
            'category_id' => $coolers->id,
            'title' => 'Strawberry Mojito',
            'has_sizes' => false,
            'has_addons' => false,
        ]);
        MenuItemPrice::create(['menu_item_id' => $strawberryMojito->id, 'size' => 'default', 'price' => 99]);

        $blueberryMojito = MenuItem::create([
            'category_id' => $coolers->id,
            'title' => 'Blueberry Mojito',
            'has_sizes' => false,
            'has_addons' => false,
        ]);
        MenuItemPrice::create(['menu_item_id' => $blueberryMojito->id, 'size' => 'default', 'price' => 99]);

        $watermelonMojito = MenuItem::create([
            'category_id' => $coolers->id,
            'title' => 'Watermelon Mojito',
            'has_sizes' => false,
            'has_addons' => false,
        ]);
        MenuItemPrice::create(['menu_item_id' => $watermelonMojito->id, 'size' => 'default', 'price' => 99]);

        $greenAppleMojito = MenuItem::create([
            'category_id' => $coolers->id,
            'title' => 'Green Apple Mojito',
            'has_sizes' => false,
            'has_addons' => false,
        ]);
        MenuItemPrice::create(['menu_item_id' => $greenAppleMojito->id, 'size' => 'default', 'price' => 99]);

        $blueOcean = MenuItem::create([
            'category_id' => $coolers->id,
            'title' => 'Blue Ocean',
            'has_sizes' => false,
            'has_addons' => false,
        ]);
        MenuItemPrice::create(['menu_item_id' => $blueOcean->id, 'size' => 'default', 'price' => 99]);

        $bubbleGumMojito = MenuItem::create([
            'category_id' => $coolers->id,
            'title' => 'Bubble Gum Mojito',
            'has_sizes' => false,
            'has_addons' => false,
        ]);
        MenuItemPrice::create(['menu_item_id' => $bubbleGumMojito->id, 'size' => 'default', 'price' => 99]);

        $softDrink = MenuItem::create([
            'category_id' => $coolers->id,
            'title' => 'Soft Drink',
            'has_sizes' => false,
            'has_addons' => false,
        ]);
        MenuItemPrice::create(['menu_item_id' => $softDrink->id, 'size' => 'default', 'price' => 25]);

        // ICED TEA (no sizes, no addons)
        $lemonIceTea = MenuItem::create([
            'category_id' => $icedTea->id,
            'title' => 'Lemon Ice Tea',
            'has_sizes' => false,
            'has_addons' => false,
        ]);
        MenuItemPrice::create(['menu_item_id' => $lemonIceTea->id, 'size' => 'default', 'price' => 89]);

        $peachIceTea = MenuItem::create([
            'category_id' => $icedTea->id,
            'title' => 'Peach Ice Tea',
            'has_sizes' => false,
            'has_addons' => false,
        ]);
        MenuItemPrice::create(['menu_item_id' => $peachIceTea->id, 'size' => 'default', 'price' => 89]);

        $lemonMintIceTea = MenuItem::create([
            'category_id' => $icedTea->id,
            'title' => 'Lemon & Mint Ice Tea',
            'has_sizes' => false,
            'has_addons' => false,
        ]);
        MenuItemPrice::create(['menu_item_id' => $lemonMintIceTea->id, 'size' => 'default', 'price' => 99]);

        $greenAppleIceTea = MenuItem::create([
            'category_id' => $icedTea->id,
            'title' => 'Green Apple Ice Tea',
            'has_sizes' => false,
            'has_addons' => false,
        ]);
        MenuItemPrice::create(['menu_item_id' => $greenAppleIceTea->id, 'size' => 'default', 'price' => 99]);

        // DESSERTS (no sizes, no addons)
        $chocoLava = MenuItem::create([
            'category_id' => $desserts->id,
            'title' => 'Choco Lava',
            'has_sizes' => false,
            'has_addons' => false,
        ]);
        MenuItemPrice::create(['menu_item_id' => $chocoLava->id, 'size' => 'default', 'price' => 69]);

        $iceCreamVanilla = MenuItem::create([
            'category_id' => $desserts->id,
            'title' => 'Ice Cream (Vanilla/Chocolate)',
            'has_sizes' => false,
            'has_addons' => false,
        ]);
        MenuItemPrice::create(['menu_item_id' => $iceCreamVanilla->id, 'size' => 'default', 'price' => 39]);

        $brownieIceCream = MenuItem::create([
            'category_id' => $desserts->id,
            'title' => 'Brownie With Ice Cream',
            'has_sizes' => false,
            'has_addons' => false,
        ]);
        MenuItemPrice::create(['menu_item_id' => $brownieIceCream->id, 'size' => 'default', 'price' => 119]);

        // Add more pizza items with addons
        $vegLoaded = MenuItem::create([
            'category_id' => $pizza->id,
            'title' => 'Veggie Loaded',
            'description' => 'Loaded with fresh vegetables',
            'has_sizes' => true,
            'has_addons' => true,
        ]);
        MenuItemPrice::create(['menu_item_id' => $vegLoaded->id, 'size' => 'regular', 'price' => 149]);
        MenuItemPrice::create(['menu_item_id' => $vegLoaded->id, 'size' => 'medium', 'price' => 279]);
        MenuItemPrice::create(['menu_item_id' => $vegLoaded->id, 'size' => 'large', 'price' => 369]);

        // Add common pizza addons for all pizzas
        $this->addPizzaAddons($vegLoaded->id);
        $this->addPizzaAddons($exoticPineapple->id);
        $this->addPizzaAddons($famousFive->id);

        echo "Menu seeded successfully!\n";
    }

    private function addPizzaAddons($menuItemId)
    {
        // Extra Cheese
        $extraCheese = MenuItemAddon::create([
            'menu_item_id' => $menuItemId,
            'addon_name' => 'Extra Cheese',
            'has_sizes' => true,
        ]);
        MenuAddonPrice::create(['addon_id' => $extraCheese->id, 'size' => 'regular', 'price' => 35]);
        MenuAddonPrice::create(['addon_id' => $extraCheese->id, 'size' => 'medium', 'price' => 45]);
        MenuAddonPrice::create(['addon_id' => $extraCheese->id, 'size' => 'large', 'price' => 55]);

        // Extra Toppings
        $extraToppings = MenuItemAddon::create([
            'menu_item_id' => $menuItemId,
            'addon_name' => 'Extra Toppings',
            'has_sizes' => true,
        ]);
        MenuAddonPrice::create(['addon_id' => $extraToppings->id, 'size' => 'regular', 'price' => 35]);
        MenuAddonPrice::create(['addon_id' => $extraToppings->id, 'size' => 'medium', 'price' => 45]);
        MenuAddonPrice::create(['addon_id' => $extraToppings->id, 'size' => 'large', 'price' => 55]);

        // Cheese Burst
        $cheeseBurst = MenuItemAddon::create([
            'menu_item_id' => $menuItemId,
            'addon_name' => 'Cheese Burst',
            'has_sizes' => true,
        ]);
        MenuAddonPrice::create(['addon_id' => $cheeseBurst->id, 'size' => 'regular', 'price' => 35]);
        MenuAddonPrice::create(['addon_id' => $cheeseBurst->id, 'size' => 'medium', 'price' => 45]);
        MenuAddonPrice::create(['addon_id' => $cheeseBurst->id, 'size' => 'large', 'price' => 65]);

        // Fresh Pan
        $freshPan = MenuItemAddon::create([
            'menu_item_id' => $menuItemId,
            'addon_name' => 'Fresh Pan',
            'has_sizes' => true,
        ]);
        MenuAddonPrice::create(['addon_id' => $freshPan->id, 'size' => 'regular', 'price' => 35]);
        MenuAddonPrice::create(['addon_id' => $freshPan->id, 'size' => 'medium', 'price' => 45]);
        MenuAddonPrice::create(['addon_id' => $freshPan->id, 'size' => 'large', 'price' => 55]);

        // Cheesy Dip
        $cheesyDip = MenuItemAddon::create([
            'menu_item_id' => $menuItemId,
            'addon_name' => 'Cheesy Dip',
            'has_sizes' => false,
        ]);
        MenuAddonPrice::create(['addon_id' => $cheesyDip->id, 'size' => 'default', 'price' => 15]);

        // Jalapeño Dip
        $jalapenoDip = MenuItemAddon::create([
            'menu_item_id' => $menuItemId,
            'addon_name' => 'Jalapeño Dip',
            'has_sizes' => false,
        ]);
        MenuAddonPrice::create(['addon_id' => $jalapenoDip->id, 'size' => 'default', 'price' => 15]);

        // Chipotle Dip
        $chipotleDip = MenuItemAddon::create([
            'menu_item_id' => $menuItemId,
            'addon_name' => 'Chipotle Dip',
            'has_sizes' => false,
        ]);
        MenuAddonPrice::create(['addon_id' => $chipotleDip->id, 'size' => 'default', 'price' => 15]);

        // Chef Special Dip
        $chefSpecialDip = MenuItemAddon::create([
            'menu_item_id' => $menuItemId,
            'addon_name' => 'Chef Special Dip',
            'has_sizes' => false,
        ]);
        MenuAddonPrice::create(['addon_id' => $chefSpecialDip->id, 'size' => 'default', 'price' => 20]);

        // Cheese Slice
        $cheeseSlice = MenuItemAddon::create([
            'menu_item_id' => $menuItemId,
            'addon_name' => 'Cheese Slice',
            'has_sizes' => false,
        ]);
        MenuAddonPrice::create(['addon_id' => $cheeseSlice->id, 'size' => 'default', 'price' => 20]);
    }
}