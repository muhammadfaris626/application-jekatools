<?php

namespace Database\Seeders;

use App\Models\ListPlanFeature;
use App\Models\Plan;
use App\Models\Product;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = [
            ['name' => '1 Bulan', 'duration' => 1],
            ['name' => '3 Bulan', 'duration' => 3],
            ['name' => '6 Bulan', 'duration' => 6],
            ['name' => 'Tahunan', 'duration' => 12],
        ];

        $products = Product::all();

        foreach ($products as $product) {
            foreach ($plans as $plan) {
                $randomPrice = match ($plan['duration']) {
                    1 => rand(80000, 150000),
                    3 => rand(200000, 300000),
                    6 => rand(400000, 600000),
                    12 => rand(700000, 1000000),
                    default => rand(100000, 500000)
                };

                $createdPlan = Plan::create([
                    'product_id' => $product->id,
                    'name' => $product->name . " " . $plan['name'],
                    'duration_months' => $plan['duration'],
                    'price' => $randomPrice,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

                // Menentukan berapa fitur yang aktif berdasarkan durasi
                $activeFeatureCount = match ($plan['duration']) {
                    1 => 2,
                    3 => 3,
                    6 => 4,
                    12 => 5,
                    default => 1
                };

                // Buat fitur 1 sampai 5
                for ($i = 1; $i <= 5; $i++) {
                    ListPlanFeature::create([
                        'plan_id' => $createdPlan->id,
                        'name' => "Fitur $i",
                        'status' => $i <= $activeFeatureCount ? 1 : 0,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
            }
        }
    }
}
