<?php

use App\Models\Post;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i < 50; $i++) {
            $newPost = new Post();
            $newPost->author = $faker->name();
            $newPost->title = $faker->sentence(3);
            $newPost->post_content = $faker->text(500);
            $newPost->post_image = $faker->imageUrl(640, 480, 'animals', true);
            $newPost->post_date = $faker->dateTime();
            $newPost->slug = Str::slug($newPost->title, '-') . '-' . ($i);
            $newPost->save();
        }
    }
}
