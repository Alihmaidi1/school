<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTechersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('techers', function (Blueprint $table) {
            $table->id();
            $table->string("Name");
            $table->string("email");
            $table->string("password");
            $table->string("number");
            $table->string("gender");
            $table->date("start_date");
            $table->unsignedBigInteger("salary_id");
            $table->foreign("salary_id")->references("id")->on("salaries")->onDelete("cascade")->onUpdate("cascade");
            $table->string("title");
            $table->string("spicefic");
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
        Schema::dropIfExists('techers');
    }
}
