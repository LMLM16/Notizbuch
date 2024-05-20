<?php

namespace Database\Seeders;


use App\Models\Image;
use App\Models\Liste;
use App\Models\Note;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;
use Illuminate\Support\Str;

class NotesTableSeeder extends Seeder
{

    public function run()
    {

        $note = new \App\Models\Note;
        $note->user_id = "1";
        $note->list_id = "1";
        $note->title = "2";
        $note->subtitle = "Notiz2";
        $note->content = "HALLO";
        $note->published = new DateTime();
        $note->rating = 10;
        $note->updated_at = new DateTime();
        $note->save();

        $note = new \App\Models\Note;
        $note->user_id = "1";
        $note->list_id = "1";
        $note->title = "2";
        $note->subtitle = "Notiz";
        $note->content = "HALLO";
        $note->published = new DateTime();
        $note->rating = 10;
        $note->updated_at = new DateTime();
        $note->save();

        $note = new \App\Models\Note;
        $note->user_id = "1";
        $note->list_id = "1";
        $note->title = "2";
        $note->subtitle = "Notiz";
        $note->content = "HALLO";
        $note->published = new DateTime();
        $note->rating = 10;
        $note->updated_at = new DateTime();
        $note->save();

        $note = new \App\Models\Note;
        $note->user_id = "1";
        $note->list_id = "1";
        $note->title = "2";
        $note->subtitle = "Notiz";
        $note->content = "HALLO";
        $note->published = new DateTime();
        $note->rating = 10;
        $note->updated_at = new DateTime();
        $note->save();

        $note = new \App\Models\Note;
        $note->user_id = "1";
        $note->list_id = "1";
        $note->title = "2";
        $note->subtitle = "Notiz";
        $note->content = "HALLO";
        $note->published = new DateTime();
        $note->rating = 10;
        $note->updated_at = new DateTime();
        $note->save();


    }


}




