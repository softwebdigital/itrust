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
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->string('phone');
            $table->longText('address');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->string('zip_code')->nullable();
            $table->string('ssn');
            $table->date('dob');
            $table->string('nationality');
            $table->enum('experience', ['none', 'beginner', 'amateur', 'expert']);
            $table->enum('employment', ['employed', 'unemployed', 'retired', 'student']);
            $table->enum('related', ['yes', 'no']);
            $table->enum('marital_status', ['single', 'married', 'widowed', 'divorced'])->nullable();
            $table->string('yearly_income')->default('default');
            $table->enum('source_of_funds', ['default', 'pension', 'insurance', 'inheritance', 'gift', 'property', 'something_else'])->default('default');
            $table->enum('goal', ['default', 'growth', 'income', 'trading', 'something_else'])->default('default');
            $table->enum('timeline', ['default', '4-7', '7'])->default('default');
            $table->boolean('dsp')->default(true);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('photo')->nullable();
            $table->enum('status', [])->default('pending');
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
