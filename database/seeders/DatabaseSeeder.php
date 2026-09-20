<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /*
        primero creamos los usuarios
        luego reciclamos esos usuarios y los conectamos con las tareas
    */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            TaskSeeder::class,
        ]);
    }
}
