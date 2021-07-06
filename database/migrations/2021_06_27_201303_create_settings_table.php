<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('email',255);
            $table->string('phone1',30);
            $table->string('phone2',30)->nullable();
            $table->string('phone3',30)->nullable();
            $table->string('phone4',30)->nullable();
            $table->string('phone5',30)->nullable();
            $table->string('phone6',30)->nullable();
            $table->string('facebook',255)->nullable();
            $table->string('youtube',255)->nullable();
            $table->string('googleplus',255)->nullable();
            $table->string('insta',255)->nullable();
            $table->string('twitter',255)->nullable();
            $table->string('tiktok',255)->nullable();
            $table->string('snap',255)->nullable();
            $table->string('whatsapp',255)->nullable();
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
        Schema::dropIfExists('settings');
    }
}
