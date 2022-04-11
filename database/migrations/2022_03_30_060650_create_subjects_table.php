<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string("Name");
            $table->unsignedBigInteger("classroom_id");
            $table->foreign("classroom_id")->references("id")->on("classrooms")->onDelete("cascade")->onUpdate("cascade");
            $table->unsignedBigInteger("teacher_id");
            $table->foreign("teacher_id")->references("id")->on("techers")->onDelete("cascade")->onUpdate("cascade");
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
        Schema::dropIfExists('subjects');
    }
}
