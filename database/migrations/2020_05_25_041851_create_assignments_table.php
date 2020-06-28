<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_project')->unsigned();
            $table->bigInteger('id_user')->unsigned();
            $table->string('position');
            $table->decimal('internal_rate', 5, 2);
            $table->decimal('external_rate', 5, 2);
            $table->date('date_start');
            $table->date('date_end')->nullable();;
            $table->timestamps();
        });

        Schema::table('assignments', function (Blueprint $table)  {
            $table->foreign('id_project')->references('id')->on('projects');
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
        Schema::dropIfExists('assignments');
    }
}