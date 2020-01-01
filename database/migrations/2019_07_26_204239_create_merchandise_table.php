<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchandiseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchandise', function (Blueprint $table) {
            $table->bigIncrements('id');//商品編號
            //C->Create S->Sell 
            $table->string('status',1)->default('C');
            $table->integer('user_id');
            $table->string('name',80)->nullable();
            $table->string('name_en',80)->nullable();
            $table->text('introduction');
            $table->text('introduction_en');
            $table->string('photo',50)->nullable();
            $table->integer('price')->default(0);
            $table->integer('remain_count');
            $table->timestamps();

            $table->index(['status'],'merchandise_status_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('merchandise');
    }
}
