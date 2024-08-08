<?php

namespace AIGenerate\Models\Database\Seeders;

use Illuminate\Database\Seeder;
use AIGenerate\Models\Stock\Enums\Status;
use AIGenerate\Models\Stock\StockStatus;

class StockStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect(Status::cases())->each(function ($item) {
            if (!StockStatus::where('code', $item->value)->exists()) {
                StockStatus::create([
                    'code' => $item->value,
                    'name' => $item->value,
                ]);
            }
        });
    }
}
