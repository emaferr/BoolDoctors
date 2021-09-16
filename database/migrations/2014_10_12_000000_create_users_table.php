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
            $table->id();
            $table->bigInteger('reads')->unsigned()->default(0)->index();
            $table->string('name', 50);
            $table->string('lastname', 50);
            $table->string('city');
            $table->string('pv');
            $table->string('address', 255);
            $table->string('phone_number', 13)->nullable();
            $table->longText('curriculum')->nullable();
            $table->longText('service')->nullable();
            $table->string('profile_image', 255)->nullable();
            $table->string('email', 255)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 255);
            $table->rememberToken();
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

        Schema::dropIfExists('users');
    }
}
