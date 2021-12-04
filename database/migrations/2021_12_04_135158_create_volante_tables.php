<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('volante_sessions', function (Blueprint $table) {
            $table->id();

            $table->uuid('uuid')->unique();
            $table->string('hostname', 100)->nullable();
            $table->string('browser', 20)->nullable();
            $table->string('os', 20)->nullable();
            $table->string('device', 20)->nullable();
            $table->string('screen', 11)->nullable();
            $table->string('language', 35)->nullable();
            $table->string('country', 2)->nullable();

            $table->timestamps();

            $table->index('created_at');
        });

        Schema::create('volante_pageviews', function (Blueprint $table) {
            $table->id();

            $table->foreignId('session_id')->constrained('volante_sessions')->onDelete('cascade');
            $table->string('url', 500);
            $table->string('referrer', 500)->nullable();

            $table->timestamps();

            $table->index('created_at');
            $table->index('session_id');
            $table->index(['session_id', 'created_at']);
        });

        Schema::create('volante_events', function (Blueprint $table) {
            $table->id();

            $table->foreignId('session_id')->constrained('volante_sessions')->onDelete('cascade');
            $table->string('url', 500);
            $table->string('type', 50);
            $table->string('value', 50);

            $table->timestamps();

            $table->index('created_at');
            $table->index('session_id');
        });
    }
};
