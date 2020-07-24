<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ragione_sociale', 256);
            $table->string('nome_referente', 50);
            $table->string('cognome_referente', 50);
            $table->string('email', 320)->unique();
            $table->string('ssid', 7)->unique();
            $table->string('pec', 320)->unique();
            $table->string('partita_iva', 11)->unique();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
