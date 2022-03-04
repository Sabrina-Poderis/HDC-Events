<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration{
    public function up(){
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->text("description");
            $table->foreignId('establishment_id');
            $table->dateTime('event_date');
            $table->enum('type', ['presencial', 'online']);
            $table->string("image");
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at');
        });
    }

    public function down(){
        Schema::dropIfExists('events');
    }
}