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
            $table->bigIncrements('id_project');
            $table->foreign('id_project')->referenced('id')->on('projects')->onDelete('cascade');
            $table->bigIncrements('id_user');
            $table->foreign('id_user')->referenced('id')->on('users');
            $table->decimal('internal_rate', 5, 2);
            $table->decimal('external_rate', 5, 2);
            $table->date('date_start');
            $table->date('date_end');
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
        Schema::dropIfExists('assignments');
    }
}
