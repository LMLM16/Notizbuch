<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(NotesTableSeeder::class);
        $this->call(ListTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(ToDoTableSeeder::class);
        $this->call(NoteTagTableSeeder::class);
        $this->call(TodoTagTableSeeder::class);
    }
}
