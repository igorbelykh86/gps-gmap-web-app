<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserTableSeeder
 *
 * @author igor
 */
class UserTableSeeder extends Seeder {
    public function run()
    {
        User::truncate();
        $user = new User();
        $user->username = 'testuser';
        $user->password = Hash::make('123456');
        $user->save();
    }
}
