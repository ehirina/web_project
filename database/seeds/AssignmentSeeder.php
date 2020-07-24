<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AssignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
             DB::table('assignments')->insert([
        	[
        	'id' 			=> '1',
        	'id_project'	=> '1',
        	'id_user'  		=> '1',
        	'internal_rate' => '25',
        	'external_rate' => '50',
            'position'      => 'Java developer',
        	'date_start' 	=> Carbon::yesterday()->format('Y-m-d H:i:s'),
        	'created_at' 	=> Carbon::now()->format('Y-m-d H:i:s')
        	],[
        	'id' 			=> '2',
        	'id_project' 	=> '2',
        	'id_user'  		=> '1',
        	'internal_rate' => '20',
        	'external_rate' => '60',
            'position'      => 'CTO',
        	'date_start' 	=> Carbon::yesterday()->format('Y-m-d H:i:s'),
        	'created_at'	=> Carbon::now()->format('Y-m-d H:i:s')
        	],[
        	'id' 			=> '3',
        	'id_project' 	=> '3',
        	'id_user'  		=> '1',
        	'internal_rate' => '30',
        	'external_rate' => '55',
            'position'      => 'Java developer',
        	'date_start' 	=> Carbon::yesterday()->format('Y-m-d H:i:s'),
        	'created_at' 	=> Carbon::now()->format('Y-m-d H:i:s')
        	],

            [
            'id'            => '4',
            'id_project'    => '2',
            'id_user'       => '2',
            'internal_rate' => '20',
            'external_rate' => '35',
            'position'      => 'Java developer',
            'date_start'    => Carbon::yesterday()->format('Y-m-d H:i:s'),
            'created_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ]
		]
        );
    }
}
