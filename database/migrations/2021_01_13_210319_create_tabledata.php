<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTabledata extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tabledata', function (Blueprint $table) {
          $table->increments('id');
          $table->string('lastname');
          $table->string('firstname');
          $table->date('birthday');
          $table->string('avatar');
          $table->string('email');
          $table->string('homepage');
          $table->unsignedDecimal('wage', 8, 2);
          $table->boolean('hasparking');
          $table->timestamps();

          $table->index('created_at');
          $table->index('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tabledata');
    }
}
