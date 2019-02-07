<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnnoncesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('annonces', function (Blueprint $table) {

            $table->increments('id');
            $table->string('nom');
            $table->string('adresse');
            $table->float('sup_int');
            $table->float('sup_ext')->nullable()->default(null);
            $table->integer('nb_piece');
            $table->integer('has_elevator')->default(0);
            $table->string('dim_porte')->nullable()->default(null);
            $table->string('dim_esc')->nullable()->default(null);
            $table->integer('user_id')->unsigned();
            $table->text('description');
            $table->string('path_to_dir');
            $table->float('prix');
            $table->text('html')->nullable()->default(null);
            $table->timestamps();
        });

        Schema::table('annonces', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('annonces');
    }
}