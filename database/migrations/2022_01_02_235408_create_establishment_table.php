<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstablishmentTable extends Migration{

    public function up(){
        Schema::create('establishment', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("cnpj")->unique();
            $table->string("address");
            $table->integer("address_number");
            $table->string("address_addon");
            $table->string("district");
            $table->string("city");
            $table->string("uf");
            $table->string("cep");
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at');
        });
    }

    public function down(){
        Schema::dropIfExists('establishment');
    }
}
