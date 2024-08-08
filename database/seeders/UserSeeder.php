<?php

namespace AIGenerate\Models\Database\Seeders;

use Database\Factories\User\UserFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Throwable;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (env('APP_ENV') == 'local') {
            try {
                for ($i = 0; $i < 1000; $i++) {
                    if ($i == 0) {
                        $user = UserFactory::new()->make([
                            'email' => 'lehner.michele@example.org'
                        ]);
                    } else {
                        $user = UserFactory::new()->make();
                    }
                    $user->saveQuietly();
                    $user->count()->create();
                    $user->constant()->create();
                    $user->information()->create([
                        'google_id' => Str::random(16),
                        'locale' => 'kr',
                    ]);
                }
            } catch (Throwable $throwable) {
            }
        }
    }
}
