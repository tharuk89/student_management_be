<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContentDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('content')->insert(
            [
                    [
                    'title' => "Understanding Parkinson's disease",
                    'description' => '',
                    'tags' => "parkinson's disease",
                    'url' => 'https://www.youtube.com/watch?v=ckn9zybpYZ8'
                ],
                [
                    'title' => "What is Parkinson's Disease?",
                    'description' => '',
                    'tags' => "parkinson's disease",
                    'url' => 'https://www.youtube.com/watch?v=cRLB7WqX0fU'
                ],
                [
                    'title' => "Parkinson's Disease, Animation",
                    'description' => '',
                    'tags' => "parkinson's disease",
                    'url' => 'https://www.youtube.com/watch?v=NAfQoviLFR8'
                ],
                [
                    'title' => "Parkinson's Disease (Shaking Palsy) - Clinical Presentation and Pathophysiology",
                    'description' => '',
                    'tags' => "parkinson's disease",
                    'url' => 'https://www.youtube.com/watch?v=Hu5KVfFnrh0'
                ],
                [
                    'title' => "Early Parkinson's Disease",
                    'description' => '',
                    'tags' => "parkinson's disease",
                    'url' => 'https://www.youtube.com/watch?v=BNzIaABFAMc'
                ]
            ]
        );
    }
}
