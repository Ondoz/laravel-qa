<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *Bilangan bulat bertanda (signed) mampu merepresentasikan nilai bilangan bulat negatif,
      sementara bilangan bulat tak bertanda (unsigned) hanya mampu merepresentasikan bilangan bulat positif.
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('question_id');
            $table->unsignedInteger('user_id');
            $table->text('body');
            $table->integer('votes_count')->default(0);
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
        Schema::dropIfExists('answers');
    }
}
