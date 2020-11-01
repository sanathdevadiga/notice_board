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

        // \App\Department::create(['dept'=>'CS','sec'=>'A','sem'=>1]);
        // \App\Department::create(['dept'=>'CS','sec'=>'B','sem'=>1]);
        // \App\Department::create(['dept'=>'IS','sec'=>'C','sem'=>2]);
        // \App\Subject::create(['subname'=>'CO','subcode'=>'4d56d']);
        // \App\_Class::create(['subject_id'=>1,'department_id'=>1,'staff_id'=>1]);
        // \App\Student::create(['name'=>'abc','usn'=>'123','phone'=>'12345','address'=>'fghjk','dob'=>now(),'department_id'=>1]);
        // \App\Student::create(['name'=>'hjj','usn'=>'233','phone'=>'12345','address'=>'fghjk','dob'=>now(),'department_id'=>1]);
        // \App\Mark::create(['subject_id'=>1,'student_id'=>1,'mark'=>20,'ia'=>1]);
        // \App\Mark::create(['subject_id'=>1,'student_id'=>2,'mark'=>20,'ia'=>1]);

        \App\Role::create(['permission'=>"admin"]);
        \App\Role::create(['permission'=>"staff"]);
        \App\Role::create(['permission'=>"officer"]);

        \App\Staff::create(['name'=>'Rajath','ssn'=>'abc','pwd'=>'1234','role_id'=>1]);


        // $this->call(UsersTableSeeder::class);
    }
}
