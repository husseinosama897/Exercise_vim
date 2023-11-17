<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        User::Create([
            'name'=>'admin',
            'email'=>'admin@admin.com',
            'password'=>Hash::make(12345678),
            'User_type'=>'admin'
        ]);

        User::factory()->count(50)->create();
    }
}
