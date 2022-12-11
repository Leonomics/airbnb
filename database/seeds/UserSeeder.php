<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Marco',
                'surname' => 'Sangiorgi',
                'email' => 'marcosangiorgi@email.com',
                'password' => Hash::make('12345678'),
                'date_of_birth' => '2000-01-01',
            ],
            [
                'name' => 'Elia',
                'surname' => 'Vanon',
                'email' => 'eliavanon@email.com',
                'password' => Hash::make('12345678'),
                'date_of_birth' => '2000-01-01',
            ],
            [
                'name' => 'Leonardo',
                'surname' => 'Cavazzi',
                'email' => 'leonardocavazzi@email.com',
                'password' => Hash::make('12345678'),
                'date_of_birth' => '2000-01-01',
            ],
            [
                'name' => 'Lorenzo',
                'surname' => 'Giannanti',
                'email' => 'lorenzogiannanti@email.com',
                'password' => Hash::make('12345678'),
                'date_of_birth' => '2000-01-01',
            ],
            [
                'name' => 'Mary',
                'surname' => 'Chiodelli',
                'email' => 'marychiodelli@email.com',
                'password' => Hash::make('12345678'),
                'date_of_birth' => '2000-01-01',
            ],
        ];
        foreach( $users as $user) {
            $u = new User();
            $u->email = $user['email'];
            $u->password = $user['password'];
            $u->name = $user['name'];
            $u->surname = $user['surname'];
            $u->date_of_birth = $user['date_of_birth'];
            $u->save();
        }
    }
}
