<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Post extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post', function (Blueprint $table) {
            $table->increments('id');// Id da tabela (chave primária e incremento)
            $table->string('title', 100);
            $table->text('description');
            $table->boolean('status')->default(true); //deleted or online
            $table->binary('post_image')->nullable(); // Imagem do Produto
            $table->string('post_type', 6)->nullable(); // Imagem do Produto
            $table->integer('master_id')->unsigned(); //Site
            $table->timestamps();
            $table->foreignId('user_id')->references('id')->on('users'); // Define o campo como chave extrangeira (foreign key)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('post');
    }
}
