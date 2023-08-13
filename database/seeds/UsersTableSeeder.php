<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // usersテーブルの初期レコード
        DB::table('users')->insert([
            ['username' => '神谷',
            'mail' => 'kkk@mail',
            'password' => Hash::make('password')],
            ['username' => '西山',
            'mail' => 'nnn@mail',
            'password' => Hash::make('password')],
            ['username' => '高橋',
            'mail' => 'ttt@mail',
            'password' => Hash::make('password')],
            ['username' => '山崎',
            'mail' => 'sss@mail',
            'password' => Hash::make('password')],
            ['username' => '小田',
            'mail' => 'ooo@mail',
            'password' => Hash::make('password')]
        ]);
    }
}
