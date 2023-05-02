<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\cliente;
use App\Models\planes;
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
        $this->cargarPlanes();
        $this->cargarUsuario();
    }

    public function cargarPlanes(){
        $plan = new planes();
        $plan->id = 1;
        $plan->tipo_plan = 'Cliente';
        $plan->precio = 100;
        $plan->save();

        $plan = new planes();
        $plan->id = 2;
        $plan->tipo_plan = 'Organizador';
        $plan->precio = 100;
        $plan->save();

        $plan = new planes();
        $plan->id = 3;
        $plan->tipo_plan = 'Foto Estudio';
        $plan->precio = 100;
        $plan->save();
    }

    public function cargarUsuario(){
        $user = new User();
        $user->id=1;
        $user->name = 'Julio';
        $user->email = 'julio@correo.com';
        $user->fecha_nacimiento = '1991-02-16';
        $user->genero = 'M';
        $user->password = bcrypt('password');
        $user->profile_photo_path = '';
        $user->save();
        $cliente = new cliente();
        $cliente->foto_perfil ='JCST.png';
        $cliente->foto_portada ='Julico.jpg';
        $cliente->telefono =76034449;
        $cliente->id_plan =1;
        $cliente->user_id =$user->id;
        $cliente->save();

        // $user = new User();
        // $user->name = 'Diana';
        // $user->email = 'diana@correo.com';
        // $user->fecha_nacimiento = '1999-11-02';
        // $user->genero = 'F';
        // $user->password = bcrypt('password');
        // $user->profile_photo_path = '';
        // $user->save();
    }
}
