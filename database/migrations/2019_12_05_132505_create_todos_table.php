<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('todos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('description')->nullable();

            // 0 : unchecked ; 1 : checked
            $table->enum('status', array('UNCHECKED', 'CHECKED'))->default('UNCHECKED');
            $table->date('due_date')->nullable();

            $table->integer('order')->nullable();

            $table->bigInteger('user_id');
            $table->bigInteger('parent_todo_id')->nullable();

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
        Schema::dropIfExists('todos');
    }
}
