<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLobbiesTable extends Migration
{
    public function up()
    {
        Schema::create('lobbies', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->boolean('started')->default(false);
            $table->string('map');
            $table->json('graph')->nullable();
            $table->dateTime('started_at')->nullable();
            $table->dateTime('ended_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lobbies');
    }
}
