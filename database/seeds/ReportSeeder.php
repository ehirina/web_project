<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reports')->insert([
        	[
        	'id' 			=> '1',
        	'id_project'	=> '1',
        	'id_user'  		=> '1',
        	'id_assignment' => '1',
            'note'      	=> 'Sviluppo componente sticker board',
        	'ore' 			=> '3.5',
        	'date'			=> Carbon::today()->format('Y-m-d'),
        	'created_at' 	=> Carbon::now()->format('Y-m-d H:i:s')
        	],[
        	'id' 			=> '2',
        	'id_project' 	=> '2',
        	'id_user'  		=> '1',
        	'id_assignment' => '2',
            'note'      	=> 'Requirements engineering meeting',
            'ore' 			=> '1',
        	'date'			=> Carbon::today()->format('Y-m-d'),
        	'created_at' 	=> Carbon::now()->format('Y-m-d H:i:s')
        	],[
        	'id' 			=> '3',
        	'id_project' 	=> '2',
        	'id_user'  		=> '1',
        	'id_assignment' => '2',
            'note'      	=> 'Requirements analysis',
            'ore' 			=> '3.5',
        	'date'			=> Carbon::today()->format('Y-m-d'),
        	'created_at' 	=> Carbon::now()->format('Y-m-d H:i:s')
			],

            [
            'id'            => '4',
            'id_project'    => '2',
            'id_user'       => '2',
            'id_assignment' => '4',
            'note'          => 'Task#789',
            'ore'           => '8',
            'date'          => Carbon::today()->format('Y-m-d'),
            'created_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ]
		]
        );
    }
}
