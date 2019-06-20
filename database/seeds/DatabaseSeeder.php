<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('permissions')->insert([
            [
                'name' => 'post_edit',
                'description' => 'edit post'
            ],
            [
                'name' => 'post_delete',
                'description' => 'delete post'
            ],
            [
                'name' => 'post_make',
                'description' => 'make post'
            ],
            [
                'name' => 'user_make',
                'description' => 'make user'
            ],
            [
                'name' => 'user_edit',
                'description' => 'edit user'
            ],
            [
                'name' => 'user_delete',
                'description' => 'delete user'
            ],
            [
                'name' => 'group_make',
                'description' => 'make group'
            ],
            [
                'name' => 'group_edit',
                'description' => 'edit group'
            ],
            [
                'name' => 'group_delete',
                'description' => 'delete group'
            ]
        ]);
    }
}
