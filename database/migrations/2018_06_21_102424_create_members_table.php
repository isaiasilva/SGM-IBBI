<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('branch_id')->unsigned();
            $table->string('nome_completo')->nullable();
            $table->string('email', 50)->unique();
            $table->string('dob')->nullable();
            $table->string('phone')->nullable();
            $table->string('occupation')->nullable();
            $table->string('position')->default('membro');
            $table->string('address')->nullable();
            $table->string('bairro')->nullable();
            $table->string('postal')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->enum('sexo', ['masculino', 'feminino']);
            $table->enum('estado_civil', ['solteiro','casado','viuvo','divorciado','separado'])->nullable();
            $table->string('wedding_anniversary')->nullable();
            $table->string('cpf', 50)->unique();
            $table->string('rg')->nullable();
            $table->string('batismo_status')->nullable();
            $table->string('data_batismo')->nullable();
            $table->string('status')->default('ativo');
            $table->string('photo');

            $table->timestamps();
        });

        Schema::table('members', function (Blueprint $table) {
            $table->foreign('branch_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
