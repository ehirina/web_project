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
            $table->bigIncrements('id_project');
            $table->foreign('id_project')->referenced('id')->on('projects')->onDelete('cascade');;
            $table->bigIncrements('id_user');
            $table->foreign('id_user')->referenced('id')->on('users');
            $table->string('note', 500);
            $table->decimal('ore', 2, 2);
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
        Schema::dropIfExists('time_entry');
    }
}
