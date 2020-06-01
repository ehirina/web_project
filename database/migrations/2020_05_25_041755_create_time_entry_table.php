<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimeEntryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_entry', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_project')->unsigned();
            $table->bigInteger('id_user')->unsigned();
            $table->string('note', 500)->nullable();;
            $table->decimal('ore', 2, 2);
            $table->date('date');
            $table->timestamps();
        });

        Schema::table('time_entry', function (Blueprint $table)  {
            $table->foreign('id_project')->references('id')->on('projects')->onDelete('CASCADE');
            $table->foreign('id_user')->references('id')->on('users');
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('time_entry');
    }
}