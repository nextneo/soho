<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('name',50);
            $table->integer('total_floor',)->nullable()->default('0');
            $table->integer('total_block',)->nullable()->default('0');   
            $table->integer('created_id',)->nullable();
            $table->integer('updated_id',)->nullable();
            $table->integer('deleted_id',)->nullable();
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
        Schema::dropIfExists('departments');
    }
}
