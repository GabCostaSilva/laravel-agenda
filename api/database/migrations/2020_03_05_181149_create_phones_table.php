<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phones', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->integer('area_code');
            $table->string('number');
            $table->unsignedBigInteger('contact_id');

            $table->foreign('contact_id')
                ->references('id')
                ->on('contacts')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->index(['area_code', 'number']);
            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phones');
    }
}
