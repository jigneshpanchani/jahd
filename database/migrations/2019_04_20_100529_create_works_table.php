<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('works', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id')->unsigned()->nullable();
            $table->integer('department_id')->unsigned()->nullable();
            $table->decimal('price',8,2);
            $table->integer('quantity');
            $table->decimal('total',8,2)->default(0);
            $table->integer('withdrawal')->default(0);
            $table->integer('salary')->default(0);
            $table->date('date');
            $table->text('note')->nullable(true);
            $table->timestamps();
            $table->foreign('employee_id')->references('id')->on('employees');
            $table->foreign('department_id')->references('id')->on('departments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('works');
    }
}
