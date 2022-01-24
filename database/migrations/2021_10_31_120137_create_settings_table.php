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
            $table->string('title');
            $table->string('logo');
            $table->string('phone');
            $table->string('email');
            $table->string('address');
            $table->string('facebook_url')->nullable();;
            $table->string('instagram_url')->nullable();;
            $table->string('line_url')->nullable();;
            $table->text('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->string('meta_image')->nullable();
            $table->string('meta_url')->nullable();
            $table->string('apple_touch_icon')->nullable();
            $table->string('icon_sm')->nullable();
            $table->string('icon_md')->nullable();
            $table->boolean('paypal_sandbox')->default(1);
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
