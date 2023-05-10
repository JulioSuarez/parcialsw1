<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\cliente;
use App\Models\Evento;
use App\Models\organizador;
use App\Models\planes;
use App\Models\User;
use Illuminate\Database\Seeder;

//libreria de roles by Julico
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;


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
        $this->roles();
        $this->cargarUsuario();
        $this->cargarEvento();
    }

    public function roles(){
            // creamos los roles
            //variable      =   modelo(atributo)
            $dev            = Role::create(['name' => 'dev']);
            $cliente        = Role::create(['name' => 'cliente']);
            $organizador    = Role::create(['name' => 'organizador']);
            $fotoestudio    = Role::create(['name' => 'fotoestudio']);
            $suscripcion    = Role::create(['name' => 'suscripcion']);
            $pago           = Role::create(['name' => 'pago']);
            ////////////ADMIN
            Permission::create(['name' => 'admin'])->syncRoles([$dev]);
            ////////////ROLES
            Permission::create(['name' => 'roles.index'])->syncRoles([$dev]);
            Permission::create(['name' => 'roles.creatit'])->syncRoles([$dev]);
            Permission::create(['name' => 'roles.destroy'])->syncRoles([$dev]);
            Permission::create(['name' => 'roles.edte'])->syncRoles([$dev]);
            ////////////organizador
            Permission::create(['name' => 'fotoestudio.index'])->syncRoles([$dev,$fotoestudio]);
            Permission::create(['name' => 'fotoestudio.create'])->syncRoles([$dev,$fotoestudio]);
            Permission::create(['name' => 'fotoestudio.edit'])->syncRoles([$dev,$fotoestudio]);
            Permission::create(['name' => 'fotoestudio.destroy'])->syncRoles([$dev,$fotoestudio]);
            Permission::create(['name' => 'fotoestudio.foto'])->syncRoles([$dev,$fotoestudio]);
            ////////////organizador
            Permission::create(['name' => 'organizador.index'])->syncRoles([$organizador]);
            Permission::create(['name' => 'organizador.create'])->syncRoles([$dev,$organizador]);
            Permission::create(['name' => 'organizador.edit'])->syncRoles([$dev,$organizador]);
            Permission::create(['name' => 'organizador.destroy'])->syncRoles([$dev,$organizador]);
            Permission::create(['name' => 'organizador.evento'])->syncRoles([$dev,$organizador]);
            ////////////CLIENTES
            Permission::create(['name' => 'cliente.index'])->syncRoles([$dev,$fotoestudio,$organizador,$cliente]);
            Permission::create(['name' => 'cliente.album'])->syncRoles([$dev,$fotoestudio,$organizador,$cliente]);
            Permission::create(['name' => 'cliente.invitacion'])->syncRoles([$dev,$fotoestudio,$organizador,$cliente]);
            Permission::create(['name' => 'cliente.create'])->syncRoles([$dev]);
            Permission::create(['name' => 'cliente.edit'])->syncRoles([$dev]);
            Permission::create(['name' => 'cliente.destroy'])->syncRoles([$dev]);
            Permission::create(['name' => 'cliente.suscripcion'])->syncRoles([$dev,$cliente]);
            ////////////DASHBOARD
            Permission::create(['name' => 'dashboard.index'])->syncRoles([$dev,$fotoestudio,$organizador,$cliente]);
            Permission::create(['name' => 'dashboard.ventas'])->syncRoles([$dev]);
            Permission::create(['name' => 'dashboard.pagos'])->syncRoles([$dev]);
            Permission::create(['name' => 'dashboard.cobros'])->syncRoles([$dev]);
            ////////////REPORTES
            Permission::create(['name' => 'reportes.index'])->syncRoles([$dev]);
            ////////////PRUEBAS
            Permission::create(['name' => 'suscripcion'])->syncRoles([$dev,$suscripcion]);
            Permission::create(['name' => 'pago'])->syncRoles([$dev,$pago]);
            ////////////
    }

    public function cargarUsuario(){
        $user = new User();
        $user->id=1;
        $user->name = 'Julio';
        $user->email = 'julio@correo.com';
        $user->fecha_nacimiento = '1991-02-16';
        $user->genero = 'M';
        $user->password = bcrypt('password');
        $user->profile_photo_path = 'JCST.png';
        $user->portada_photo_path = 'Julico.jpg';
        $user->assignRole('dev');
        $user->save();
        $user = new User();
        $user->id=2;
        $user->name = 'organizador';
        $user->email = 'organizador@correo.com';
        $user->fecha_nacimiento = '1991-02-16';
        $user->genero = 'M';
        $user->password = bcrypt('password');
        $user->profile_photo_path = 'organizador1.jpg';
        $user->portada_photo_path = 'organizador2.jpeg';
        $user->assignRole('organizador');
        $user->save();
        $user = new User();
        $user->id=3;
        $user->name = 'foto estudio';
        $user->email = 'fotoestudio@correo.com';
        $user->fecha_nacimiento = '1991-02-16';
        $user->genero = 'M';
        $user->password = bcrypt('password');
        $user->profile_photo_path = 'fotoestudio1.jpeg';
        $user->portada_photo_path = 'fotoestudio2.jpg';
        $user->estado = 1;
        $user->assignRole('fotoestudio');
        $user->save();
        $user = new User();
        $user->id=4;
        $user->name = 'foto estudio 2';
        $user->email = 'fotoestudio2@correo.com';
        $user->fecha_nacimiento = '1991-02-16';
        $user->genero = 'M';
        $user->password = bcrypt('password');
        $user->profile_photo_path = 'fotoestudio1.jpeg';
        $user->portada_photo_path = 'fotoestudio2.jpg';
        $user->estado = 0;
        $user->assignRole('fotoestudio');
        $user->save();
    }

    public function cargarEvento(){
        $e = new Evento();
        $e->evento_name = 'Bodas de Cristal Mary&Julio';
        $e->descripcion = 'Acompaña a Mary & Julio en la celebracion de su aniversario de bodas de cristal';
        $e->fecha = '2023-07-22';
        $e->hora = '20:30';
        $e->horafin = '23:59';
        $e->lugar = 'Mary Eventos';
        $e->foto = 'invitacion.png';
        $e->estado = '0';   //0: Activo | 1: Terminado
        $e->id_organizador = 2;
        $e->id_fotoestudio = 3;
        $e->save();
    }
}
