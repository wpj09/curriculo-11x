<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurriculumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curriculums', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            /** Sobre Mim */
            $table->text('about_me')->nullable();

            $table->string('scholarity')->nullable();

            /** Ocupação desejada */
            $table->string('desired_occupation')->nullable();

            /** Conhecimentos - Cursos */
            $table->text('knowledge_courses')->nullable();

            /** Experiências */
            $table->string('company')->nullable();
            $table->date('start_date')->nullable();
            $table->date('final_date')->nullable();
            $table->string('position_held')->nullable();
            $table->string('reference_contact')->nullable();
            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('curriculums');
    }
}
