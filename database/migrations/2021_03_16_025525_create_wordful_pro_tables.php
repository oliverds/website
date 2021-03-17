<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWordfulProTables extends Migration
{
    public function up()
    {
        Schema::create('subscribers', function (Blueprint $table) {
            $table->id();

            $table->string('email')->unique();
            $table->timestamp('confirmed_at')->index()->nullable();

            $table->timestamps();
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->dateTime('emailed_at')->nullable();
        });
    }
}
