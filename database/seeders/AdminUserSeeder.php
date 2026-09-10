<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Seed the default local-development administrator account.
     */
    public function run(): void
    {
        if (! app()->environment(['local', 'testing'])) {
            return;
        }

        $admin = User::query()->firstOrNew([
            'email' => 'self-study@admin.com',
        ]);

        $admin->name = 'Admin';
        $admin->password = Hash::make('password123');
        $admin->role = 'admin';
        $admin->save();
    }
}
