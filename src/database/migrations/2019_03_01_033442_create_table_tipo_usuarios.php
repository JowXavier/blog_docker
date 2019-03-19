<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTipoUsuarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_usuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('active');
            $table->string('description');
            $table->timestamps();
        });
        DB::table('tipo_usuarios')->insert(
            array(
                'description' => 'Administrador',
                'active' => true
            )
        );
        DB::table('tipo_usuarios')->insert(
            array(
                'description' => 'Regular',
                'active' => true
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipo_usuarios');
    }
}
