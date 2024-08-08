<?php

namespace AIGenerate\Models\Database\Seeders;

use App\Services\Point\Enums\Types;
use Illuminate\Database\Seeder;
use AIGenerate\Models\Payment\PointHistory;

class PointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (env('APP_ENV') == 'local') {
            PointHistory::create([
                'user_id' => 1,
                'point' => 10000,
                'remained' => 10000,
                'point_type_code' => Types::Plus->value,
                'description' => 'test',
            ]);
        }
    }
}
