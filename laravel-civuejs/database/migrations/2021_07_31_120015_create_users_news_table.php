<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_news', function (Blueprint $table) {
            $table->id();
            $table->string("firstname", 30);
            $table->string("lastname", 5);
            $table->string("gender", 5);
            $table->string("birthday", 30);
            $table->string("email", 30);
            $table->string("contact", 10);
            $table->string("address", 50);
            //$table->boolval('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_news');
    }
}
