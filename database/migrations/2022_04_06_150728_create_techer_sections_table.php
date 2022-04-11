<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTecherSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('techer_sections', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("techer_id");
            $table->foreign("techer_id")->references("id")->on("techers")->onDelete("cascade")->onUpdate("cascade");
            $table->unsignedBigInteger("section_id");
            $table->foreign("section_id")->references("id")->on("sections")->onDelete("cascade")->onUpdate("cascade");
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
        Schema::dropIfExists('techer_sections');
    }
}
