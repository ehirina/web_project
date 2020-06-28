<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_project')->unsigned();
            $table->bigInteger('id_user')->unsigned();
            $table->bigInteger('id_assignment')->unsigned();
            $table->string('note', 500)->nullable();;
            $table->float('ore');
            $table->date('date');
            $table->timestamps();
        });

        Schema::table('reports', function (Blueprint $table)  {
            $table->foreign('id_project')->references('id')->on('projects')->onDelete('CASCADE');
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_assignment')->references('id')->on('assignments');
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
}
