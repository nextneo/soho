<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentsTable extends Migration
{
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
			$table->bigIncrements('id')->unsigned();
			$table->unsignedBigInteger('block_id');
			$table->foreign('block_id')
					->references('id')
					->on('blocks')
					->onDelete('cascade');
			$table->string('code',50);
			$table->integer('floor',)->nullable();
			$table->string('acreage',)->nullable();
			$table->integer('total_bedroom',)->nullable();
			$table->integer('total_toilet',)->nullable();
			$table->string('room_view',50)->nullable();
			$table->decimal('selling_price',)->nullable();
			$table->decimal('rental_price',)->nullable();
			$table->string('status',)->nullable();
			$table->string('info',100);
			$table->integer('created_id',)->nullable();
			$table->integer('updated_id',)->nullable();
			$table->integer('deleted_id',)->nullable();
			$table->timestamps();
			$table->softDeletes();  
        });
    }

    public function down()
    {
        Schema::dropIfExists('apartments');
    }
}