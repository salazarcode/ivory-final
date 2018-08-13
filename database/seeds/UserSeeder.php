<?php

use Illuminate\Database\Seeder;
use App\User;
use \Bouncer as Bouncer;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Creo los roles
        $administradorRole = Bouncer::role()->firstOrCreate([
            'name' => 'administrador',
            'title' => 'Administrator',
        ]);
        $ejecutivoRole = Bouncer::role()->firstOrCreate([
            'name' => 'ejecutivo',
            'title' => 'Administrator',
        ]);
        $delegadoRole = Bouncer::role()->firstOrCreate([
            'name' => 'dejegado',
            'title' => 'Delegado',
        ]);


        $user = User::create([
            'name' => 'Señor Administrador',
            'email' => 'administrador@gmail.com',
            'password' => bcrypt('12345'),
            'email_verified' => true,
            'email_code' => null
        ]);
        $user->assign('administrador');

        $user = User::create([
            'name' => 'Señor Ejecutivo',
            'email' => 'ejecutivo@gmail.com',
            'password' => bcrypt('12345'),
            'email_verified' => true,
            'email_code' => null
        ]);
        $user->assign('ejecutivo');

        $user = User::create([
            'name' => 'Señor Delegado',
            'email' => 'delegado@gmail.com',
            'password' => bcrypt('12345'),
            'email_verified' => true,
            'email_code' => null
        ]);
        $user->assign('delegado');
    }
}
