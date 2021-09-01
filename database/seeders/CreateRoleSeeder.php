<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CreateRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    public function run()
    {
        
        \DB::table('roles')->insert([
            ['name' => 'admin', 'display_name' => 'System Administration'],
            ['name' => 'guest', 'display_name' => 'Staff'],
            ['name' => 'developer', 'display_name' => 'System Development'],
            ['name' => 'content', 'display_name' => 'Edit content']
        ]);
    }
}
