<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('full_name');
            $table->string('short_name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone', 10);
            $table->string('identity_card', 20)->nullable();
            $table->date('birth_day');
            $table->bigInteger('gender');
            $table->string('face_book')->nullable();
            $table->string('note')->nullable();
            $table->longText('images')->nullable();;
            $table->string('api_token', 80)
            ->unique()
            ->nullable()
            ->default(null);
            $table->string('menuroles');
            $table->string('status')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
