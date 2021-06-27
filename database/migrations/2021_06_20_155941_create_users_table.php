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
            $table->unsignedInteger('id')->autoIncrement();
            $table->string('name');
            $table->string('email')->unique()->notNullable();
            $table->string('password');
            $table->timestamps();
        });
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'vijay',
            'email' => 'vijaysharma0757@gmail.com',
            'password' => app('hash')->make('jack1234'),
            'created_at' => date('Y-m-d H:i:s', time()),
        ]);
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
