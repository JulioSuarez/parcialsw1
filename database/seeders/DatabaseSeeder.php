<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\cliente;
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
        // $this->cargarPlanes();
        $this->cargarUsuario();
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


    // public function cargarPlanes(){
    //     $plan = new planes();
    //     $plan->id = 1;
    //     $plan->tipo_plan = 'Cliente';
    //     $plan->precio = 100;
    //     $plan->save();

    //     $plan = new planes();
    //     $plan->id = 2;
    //     $plan->tipo_plan = 'Organizador';
    //     $plan->precio = 100;
    //     $plan->save();

    //     $plan = new planes();
    //     $plan->id = 3;
    //     $plan->tipo_plan = 'Foto Estudio';
    //     $plan->precio = 100;
    //     $plan->save();
    // }

    public function cargarUsuario(){
        $user = new User();
        $user->id=1;
        $user->name = 'Julio';
        $user->email = 'julio@correo.com';
        $user->fecha_nacimiento = '1991-02-16';
        $user->genero = 'M';
        $user->password = bcrypt('password');
        $user->profile_photo_path = 'JCST.png';
        $user->portada_photo_path = 'JCST.png';
        $user->assignRole('dev');
        $user->save();
        // $cliente = new cliente();
        // $cliente->foto_perfil ='JCST.png';
        // $cliente->foto_portada ='Julico.jpg';
        // $cliente->telefono =76034449;
        // $cliente->id_plan =1;
        // $cliente->user_id =$user->id;
        // $cliente->save();
    }

    public function cargarOrganizador(){
        $organizador = new organizador();
        $organizador->razon_social = 'Mary Eventos';
        $organizador->nit = 123456789;
        $organizador->save();
    }
}
