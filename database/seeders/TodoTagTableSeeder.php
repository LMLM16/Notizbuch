<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Note;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;

class TodoTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('todo__tags')->insert([
            ['todo_id' => 4, 'tag_id' => 1],
            ['todo_id' => 5, 'tag_id' => 2],
            ['todo_id' => 6, 'tag_id' => 1]
        ]);
    }
}
