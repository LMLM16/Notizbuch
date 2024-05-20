<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Definiere eine Array von Tags
        $tags = ['Important', 'Work', 'Personal', 'Urgent'];

        // Iteriere über jedes Tag und füge es der Datenbank hinzu
        foreach ($tags as $tag) {
            DB::table('tags')->insert([
                'name' => $tag
            ]);
        }
    }
}
