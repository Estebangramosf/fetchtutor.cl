<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        //Truncamos las tablas en cada ejecución
        App\User::truncate();
        App\Post::truncate();
        App\Multimedia::truncate();
        App\PostComment::truncate();
        App\MultimediaComment::truncate();

        //Ejecutamos la funcion factory especificando las clases a tratar y dentro se pueden ejecutar callbacks
        //para asociar a algun modelo o usuario algun post -> opcionalmente

        //En este caso creamos a un usuario administrador de forma manual para no incluirlo en los fakers
        factory(App\User::class)->create([
            'name' => 'Esteban',
            'email' => 'esteban@mail.cl',
            'role' => 'admin',
            'password' => bcrypt('test1234'),
            'remember_token' => str_random(10),
        ]);
        factory(App\User::class)->create([
            'name' => 'Francisco',
            'email' => 'francisco@mail.cl',
            'role' => 'admin',
            'password' => bcrypt('test1234'),
            'remember_token' => str_random(10),
        ]);

        factory(App\User::class, 500)->create()->each(function ($user) {
            $post = factory(App\Post::class)->make();
            $multimedia = factory(App\Multimedia::class)->make();
            $postComment = factory(App\PostComment::class)->make();
            $multimediaComment = factory(App\MultimediaComment::class)->make();
            $user->posts()->save($post);
            $user->multimedia()->save($multimedia);
            $post->post_comments()->save($postComment);
            $multimedia->multimedia_comments()->save($multimediaComment);


            /*
            //En caso de crear comentarios manuales
            $post->comments()->create([
              'user_id'=>rand(1,49),
              'title'=>$postComment->title,
              'body'=>$postComment->body,
            ]);
            */

        });
    }
}
