<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTradesToInvestments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('investments', function (Blueprint $table) {
            $table->enum('asset_type', ['stocks', 'crypto']);
            // $table->enum('account_type', ['basic_ira', 'offshore']);
            // $table->string('asset'); Known to be type
            // $table->decimal('amount', 15, 2);
            $table->string('interval')->default('24hrs');
            $table->string('leverage')->default('1.0X');
            $table->decimal('entry_point', 15, 2)->nullable();
            $table->decimal('stop_loss', 15, 2)->nullable();
            $table->decimal('take_profit', 15, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('investments', function (Blueprint $table) {
            Schema::dropIfExists('investments');
        });
    }
}
