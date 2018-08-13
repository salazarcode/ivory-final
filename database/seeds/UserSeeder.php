<?php

use Illuminate\Database\Seeder;
use App\User;
use \Bouncer as Bouncer;
use App\Delegado;

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


        $user1 = User::create([
            'name' => 'Señor Administrador',
            'email' => 'administrador@gmail.com',
            'password' => bcrypt('12345'),
            'email_verified' => true,
            'email_code' => str_random(32)
        ]);
        $user1->assign('administrador');

        $user2 = User::create([
            'name' => 'Señor Ejecutivo',
            'email' => 'ejecutivo@gmail.com',
            'password' => bcrypt('12345'),
            'email_verified' => true,
            'email_code' => str_random(32)
        ]);
        $user2->assign('ejecutivo');

        $user3 = User::create([
            'name' => 'Señor Delegado',
            'email' => 'delegado@gmail.com',
            'password' => bcrypt('12345'),
            'email_verified' => true,
            'email_code' => str_random(32)
        ]);
        $user3->assign('delegado');
        Delegado::create([
            'ejecutivo_id'=> $user2->id,
            'delegado_id' => $user3->id
        ]);
    }
}
