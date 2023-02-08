<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
            $table->string('passport')->nullable();
            $table->string('drivers_license')->nullable();
            $table->string('state_id')->nullable();
            $table->enum('status', ['pending', 'approved', 'declined', 'suspended'])->default('pending');
            $table->unsignedBigInteger('referrer_id')->nullable();
            $table->foreign('referrer_id')->references('id')->on('users');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert([
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'test@yahoo.com',
            'username' => 'Test',
            'password' => bcrypt('password'),
            'phone' => '09060040819',
            'address' => 'Block 41',
            'city' => 'epe',
            'state' => 'lagos',
            'country' => "nigeria",
            'zip_code' => 112112,
            'ssn' => '160211023',
            'dob' => '1998-02-14',
            'nationality' => 'nigerian',
            'experience' => 'beginner',
            'employment' => 'student',
            'related' => 'no',
            'email_verified_at' => now(),
            'status' => 'approved'
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
