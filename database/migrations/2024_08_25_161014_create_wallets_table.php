<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->decimal('balance', 15, 2)->default(0);
            $table->decimal('ic_wallet', 15, 2)->default(0);
            $table->decimal('it_wallet', 15, 2)->default(0);
            $table->decimal('oc_wallet', 15, 2)->default(0);
            $table->decimal('ot_wallet', 15, 2)->default(0);
            $table->longText('phrase')->nullable();
            $table->decimal('swap', 15, 2)->default(0);
            $table->decimal('margin', 15, 2)->default(5000);
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
        Schema::dropIfExists('wallets');
    }
}
