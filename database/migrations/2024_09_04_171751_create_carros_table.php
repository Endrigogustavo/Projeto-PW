<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        schema::create('carros', function (Blueprint $table) {
            $table->id();
            $table->string("modelo");
            $table->string("marca");
            $table->string("ano");
            $table->string("cambio");
            $table->string("ar_condicionado");
            $table->string("cor");
            $table->string("combustivel");
            $table->string("placa");
            $table->text("Foto")->nullable();
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
        Schema::table('carros', function (Blueprint $table) {

            $table->dropColumn('Foto');
        });
    }
};
