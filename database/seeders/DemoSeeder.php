<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Task;    
use Illuminate\Support\Facades\Hash;

class DemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
    $admin = User::firstOrCreate(
        ['email'=>'admin@example.com'],
        ['name'=>'Admin', 'password'=>Hash::make('password'), 'role'=>'admin']
    );
    $user = User::firstOrCreate(
        ['email'=>'user@example.com'],
        ['name'=>'Intern', 'password'=>Hash::make('password'), 'role'=>'user']
    );
    $cat = Category::create(['name'=>'General','description'=>'Default','status'=>'Active']);
    Task::create([
        'name'=>'Kickoff',
        'description'=>'Read the spec',
        'category_id'=>$cat->id,
        'deadline'=>now()->addDays(3),
        'status'=>'Pending',
        'user_id'=>$user->id,
    ]);
    }
}
