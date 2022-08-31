<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('courses')->insert([
            'title' => 'Laravel',
            'description' => 'Curso Laravel 8'
        ]);

        DB::table('courses')->insert([
            'title' => 'Vue Js',
            'description' => 'Curso Completo de Vue Js'
        ]);

        DB::table('courses')->insert([
            'title' => 'Java Script',
            'description' => 'Curso JavaScript'
        ]);
    }
}
