<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('timeline_id')->default(0);
            $table->bigInteger('user_id')->default(0);
            $table->longText('post');
            $table->integer('type')->default(0);
            $table->boolean('is_active')->default(true);
            $table->bigInteger('post_id')->default(0);
            $table->boolean('is_repost')->default(false);
            $table->boolean('is_draft')->default(true);
            $table->boolean('deleted')->default(false);
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
        Schema::dropIfExists('posts');
    }
}
