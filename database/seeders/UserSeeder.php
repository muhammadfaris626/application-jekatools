<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat 200 user
        $users = User::factory(100)->create();

        $referralCodes = $users->pluck('referral_code');

        foreach ($users as $user) {
            // 50% kemungkinan di-refer oleh user lain
            if (rand(0, 1)) {
                $randomReferral = $referralCodes->random();

                // Hindari referal ke diri sendiri
                if ($randomReferral !== $user->referral_code) {
                    $user->referred_by = $randomReferral;
                    $user->save();
                }
            }
        }
    }
}
