<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{ User, Contact, Post, Comment, Page };
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::withoutEvents(function () {
            // Create 1 admin
            User::factory()->create([
                'role' => 'admin',
            ]);
            // Create 2 redactors
            User::factory()->count(2)->create([
                'role' => 'redac',
            ]);
            // Create 3 users
            User::factory()->count(3)->create();
        });
        $nbrUsers = 6;

        DB::table('categories')->insert([
            [
                'title' => 'Category 1',
                'slug' => 'category-1'
            ],
            [
                'title' => 'Category 2',
                'slug' => 'category-2'
            ],
            [
                'title' => 'Category 3',
                'slug' => 'category-3'
            ],
        ]);
        $nbrCategories = 3;


        DB::table('tags')->insert([
            ['tag' => 'Tag1', 'slug' => 'tag1'],
            ['tag' => 'Tag2', 'slug' => 'tag2'],
            ['tag' => 'Tag3', 'slug' => 'tag3'],
            ['tag' => 'Tag4', 'slug' => 'tag4'],
            ['tag' => 'Tag5', 'slug' => 'tag5'],
            ['tag' => 'Tag6', 'slug' => 'tag6']
        ]);
        $nbrTags = 6;

        Post::withoutEvents(function () {
            foreach (range(1, 2) as $i) {
                Post::factory()->create([
                    'title' => 'Post ' . $i,
                    'slug' => 'post-' . $i,
                    'seo_title' => 'Post ' . $i,
                    'user_id' => 2,
                    'image' => 'img0' . $i . '.jpg',
                ]);
            }
            foreach (range(3, 9) as $i) {
                Post::factory()->create([
                    'title' => 'Post ' . $i,
                    'slug' => 'post-' . $i,
                    'seo_title' => 'Post ' . $i,
                    'user_id' => 3,
                    'image' => 'img0' . $i . '.jpg',
                ]);
            }
        });
        $nbrPosts = 9;



        // Tags attachment
$posts = Post::all();
foreach ($posts as $post) {
    if ($post->id === 9) {
        $numbers=[1,2,5,6];
        $n = 4;
    } else {
        $numbers = range (1, $nbrTags);
        shuffle ($numbers);
        $n = rand (2, 4);
    }
    for($i = 0; $i < $n; ++$i) {
        $post->tags()->attach($numbers[$i]);
    }
}
// Set categories
foreach ($posts as $post) {
    if ($post->id === 9) {
        DB::table ('category_post')->insert ([
            'category_id' => 1,
            'post_id' => 9,
        ]);
    } else {
        $numbers = range (1, $nbrCategories);
        shuffle ($numbers);
        $n = rand (1, 2);
        for ($i = 0; $i < $n; ++$i) {
            DB::table ('category_post')->insert ([
                'category_id' => $numbers[$i],
                'post_id' => $post->id,
            ]);
        }
    }
}

// les commentaires
foreach (range(1, $nbrPosts - 1) as $i) {
    Comment::factory()->create([
        'post_id' => $i,
        'user_id' => rand(1, $nbrUsers),
    ]);
}

//commentaires autres niveaux
$faker = \Faker\Factory::create();
Comment::create([
    'post_id' => 2,
    'user_id' => 3,
    'body' => $faker->paragraph($nbSentences = 4, $variableNbSentences = true),
    'children' => [
        [
            'post_id' => 2,
            'user_id' => 4,
            'body' => $faker->paragraph($nbSentences = 4, $variableNbSentences = true),
            'children' => [
                [
                    'post_id' => 2,
                    'user_id' => 2,
                    'body' => $faker->paragraph($nbSentences = 4, $variableNbSentences = true),
                ],
            ],
        ],
    ],
]);
Comment::create([
    'post_id' => 2,
    'user_id' => 6,
    'body' => $faker->paragraph($nbSentences = 4, $variableNbSentences = true),
    'children' => [
        [
            'post_id' => 2,
            'user_id' => 3,
            'body' => $faker->paragraph($nbSentences = 4, $variableNbSentences = true),
        ],
        [
            'post_id' => 2,
            'user_id' => 6,
            'body' => $faker->paragraph($nbSentences = 4, $variableNbSentences = true),
            'children' => [
                [
                    'post_id' => 2,
                    'user_id' => 3,
                    'body' => $faker->paragraph($nbSentences = 4, $variableNbSentences = true),
                
                    'children' => [
                        [
                            'post_id' => 2,
                            'user_id' => 6,
                            'body' => $faker->paragraph($nbSentences = 4, $variableNbSentences = true),
                        ],
                    ],
                ],
            ],
        ],
    ],
]);
Comment::create([
    'post_id' => 4,
    'user_id' => 4,
    'body' => $faker->paragraph($nbSentences = 4, $variableNbSentences = true),
    'children' => [
        [
            'post_id' => 4,
            'user_id' => 5,
            'body' => $faker->paragraph($nbSentences = 4, $variableNbSentences = true),
            'children' => [
                [   'post_id' => 4,
                    'user_id' => 2,
                    'body' => $faker->paragraph($nbSentences = 4, $variableNbSentences = true),
                ],
                [
                    'post_id' => 4,
                    'user_id' => 1,
                    'body' => $faker->paragraph($nbSentences = 4, $variableNbSentences = true),
                ],
            ],
        ],
    ],
]);


// Contacts
Contact::withoutEvents(function () {
    Contact::factory()->count(5)->create();
});


// Pages
$items = [
    ['about-us', 'About us'],
    ['terms', 'Terms'],
    ['faq', 'FAQ'],
    ['privacy-policy', 'Privacy Policy'],
];
foreach($items as $item) {
    Page::factory()->create([
        'slug' => $item[0],
        'title' => $item[1],
    ]);
}

DB::table('follows')->insert([
    ['title' => 'Twitter', 'href' => '#'],
    ['title' => 'Facebook', 'href' => '#'],
    ['title' => 'Dribbble', 'href' => '#'],
    ['title' => 'Instagram', 'href' => '#'],
]);





    }
}
