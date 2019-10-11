<?php

use Illuminate\Database\Seeder;

class loginSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new App\User();
        $user->password = \Illuminate\Support\Facades\Hash::make('rpypkrapha');
        $user->name = 'Raphael';
        $user->email = 'raphael.oliveira@lasalle.org.br';
        $user->save();
    }
}
