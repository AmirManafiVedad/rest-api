<?php

use App\Article;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ArticleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!Article::count()){
            $this->registerData();
        }
    }

    public function registerData(){
        $facter = Factory::create();
        foreach ([1,2] as $userId){
            foreach (range(1 , random_int(1,5)) as $item)
            Article::create([
                'title' => $facter->title,
                'body' => 'body' .' '. $item . ' ' .$facter->paragraph,
                'user_id' => $userId,
            ]);
        }

    }
}
