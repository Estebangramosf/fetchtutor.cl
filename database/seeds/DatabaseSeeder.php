<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        //Acá echamos a correr los seeders de forma ordenada creados con -> php artisan make:seeder NameTableSeeder
        //Luego mediante la consola se pueden ejecutar como -> php artisan db:seed
        // ó
        // migrando o refrescando la tabla -> php artisan migrate --seed | php artisan migrate:refresh --seed

        Model::unguard();

        //Aca se agrega la lista de seeders creados
        $this->call(UsersTableSeeder::class);


        Model::reguard();
    }
}
