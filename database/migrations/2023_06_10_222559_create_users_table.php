<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('is_user', 122)->nullable();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->string('expertise', 190)->nullable();
            $table->string('experience', 122)->nullable();
            $table->string('firstname', 122)->nullable();
            $table->string('lastname', 122)->nullable();
            $table->text('about')->nullable();
            $table->string('profileImage', 122)->nullable();
            $table->string('videoIntro', 122)->nullable();
            $table->string('availableHours', 122)->nullable();
            $table->string('availableDays', 122)->nullable();
            $table->string('workPreference', 122)->nullable();
            $table->string('workType', 150)->nullable();
            $table->string('slug', 150)->nullable();
            $table->string('address', 150)->nullable();
            $table->string('roleLevel', 150)->nullable();
            $table->string('education', 150)->nullable();
            $table->string('contactNumber', 122)->nullable();
            $table->string('companyLocation', 122)->nullable();
            $table->string('user_type', 11)->nullable();
            $table->string('companyName', 122)->nullable();
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
};
