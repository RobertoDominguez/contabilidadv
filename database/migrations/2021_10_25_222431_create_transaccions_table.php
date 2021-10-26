<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaccionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaccions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_usuario');
            $table->string('detalle');
            $table->string('observacion')->nullable();
            $table->float('total');
            $table->boolean('es_ingreso');
            $table->timestamps();

            $table->foreign('id_usuario')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaccions');
    }
}


/*
create table transaccions(
id bigint unsigned AUTO_INCREMENT NOT NULL PRIMARY KEY,
id_usuario bigint unsigned NOT NULL,
detalle varchar(250) NOT NULL,
observacion varchar(255),
total double(8,2) NOT NULL,
es_ingreso boolean NOT NULL,
created_at timestamp null,
updated_at timestamp null,
FOREIGN KEY (id_usuario) REFERENCES users(id) on DELETE CASCADE on UPDATE CASCADE
);
*/