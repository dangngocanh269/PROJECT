<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBangdiemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bangdiem', function (Blueprint $table) {
            $table->integer('id_sv')->unsigned();
            $table->integer('id_mh')->unsigned();
            $table->primary(['id_sv','id_mh']);
            $table->float('diemtk');
            $table->foreign('id_sv')->references('id')->on('sinhvien')->onDelete('CASCADE');
            $table->foreign('id_mh')->references('id')->on('monhoc')->onDelete('CASCADE');

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
        Schema::dropIfExists('bangdiem');
    }
}
