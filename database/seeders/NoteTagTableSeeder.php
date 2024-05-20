<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Note;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;

class NoteTagTableSeeder extends Seeder
{
    public function run()
    {

        DB::table('note__tags')->insert([
            ['note_id' => 1, 'tag_id' => 1],
            ['note_id' => 1, 'tag_id' => 2],
            ['note_id' => 2, 'tag_id' => 1],
            ['note_id' => 2, 'tag_id' => 3],
        ]);
    }
}
