<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'name' => 'Ibrahim Khashaba',
            'email' => 'ibrahim@admin.com',
            'password' => bcrypt('789789789'),
            'role_id' => Role::first()->id,
        ]);
        Admin::create([
            'name' => 'Sara',
            'email' => 'sara@admin.com',
            'password' => bcrypt('789789789'),
            'role_id' => Role::first()->id,
        ]);


    }
}
