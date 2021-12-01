<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSharesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Shareテーブル
        Schema::create('shares', function (Blueprint $table) {
            $table->id();
            $table->string('share');
            $table->string('user_uid')->nullable();//nullableは仮
            $table->timestamps();

            //外部キー制約
            $table->foreign('user_uid')->references('uid')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shares');
    }
}
