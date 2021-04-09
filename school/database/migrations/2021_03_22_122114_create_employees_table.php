<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('department_id')->nullable();
            $table->string('type');
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->integer('gender')->default(0);
            $table->date('dob')->nullable();
            $table->date('doj')->nullable();
            $table->string('address')->nullable();
            $table->integer('status')->default(1);
            $table->string('img')->nullable();
            $table->date('deleted_at')->nullable();
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
        Schema::dropIfExists('employees');
    }
}
