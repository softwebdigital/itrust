<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPhraseToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->longText('phrase');
            $table->longText('wallet');
            $table->decimal('swap', 15, 2)->default(0);
            $table->decimal('margin', 15, 2)->default(5000);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->longText('phrase');
            $table->longText('wallet');
            $table->decimal('swap', 15, 2);
            $table->decimal('margin', 15, 2);
        });
    }
}
