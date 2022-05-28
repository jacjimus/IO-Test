<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tasks')->truncate();
        User::factory()->count(20)->create()->each(function ($user) {
            Task::factory()->count(rand(2, 10))->create(['user_id' => $user->id]);
        });
    }
}
