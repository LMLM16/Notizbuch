<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Liste;
use Illuminate\Support\Facades\DB;

class ListTableSeeder extends Seeder
{

    public function run()
    {
        // Test List 1
        $list1 = new Liste();
        $list1->name = 'Grocery List';
        $list1->user_id = 1;
        $list1->is_public = true;
        $list1->save();

        // Test List 2
        $list2 = new Liste();
        $list2->name = 'Work Tasks';
        $list2->user_id = 2;
        $list2->is_public = false;
        $list2->save();

        // Test List 3
        $list3 = new Liste();
        $list3->name = 'Books to Read';
        $list3->user_id = 9;
        $list3->is_public = true;
        $list3->save();

        // Test List 4
        $list4 = new Liste();
        $list4->name = 'Travel Plans';
        $list4->user_id = 10;
        $list4->is_public = false;
        $list4->save();

        // Test List 5
        $list5 = new Liste();
        $list5->name = 'Fitness Goals';
        $list5->user_id = 11;
        $list5->is_public = true;
        $list5->save();
    }
}
