<?php

namespace Database\Seeders;

use App\Models\MenuItem;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'FoodDrop Admin',
            'email' => 'admin@fooddrop.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'FoodDrop User',
            'email' => 'user@fooddrop.test',
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);

        $palette = ['#ffb703', '#219ebc', '#8ecae6', '#fb8500', '#90be6d'];

        Storage::disk('public')->makeDirectory('seed/restaurants');
        Storage::disk('public')->makeDirectory('seed/menu-items');

        $restaurants = [
            [
                'name' => 'Sunset Grill',
                'category' => 'Burgers',
                'description' => 'Classic burgers, crispy fries, and comfort food favorites.',
            ],
            [
                'name' => 'Little Napoli',
                'category' => 'Pizza',
                'description' => 'Stone baked pizzas and fresh Italian sides made daily.',
            ],
            [
                'name' => 'Green Leaf Kitchen',
                'category' => 'Healthy',
                'description' => 'Fresh bowls, salads, and light meals with local ingredients.',
            ],
            [
                'name' => 'Sakura Sushi',
                'category' => 'Sushi',
                'description' => 'Sushi rolls, sashimi, and Japanese comfort classics.',
            ],
            [
                'name' => 'Sweet Oven',
                'category' => 'Desserts',
                'description' => 'Desserts, pastries, and sweet treats baked all day.',
            ],
        ];

        $menuTemplates = [
            [
                'name' => 'Classic Cheeseburger',
                'description' => 'Beef patty, cheddar, lettuce, tomato, and house sauce.',
                'price' => 9.90,
            ],
            [
                'name' => 'Crispy Chicken Wrap',
                'description' => 'Golden chicken, crunchy slaw, and creamy garlic sauce.',
                'price' => 8.50,
            ],
            [
                'name' => 'Margherita Pizza',
                'description' => 'Fresh mozzarella, tomato sauce, and basil.',
                'price' => 12.00,
            ],
            [
                'name' => 'Spicy Pepperoni Slice',
                'description' => 'Classic pepperoni with a spicy kick and melted cheese.',
                'price' => 10.50,
            ],
            [
                'name' => 'Mediterranean Veggie Bowl',
                'description' => 'Grains, roasted veggies, hummus, and herbs.',
                'price' => 11.25,
            ],
            [
                'name' => 'Chicken Teriyaki',
                'description' => 'Grilled chicken glazed with sweet teriyaki sauce.',
                'price' => 13.40,
            ],
            [
                'name' => 'Sushi Combo',
                'description' => 'A mix of nigiri and rolls with soy and wasabi.',
                'price' => 15.60,
            ],
            [
                'name' => 'Pad Thai Noodles',
                'description' => 'Rice noodles, peanuts, fresh herbs, and tangy sauce.',
                'price' => 12.75,
            ],
            [
                'name' => 'Chocolate Brownie',
                'description' => 'Rich chocolate brownie with a soft center.',
                'price' => 6.20,
            ],
            [
                'name' => 'Classic Caesar Salad',
                'description' => 'Romaine, parmesan, croutons, and Caesar dressing.',
                'price' => 9.30,
            ],
            [
                'name' => 'Slow Cooked BBQ Ribs',
                'description' => 'Tender ribs with smoky BBQ glaze.',
                'price' => 16.80,
            ],
            [
                'name' => 'Seafood Pasta',
                'description' => 'Pasta tossed with shrimp and creamy garlic sauce.',
                'price' => 14.90,
            ],
        ];

        foreach ($restaurants as $index => $data) {
            $restaurantImage = $this->storeSeedImage(
                'seed/restaurants/restaurant-'.($index + 1).'.svg',
                $data['name'],
                $palette[$index % count($palette)]
            );

            $restaurant = Restaurant::create([
                'name' => $data['name'],
                'description' => $data['description'],
                'category' => $data['category'],
                'image_path' => $restaurantImage,
                'is_active' => true,
            ]);

            $items = collect($menuTemplates)->shuffle()->take(random_int(8, 12));

            foreach ($items as $itemIndex => $item) {
                $itemImage = $this->storeSeedImage(
                    'seed/menu-items/'.$restaurant->id.'-'.Str::slug($item['name']).'.svg',
                    $item['name'],
                    $palette[$itemIndex % count($palette)]
                );

                MenuItem::create([
                    'restaurant_id' => $restaurant->id,
                    'name' => $item['name'],
                    'description' => $item['description'],
                    'price' => $item['price'],
                    'image_path' => $itemImage,
                    'is_available' => true,
                ]);
            }
        }
    }

    private function storeSeedImage(string $path, string $label, string $color): string
    {
        Storage::disk('public')->put($path, $this->svgCard($label, $color));

        return $path;
    }

    private function svgCard(string $label, string $color): string
    {
        $safeLabel = htmlspecialchars($label, ENT_QUOTES, 'UTF-8');

        return <<<SVG
<svg width="800" height="500" viewBox="0 0 800 500" fill="none" xmlns="http://www.w3.org/2000/svg">
  <rect width="800" height="500" rx="24" fill="{$color}"/>
  <rect x="60" y="60" width="680" height="380" rx="20" fill="white" opacity="0.18"/>
  <text x="400" y="260" text-anchor="middle" font-family="Arial, sans-serif" font-size="34" fill="#ffffff">{$safeLabel}</text>
  <text x="400" y="305" text-anchor="middle" font-family="Arial, sans-serif" font-size="18" fill="#ffffff">FoodDrop</text>
</svg>
SVG;
    }
}
