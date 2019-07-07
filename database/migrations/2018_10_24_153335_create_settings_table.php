<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->unsignedInteger('setting_group_id');
            $table->foreign('setting_group_id')->references('id')->on('setting_groups')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->enum('type', ['text', 'longText', 'number', 'boolean', 'html', 'list', 'password','image','radioButton'])->default('text');
            $table->string('param');
            $table->string('key');
            $table->string('options')->nullable();
            $table->longText('value')->nullable();
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
