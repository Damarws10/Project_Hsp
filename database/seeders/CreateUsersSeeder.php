<?php
  
namespace Database\Seeders;
  
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
  
class CreateUsersSeeder extends Seeder
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
               'name'=>'Super User',
               'email'=>'manager@gmail.com',
               'type'=> 'superuser',
               'password'=> bcrypt('12345678'),
            ],
            [
               'name'=>'Admin User',
               'email'=>'admin@gmail.com',
               'role'=>'admin',
               'password'=> bcrypt('12345678'),
            ],
            [
               'name'=>'User',
               'email'=>'user@gmail.com',
               'type'=>'user',
               'password'=> bcrypt('12345678'),
            ],
        ];
    
        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}