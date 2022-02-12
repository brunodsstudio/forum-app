<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LikeViews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likeviews', function (Blueprint $table) {
            $table->increments('id');// Id da tabela (chave primária e incremento)
            $table->integer('views')->unsigned(); //Site
            $table->integer('likes')->unsigned(); //Site]
            $table->integer('deslikes')->unsigned(); //Site]
            $table->integer('user_id')->unsigned(); // Define o campo como chave extrangeira (foreign key)
            $table->integer('post_id')->unsigned(); // Define o campo como chave extrangeira (foreign key)
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
        Schema::drop('likeviews');
    }
}
