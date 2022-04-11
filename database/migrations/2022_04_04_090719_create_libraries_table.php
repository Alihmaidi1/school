<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibrariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('libraries', function (Blueprint $table) {
            $table->id();
            $table->string("Name_File");
            $table->unsignedBigInteger("classroom_id");
            $table->foreign("classroom_id")->references("id")->on("classrooms")->onDelete("cascade")->onUpdate("cascade");
            $table->unsignedBigInteger("section_id");
            $table->foreign("section_id")->references("id")->on("sections")->onDelete("cascade")->onUpdate("cascade");
            $table->unsignedBigInteger("techer_id");
            $table->foreign("techer_id")->references("id")->on("techers")->onDelete("cascade")->onUpdate("cascade");
            $table->string("extension");
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
        Schema::dropIfExists('libraries');
    }
}
