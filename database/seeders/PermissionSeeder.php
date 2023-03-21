<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permission')->insert([
            //USER
            [
                'name'=> "User Add",
                'description'=> "User add permission",
                'code'=>"ADD_USER"
            ],
            [
                'name'=> "User View",
                'description'=> "User view permission",
                'code'=>"VIEW_USER"
            ],
            [
                'name'=> "User Update",
                'description'=> "User update permission",
                'code'=>"UPDATE_USER"
            ],
            [
                'name'=> "User Delete",
                'description'=> "User delete permission",
                'code'=>"DELETE_USER"
            ],
            //Content
            [
                'name'=> "Content Add",
                'description'=> "Content add permission",
                'code'=>"ADD_CONTENT"
            ],
            [
                'name'=> "Content View",
                'description'=> "Content view permission",
                'code'=>"VIEW_CONTENT"
            ],
            [
                'name'=> "Content Update",
                'description'=> "Content update permission",
                'code'=>"UPDATE_CONTENT"
            ],
            [
                'name'=> "Content DELETE",
                'description'=> "Content delete permission",
                'code'=>"DELETE_CONTENT"
            ],
            //Patients - medical record
            [
                'name'=> "Patients Medical Record Add",
                'description'=> "Patients Medical Record add permission",
                'code'=>"ADD_PATIENTS_MEDICAL_RECORD"
            ],
            [
                'name'=> "Patients Medical Record View",
                'description'=> "Patients Medical Record view permission",
                'code'=>"VIEW_PATIENTS_MEDICAL_RECORD"
            ],
            [
                'name'=> "Patients Medical Record Update",
                'description'=> "Patients Medical Record update permission",
                'code'=>"UPDATE_PATIENTS_MEDICAL_RECORD"
            ],
            [
                'name'=> "Patients Medical Record DELETE",
                'description'=> "Patients Medical Record delete permission",
                'code'=>"DELETE_PATIENTS_MEDICAL_RECORD"
            ],

            //Patients - exercise record
            [
                'name'=> "Patients Exercise Record Add",
                'description'=> "Patients Exercise Record add permission",
                'code'=>"ADD_PATIENTS_EXERCISE_RECORD"
            ],
            [
                'name'=> "Patients Exercise Record View",
                'description'=> "Patients Exercise Record view permission",
                'code'=>"VIEW_PATIENTS_EXERCISE_RECORD"
            ],
            [
                'name'=> "Patients Exercise Record Update",
                'description'=> "Patients Exercise Record update permission",
                'code'=>"UPDATE_PATIENTS_EXERCISE_RECORD"
            ],
            [
                'name'=> "Patients Exercise Record DELETE",
                'description'=> "Patients Exercise Record delete permission",
                'code'=>"DELETE_PATIENTS_EXERCISE_RECORD"
            ],

            //Patients - eating record
            [
                'name'=> "Patients Eating Record Add",
                'description'=> "Patients Eating Record add permission",
                'code'=>"ADD_PATIENTS_EATING_RECORD"
            ],
            [
                'name'=> "Patients Eating Record View",
                'description'=> "Patients Eating Record view permission",
                'code'=>"VIEW_PATIENTS_EATING_RECORD"
            ],
            [
                'name'=> "Patients Eating Record Update",
                'description'=> "Patients Eating Record update permission",
                'code'=>"UPDATE_PATIENTS_EATING_RECORD"
            ],
            [
                'name'=> "Patients Eating Record DELETE",
                'description'=> "Patients Exercise Record delete permission",
                'code'=>"DELETE_PATIENTS_EATING_RECORD"
            ],

            //Patients - sleeping record
            [
                'name'=> "Patients Sleeping Record Add",
                'description'=> "Patients Sleeping Record add permission",
                'code'=>"ADD_PATIENTS_SLEEPING_RECORD"
            ],
            [
                'name'=> "Patients Sleeping Record View",
                'description'=> "Patients Sleeping Record view permission",
                'code'=>"VIEW_PATIENTS_SLEEPING_RECORD"
            ],
            [
                'name'=> "Patients Sleeping Record Update",
                'description'=> "Patients Sleeping Record update permission",
                'code'=>"UPDATE_PATIENTS_SLEEPING_RECORD"
            ],
            [
                'name'=> "Patients Sleeping Record DELETE",
                'description'=> "Patients Sleeping Record delete permission",
                'code'=>"DELETE_PATIENTS_SLEEPING_RECORD"
            ],
        ]);
    }
}
