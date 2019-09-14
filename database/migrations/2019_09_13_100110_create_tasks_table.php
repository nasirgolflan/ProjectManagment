<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',100);
            $table->text('description')->nullable($value = true);
            $table->dateTime('start_date')->nullable($value = true);
            $table->dateTime('end_date')->nullable($value = true);
            $table->bigInteger('project_id');
            $table->bigInteger('user_id');
            $table->tinyInteger('task_type_id');
            $table->tinyInteger('status');
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
        Schema::dropIfExists('tasks');
    }
}
