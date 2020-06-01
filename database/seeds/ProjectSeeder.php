<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('projects')->insert([
        	[
        		'id' => '1',
        		'name' => 'Project 404',
        		'description' => 'Company sticker board',
        		'id_cliente' => '1',
        		'date_start' => Carbon::tomorrow()->format('Y-m-d'),
        		'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        	],[
        		'id' => '2',
        		'name' => 'Titan',
        		'description' => 'Time management system',
        		'id_cliente' => '2',
        		'date_start' => Carbon::tomorrow()->format('Y-m-d'),
        		'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        	],
        	[
        		'id' => '3',
        		'name' => 'Apollo',
        		'description' => 'Internet bot',
        		'id_cliente' => '2',
        		'date_start' => Carbon::tomorrow()->format('Y-m-d'),
        		'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        	],[
        		'id' => '4',
        		'name' => 'Cristine',
        		'description' => 'Educational software',
        		'id_cliente' => '3',
        		'date_start' => Carbon::tomorrow()->format('Y-m-d'),
        		'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        	]
        ]);
    }
}
