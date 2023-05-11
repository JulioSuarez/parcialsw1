<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\album_evento;
use Carbon\Carbon;
use Stripe\Stripe;
use App\Models\User;
use Stripe\Customer;
use App\Models\Evento;
use App\Models\planes;

//libreria de roles by Julico
use App\Models\cliente;
use App\Models\organizador;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Permission;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->roles();
        $this->cargarUsuarioPruebas();
        $this->cargarEvento();
        $this->cargarClientes();
    }

    public function roles()
    {
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
        Permission::create(['name' => 'fotoestudio.index'])->syncRoles([$dev, $fotoestudio]);
        Permission::create(['name' => 'fotoestudio.create'])->syncRoles([$dev, $fotoestudio]);
        Permission::create(['name' => 'fotoestudio.edit'])->syncRoles([$dev, $fotoestudio]);
        Permission::create(['name' => 'fotoestudio.destroy'])->syncRoles([$dev, $fotoestudio]);
        Permission::create(['name' => 'fotoestudio.foto'])->syncRoles([$dev, $fotoestudio]);
        ////////////organizador
        Permission::create(['name' => 'organizador.index'])->syncRoles([$organizador]);
        Permission::create(['name' => 'organizador.create'])->syncRoles([$dev, $organizador]);
        Permission::create(['name' => 'organizador.edit'])->syncRoles([$dev, $organizador]);
        Permission::create(['name' => 'organizador.destroy'])->syncRoles([$dev, $organizador]);
        Permission::create(['name' => 'organizador.evento'])->syncRoles([$dev, $organizador]);
        ////////////CLIENTES
        Permission::create(['name' => 'cliente.index'])->syncRoles([$dev, $fotoestudio, $organizador, $cliente]);
        Permission::create(['name' => 'cliente.album'])->syncRoles([$dev, $fotoestudio, $organizador, $cliente]);
        Permission::create(['name' => 'cliente.invitacion'])->syncRoles([$dev, $fotoestudio, $organizador, $cliente]);
        Permission::create(['name' => 'cliente.create'])->syncRoles([$dev]);
        Permission::create(['name' => 'cliente.edit'])->syncRoles([$dev]);
        Permission::create(['name' => 'cliente.destroy'])->syncRoles([$dev]);
        Permission::create(['name' => 'cliente.suscripcion'])->syncRoles([$dev, $cliente]);
        ////////////DASHBOARD
        Permission::create(['name' => 'dashboard.index'])->syncRoles([$dev, $fotoestudio, $organizador, $cliente]);
        Permission::create(['name' => 'dashboard2'])->syncRoles([$dev, $fotoestudio, $organizador]);
        Permission::create(['name' => 'dashboard.ventas'])->syncRoles([$dev]);
        Permission::create(['name' => 'dashboard.pagos'])->syncRoles([$dev]);
        Permission::create(['name' => 'dashboard.cobros'])->syncRoles([$dev]);
        ////////////REPORTES
        Permission::create(['name' => 'reportes.index'])->syncRoles([$dev]);
        ////////////PRUEBAS
        Permission::create(['name' => 'suscripcion'])->syncRoles([$dev, $suscripcion]);
        Permission::create(['name' => 'pago'])->syncRoles([$dev, $pago]);
        ////////////
    }

    public function cargarUsuarioPruebas()
    {

        // Configura la llave secreta de Stripe
        Stripe::setApiKey('sk_test_51MF8jhEeOK3PttV3mH0ZQV6cLESOq9pILt95PZZmMhrcopvNPtWXraVPHgAlgh2Dj87Cc9sOXKbZYOsJT7GQVA1p00eMA1LNGp');
        $users = [
            [
                'name' => 'Julio',
                'email' => 'julio@correo.com',
                'fecha_nacimiento' => '1991-02-16',
                'genero' => 'M',
                'password' => 'password',
                'profile_photo_path' => 'JCST.png',
                'portada_photo_path' => 'Julico.jpg',
                'estado' => 0,
                'role' => 'dev',
            ],
            [
                'name' => 'Organizador',
                'email' => 'organizador@correo.com',
                'fecha_nacimiento' => '1991-02-16',
                'genero' => 'M',
                'password' => 'password',
                'profile_photo_path' => 'organizador1.jpg',
                'portada_photo_path' => 'organizador2.jpeg',
                'estado' => 0,
                'role' => 'organizador',
            ],
            [
                'name' => 'Foto Estudio',
                'email' => 'fotoestudio@correo.com',
                'fecha_nacimiento' => '1991-02-16',
                'genero' => 'M',
                'password' => 'password',
                'profile_photo_path' => 'fotoestudio1.jpeg',
                'portada_photo_path' => 'fotoestudio2.jpg',
                'estado' => 1,
                'role' => 'fotoestudio',
            ],
            [
                'name' => 'Foto Estudio 2',
                'email' => 'fotoestudio2@correo.com',
                'fecha_nacimiento' => '1991-02-16',
                'genero' => 'M',
                'password' => 'password',
                'profile_photo_path' => 'fotoestudio1.jpeg',
                'portada_photo_path' => 'fotoestudio2.jpg',
                'estado' => 0,
                'role' => 'fotoestudio',
            ],
        ];

        foreach ($users as $userData) {
            // Crea el usuario en la base de datos de Laravel
            $user = new User();
            $user->name = $userData['name'];
            $user->email = $userData['email'];
            $user->fecha_nacimiento = $userData['fecha_nacimiento'];
            $user->genero = $userData['genero'];
            $user->password = bcrypt($userData['password']);
            $user->profile_photo_path = $userData['profile_photo_path'];
            $user->portada_photo_path = $userData['portada_photo_path'];
            $user->assignRole($userData['role']);
            if (isset($userData['estado'])) {
                $user->estado = $userData['estado'];
            }
            $user->save();

            // Crea un nuevo cliente en Stripe
            $customer = Customer::create([
                'email' => $user->email,
                'name' => $user->name,
            ]);

            // Asigna el ID del cliente de Stripe al usuario
            $user->stripe_id = $customer->id;
            $user->save();
        }
    }

    public function cargarEvento()
    {
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
        $a = new album_evento();
        $a->nombre_album = 'Bodas de Cristal Mary&Julio';
        $a->descripcion = 'Acompaña a Mary & Julio en la celebracion de su aniversario de bodas de cristal';
        $a->portada = 'invitacion.png';
        $a->estado = 0;
        $a->id_evento = $e->id;
        $a->save();
    }

    public function cargarClientes()
    {

        // Configura la llave secreta de Stripe
        Stripe::setApiKey('sk_test_51MF8jhEeOK3PttV3mH0ZQV6cLESOq9pILt95PZZmMhrcopvNPtWXraVPHgAlgh2Dj87Cc9sOXKbZYOsJT7GQVA1p00eMA1LNGp');

        for ($i = 0; $i < 10; $i++) {
            //para generar fechas de nacimiento
            $fecha_nacimiento = Carbon::now()->subYears(rand(18, 65))->subDays(rand(0, 365))->format('Y-m-d');
            // para obtener generos aleatorios
            $generos = ['F', 'M'];
            $genero = $generos[random_int(0, 1)];

            // Crea el cliente
            $user = new User();
            $user->name = fake()->name();
            $user->email = fake()->unique()->safeEmail();
            $user->fecha_nacimiento = $fecha_nacimiento;
            $user->genero = $genero;
            $user->estado = '0';
            $user->password = bcrypt('password');
            $user->profile_photo_path = 'default.png';
            $user->portada_photo_path = 'default.png';
            $user->assignRole('cliente');
            $user->save();

            // Crea un nuevo cliente en Stripe
            $customer = Customer::create([
                'email' => $user->email,
                'name' => $user->name,
            ]);

            // Asigna el ID del cliente de Stripe al usuario
            $user->stripe_id = $customer->id;
            $user->save();
        }
    }
}
