<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clients')->insert([
        	[
        	'id' => '1',
        	'ragione_sociale' => 'Ape Billy',
        	'nome_referente'  => 'Marco',
        	'cognome_referente' => 'Castellani',
        	'email' => 'marco_castellani@gmail.com',
        	'ssid' => '1111111',
        	'pec' => 'apeMarco@pec.it',
        	'partita_iva' => '09004210968',
        	'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        	],[
        	'id' => '2',
        	'ragione_sociale' => 'Podio Deck',
        	'nome_referente'  => 'Alberto',
        	'cognome_referente' => 'Rossi',
        	'email' => 'alberto_rossi@gmail.com',
        	'ssid' => '2222222',
        	'pec' => 'PodioRossi@pec.it',
        	'partita_iva' => '09004210930',
        	'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        	],[
        	'id' => '3',
        	'ragione_sociale' => 'Charme',
        	'nome_referente'  => 'Giordano',
        	'cognome_referente' => 'Mariani',
        	'email' => 'giordano_mariani@gmail.com',
        	'ssid' => '3333333',
        	'pec' => 'CharmeMariani@pec.it',
        	'partita_iva' => '09004210620',
        	'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        	]
		]
        );
    }
}
