<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('plano_de_contas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            $table->unsignedBigInteger('superior')->nullable();
            $table->string('identificador');
            $table->string('descricao');
            $table->boolean('totalizar')->nullable()->default(false);
            $table->enum('tipo', ['receita','despesa']);
            $table->double('meta')->nullable()->default(0);
            $table->double('acumulado')->nullable()->default(0);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('plano_de_contas', function (Blueprint $table)
        {
            $table->foreign('superior')->references('id')->on('plano_de_contas');
        });
    }

    public function down()
    {
        Schema::dropIfExists('plano_de_contas');
    }
};
