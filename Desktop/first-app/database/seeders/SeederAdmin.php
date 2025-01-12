<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class SeederAdmin extends Seeder
{
    public function run(): void
    {
        $users =[
            ['name' => 'ismail','email' => 'ismail@gmail.com','password' => Hash::make('123456'),'role_id' => 1,],
            ['name' => 'layla','email' => 'layla@gmail.com','password' => Hash::make('123456'),'role_id' => 1,],
        ];
        foreach ($users as $user)
        {
            User::create($user);
        }
    }
}
