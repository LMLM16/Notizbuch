<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ToDoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('todos')->insert([
            [
                'note_id' => 1,
                'user_id' => 1,
                'title' => 'Buy groceries',
                'description' => 'Milk, Bread, Cheese',
                'due_date' => Carbon::now()->addDays(2),
                'is_done' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'list_id' => 1,
            ],
            [
                'note_id' => 2,
                'user_id' => 1,
                'title' => 'Read a book',
                'description' => 'Read "The Great Gatsby"',
                'due_date' => Carbon::now()->addDays(5),
                'is_done' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'list_id' => 1,
            ],
            [
                'note_id' => 3,
                'user_id' => 2,
                'title' => 'Workout',
                'description' => 'Go to the gym for 1 hour',
                'due_date' => Carbon::now()->addDay(),
                'is_done' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'list_id' => 6,
            ],
        ]);
    }
}
