<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_permission')->insert([
            [
                'role_id'=> 1,
                'permission_id'=> 6,
            ],
            //phy
            [
                'role_id'=> 2,
                'permission_id'=> 10,
            ],
            [
                'role_id'=> 2,
                'permission_id'=> 14,
            ],
            [
                'role_id'=> 2,
                'permission_id'=> 18,
            ],
            [
                'role_id'=> 2,
                'permission_id'=> 22,
            ],
            //researcher
            [
                'role_id'=> 3,
                'permission_id'=> 10,
            ],
            [
                'role_id'=> 3,
                'permission_id'=> 14,
            ],
            [
                'role_id'=> 3,
                'permission_id'=> 18,
            ],
            [
                'role_id'=> 3,
                'permission_id'=> 22,
            ],
            [
                'role_id'=> 3,
                'permission_id'=> 25,
            ],
        ]);
    }
}
