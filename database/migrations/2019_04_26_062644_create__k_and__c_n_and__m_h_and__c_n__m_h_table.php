<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKAndCNAndMHAndCNMHTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('khoa', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tenkhoa');
            $table->string('tenkhoa_slug');
            $table->integer('gv_id')->unsigned()->nullable();
            $table->foreign('gv_id')->references('id')->on('giaovien')->onDelete('SET NULL');
            $table->timestamps();
        });
        Schema::create('chuyennganh', function (Blueprint $table) {
            $table->increments('id');
            $table->string('macn');
            $table->string('tencn');
            $table->string('tencn_slug');
            $table->integer('khoa_id')->unsigned();
            $table->foreign('khoa_id')->references('id')->on('khoa')->onDelete('CASCADE');
            $table->timestamps();
        });
        Schema::create('monhoc', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mamon');
            $table->string('tenmon');
            $table->integer('sotinchi');
            $table->string('tenmon_slug');
            $table->float('heso');
            $table->timestamps();
        });
        Schema::create('cn_mh', function (Blueprint $table) {
            $table->integer('ma_cn')->unsigned();
            $table->integer('ma_mh')->unsigned();
            $table->primary(['ma_cn','ma_mh']);
            $table->foreign('ma_cn')->references('id')->on('chuyennganh')->onDelete('CASCADE');
            $table->foreign('ma_mh')->references('id')->on('monhoc')->onDelete('CASCADE');


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
        Schema::dropIfExists('khoa');
        Schema::dropIfExists('chuyennganh');
        Schema::dropIfExists('monhoc');
        Schema::dropIfExists('cn_mh');
    }
}
