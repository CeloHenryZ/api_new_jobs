<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVagasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vagas', function(Blueprint $table){
           $table->id('id_vaga');
           $table->string('title');
           $table->string('description');
           $table->string('company_name');
           $table->string('necessary_skills');
           $table->string('level');
           $table->string('experience');
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
        Schema::dropIfExists('vagas');
    }
}
