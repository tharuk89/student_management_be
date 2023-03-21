<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsFeedPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permission')->insert([
            //news feed
                [
                    'name'=> "News Feed view",
                    'description'=> "News Feed view permission",
                    'code'=>"VIEW_NEWS_FEED"
                ],
            ]);
    }
}
