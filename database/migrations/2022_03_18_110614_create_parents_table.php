<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parents', function (Blueprint $table) {
            $table->id();
            $table->string("email");
            $table->string("password");

            $table->string("father_name");
            $table->string("father_Number");
            $table->string("father_Title");
            $table->string("father_nationality");
            $table->string("father_job");

            $table->string("mother_Number");
            $table->string("mother_Title");
            $table->string("mother_name");
            $table->string("mother_nationality");
            $table->string("mother_job");

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
        Schema::dropIfExists('parents');
    }
}
