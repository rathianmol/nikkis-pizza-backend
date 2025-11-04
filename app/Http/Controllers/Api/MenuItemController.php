<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
// use App\Models\MenuItemPrice;
// use App\Models\MenuItemAddon;
// use App\Models\AddonPrice;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;

class MenuItemController extends Controller
{
    // Get all menu items
    public function index()
    {
        $items = MenuItem::with(['category', 'prices', 'addons.prices'])
            ->where('is_available', true)
            ->orderBy('display_order')
            ->orderBy('title')
            ->get();

        return response()->json($items);
    }

    // Get menu items by category
    public function byCategory($categoryId)
    {
        $items = MenuItem::with(['prices', 'addons.prices'])
            ->where('category_id', $categoryId)
            ->where('is_available', true)
            ->orderBy('display_order')
            ->orderBy('title')
            ->get();

        return response()->json($items);
    }

    // Get single menu item
    public function show($id)
    {
        $item = MenuItem::with(['category', 'prices', 'addons.prices'])
            ->findOrFail($id);

        return response()->json($item);
    }

    // Create menu item
    // TODO: Move to admin level controller.
    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'category_id' => 'required|exists:categories,id',
    //         'title' => 'required|string|max:255',
    //         'description' => 'nullable|string',
    //         'image_url' => 'nullable|string',
    //         'has_sizes' => 'boolean',
    //         'has_addons' => 'boolean',
    //         'is_special' => 'boolean',
    //         'display_order' => 'nullable|integer',
            
    //         // Prices array
    //         'prices' => 'required|array|min:1',
    //         'prices.*.size' => 'required|in:default,regular,medium,large',
    //         'prices.*.price' => 'required|numeric|min:0',
            
    //         // Addons array (optional)
    //         'addons' => 'nullable|array',
    //         'addons.*.addon_name' => 'required|string|max:255',
    //         'addons.*.has_sizes' => 'boolean',
    //         'addons.*.prices' => 'required|array|min:1',
    //         'addons.*.prices.*.size' => 'required|in:default,regular,medium,large',
    //         'addons.*.prices.*.price' => 'required|numeric|min:0',
    //     ]);

    //     DB::beginTransaction();
    //     try {
    //         // Create menu item
    //         $menuItem = MenuItem::create([
    //             'category_id' => $validated['category_id'],
    //             'title' => $validated['title'],
    //             'description' => $validated['description'] ?? null,
    //             'image_url' => $validated['image_url'] ?? null,
    //             'has_sizes' => $validated['has_sizes'] ?? false,
    //             'has_addons' => $validated['has_addons'] ?? false,
    //             'is_special' => $validated['is_special'] ?? false,
    //             'display_order' => $validated['display_order'] ?? 0,
    //         ]);

    //         // Create prices
    //         foreach ($validated['prices'] as $priceData) {
    //             MenuItemPrice::create([
    //                 'menu_item_id' => $menuItem->id,
    //                 'size' => $priceData['size'],
    //                 'price' => $priceData['price'],
    //             ]);
    //         }

    //         // Create addons if provided
    //         if (!empty($validated['addons'])) {
    //             foreach ($validated['addons'] as $addonData) {
    //                 $addon = MenuItemAddon::create([
    //                     'menu_item_id' => $menuItem->id,
    //                     'addon_name' => $addonData['addon_name'],
    //                     'has_sizes' => $addonData['has_sizes'] ?? false,
    //                 ]);

    //                 // Create addon prices
    //                 foreach ($addonData['prices'] as $priceData) {
    //                     AddonPrice::create([
    //                         'addon_id' => $addon->id,
    //                         'size' => $priceData['size'],
    //                         'price' => $priceData['price'],
    //                     ]);
    //                 }
    //             }
    //         }

    //         DB::commit();

    //         return response()->json(
    //             MenuItem::with(['prices', 'addons.prices'])->find($menuItem->id),
    //             201
    //         );
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return response()->json(['error' => 'Failed to create menu item: ' . $e->getMessage()], 500);
    //     }
    // }

    // Update menu item
    // // TODO: Move to admin level controller.
    // public function update(Request $request, $id)
    // {
    //     $menuItem = MenuItem::findOrFail($id);

    //     $validated = $request->validate([
    //         'category_id' => 'exists:categories,id',
    //         'title' => 'string|max:255',
    //         'description' => 'nullable|string',
    //         'image_url' => 'nullable|string',
    //         'has_sizes' => 'boolean',
    //         'has_addons' => 'boolean',
    //         'is_available' => 'boolean',
    //         'is_special' => 'boolean',
    //         'display_order' => 'nullable|integer',
            
    //         // Prices array
    //         'prices' => 'nullable|array|min:1',
    //         'prices.*.size' => 'required|in:default,regular,medium,large',
    //         'prices.*.price' => 'required|numeric|min:0',
            
    //         // Addons array
    //         'addons' => 'nullable|array',
    //         'addons.*.id' => 'nullable|exists:menu_item_addons,id',
    //         'addons.*.addon_name' => 'required|string|max:255',
    //         'addons.*.has_sizes' => 'boolean',
    //         'addons.*.prices' => 'required|array|min:1',
    //         'addons.*.prices.*.size' => 'required|in:default,regular,medium,large',
    //         'addons.*.prices.*.price' => 'required|numeric|min:0',
    //     ]);

    //     DB::beginTransaction();
    //     try {
    //         // Update menu item basic info
    //         $menuItem->update(array_filter([
    //             'category_id' => $validated['category_id'] ?? $menuItem->category_id,
    //             'title' => $validated['title'] ?? $menuItem->title,
    //             'description' => $validated['description'] ?? $menuItem->description,
    //             'image_url' => $validated['image_url'] ?? $menuItem->image_url,
    //             'has_sizes' => $validated['has_sizes'] ?? $menuItem->has_sizes,
    //             'has_addons' => $validated['has_addons'] ?? $menuItem->has_addons,
    //             'is_available' => $validated['is_available'] ?? $menuItem->is_available,
    //             'is_special' => $validated['is_special'] ?? $menuItem->is_special,
    //             'display_order' => $validated['display_order'] ?? $menuItem->display_order,
    //         ]));

    //         // Update prices if provided
    //         if (isset($validated['prices'])) {
    //             // Delete old prices
    //             $menuItem->prices()->delete();
                
    //             // Create new prices
    //             foreach ($validated['prices'] as $priceData) {
    //                 MenuItemPrice::create([
    //                     'menu_item_id' => $menuItem->id,
    //                     'size' => $priceData['size'],
    //                     'price' => $priceData['price'],
    //                 ]);
    //             }
    //         }

    //         // Update addons if provided
    //         if (isset($validated['addons'])) {
    //             // Delete old addons (and their prices via cascade)
    //             $menuItem->addons()->delete();
                
    //             // Create new addons
    //             foreach ($validated['addons'] as $addonData) {
    //                 $addon = MenuItemAddon::create([
    //                     'menu_item_id' => $menuItem->id,
    //                     'addon_name' => $addonData['addon_name'],
    //                     'has_sizes' => $addonData['has_sizes'] ?? false,
    //                 ]);

    //                 // Create addon prices
    //                 foreach ($addonData['prices'] as $priceData) {
    //                     AddonPrice::create([
    //                         'addon_id' => $addon->id,
    //                         'size' => $priceData['size'],
    //                         'price' => $priceData['price'],
    //                     ]);
    //                 }
    //             }
    //         }

    //         DB::commit();

    //         return response()->json(
    //             MenuItem::with(['prices', 'addons.prices'])->find($menuItem->id)
    //         );
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return response()->json(['error' => 'Failed to update menu item: ' . $e->getMessage()], 500);
    //     }
    // }

    // Delete menu item
    // TODO: Move to admin level controller.
    // public function destroy($id)
    // {
    //     $menuItem = MenuItem::findOrFail($id);
    //     $menuItem->delete();

    //     return response()->json(['message' => 'Menu item deleted successfully']);
    // }

    // Toggle availability
    // TODO: Move to admin level controller.
    // public function toggleAvailability($id)
    // {
    //     $menuItem = MenuItem::findOrFail($id);
    //     $menuItem->is_available = !$menuItem->is_available;
    //     $menuItem->save();

    //     return response()->json([
    //         'message' => 'Availability updated',
    //         'is_available' => $menuItem->is_available
    //     ]);
    // }
}