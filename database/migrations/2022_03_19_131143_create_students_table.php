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
            $table->string("email");
            $table->string("password");
            $table->string("gender");
            $table->string("Name");
            $table->string("title");
            $table->integer("age");
            $table->unsignedBigInteger("section_id");
            $table->foreign("section_id")->references("id")->on("sections")->onDelete("cascade")->onUpdate("cascade");
            $table->unsignedBigInteger("parents_id");
            $table->foreign("parents_id")->references("id")->on("parents")->onDelete("cascade")->onUpdate("cascade");
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
