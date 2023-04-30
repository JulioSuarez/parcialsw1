<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->cargarUsuario();
    }
    public function cargarUsuario(){
        $user = new User();
        $user->name = 'Julio';
        $user->email = 'julio@correo.com';
        $user->fecha_nacimiento = '1991-02-16';
        $user->genero = 'M';
        $user->password = bcrypt('password');
        $user->profile_photo_path = '';
        $user->save();
        $user = new User();
        $user->name = 'Diana';
        $user->email = 'diana@correo.com';
        $user->fecha_nacimiento = '1999-11-02';
        $user->genero = 'F';
        $user->password = bcrypt('password');
        $user->profile_photo_path = '';
        $user->save();
    }
}
