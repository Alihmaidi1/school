<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("grade_id_old");
            $table->foreign("grade_id_old")->references("id")->on("grades");
            $table->unsignedBigInteger("classroom_id_old");
            $table->foreign("classroom_id_old")->references("id")->on("classrooms");
            $table->unsignedBigInteger("section_id_old");
            $table->foreign("section_id_old")->references("id")->on("sections");
            $table->unsignedBigInteger("grade_id_new");
            $table->foreign("grade_id_new")->references("id")->on("grades");
            $table->unsignedBigInteger("classroom_id_new");
            $table->foreign("classroom_id_new")->references("id")->on("classrooms");
            $table->unsignedBigInteger("section_id_new");
            $table->foreign("section_id_new")->references("id")->on("sections");
            $table->string("old_year");
            $table->string("new_year");
            $table->unsignedBigInteger("student_id");
            $table->foreign("student_id")->references("id")->on("students");
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
        Schema::dropIfExists('promotions');
    }
}
