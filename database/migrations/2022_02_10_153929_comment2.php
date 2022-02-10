<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Comment2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment', function (Blueprint $table) {
            $table->increments('id');// Id da tabela (chave primária e incremento)
            $table->text('description');
            $table->boolean('deleted')->default(true); //deleted or online
            $table->timestamps();
            $table->foreignId('user_id')->references('id')->on('users'); // Define o campo como chave extrangeira (foreign key)
            $table->foreignId('post_id')->references('id')->on('post'); // Define o campo como chave extrangeira (foreign key)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('comment');
    }
}
