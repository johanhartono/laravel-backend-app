<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::factory(20)->create();
        User::create([
            'name'=> 'Johan Hartono',
            'email'=>'johanhartono@gmail.com',
            'email_verified_at'=> now(),
            'password'=> Hash::make('123456'),
            'role'=> 'admin',
            'phone'=>'0812345678',
            'bio'=>'full stack web developer',
        ]);
        //
        User::create([
            'name'=> 'Super Admin',
            'email'=>'androidtvmedan@gmail.com',
            'email_verified_at'=> now(),
            'password'=> Hash::make('123456'),
            'role'=> 'superadmin',
            'phone'=>'0812345678',
            'bio'=>'full stack web developer',
        ]);
    }
}
