<?php

namespace AIGenerate\Models\Database\Seeders;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\database\seeders\PointSeeder;
use App\Modules\Models\database\seeders\StockReviewTypeSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            StockReviewTypeSeeder::class,
            StripeWebhookTypeSeeder::class,
            StripeStatusSeeder::class,
            UserSeeder::class,
            PromptTypeSeeder::class,
            PromptStatusSeeder::class,
            PromptSeeder::class,
            PromptCategorySeeder::class,
            PointTypeSeeder::class,
            PointSeeder::class,
            StripeSetSeeder::class,
        ]);
    }
}
