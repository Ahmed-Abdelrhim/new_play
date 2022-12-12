<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToVerificationCodes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('verification_codes', function (Blueprint $table) {
            // $table->dropColumn('code');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('authors');
            $table->integer('otp');
            $table->timestamp('expire_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('verification_codes', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->dropColumn('otp');
            $table->dropColumn('expire_at');
        });
    }
}
