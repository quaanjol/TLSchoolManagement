<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('department_id');
            $table->integer('parent_school_id')->nullable();
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->string('address')->nullable();
            $table->integer('gender')->default(0);
            $table->date('dob')->nullable();
            $table->integer('syear');
            $table->integer('status')->default(1);
            $table->string('img')->nullable();
            $table->text('courses')->nullable();
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
        Schema::dropIfExists('students');
    }
}
