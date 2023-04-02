<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();


             $table->unsignedBigInteger('user_id');
             $table->index('user_id', 'sale_user_idx');
             $table->foreign('user_id', 'sale_user_fk')->on('users')->references('id');

             $table->unsignedBigInteger('post_id');
             $table->index('post_id', 'sale_post_idx');
             $table->foreign('post_id', 'sale_post_fk')->on('posts')->references('id');

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
        Schema::dropIfExists('sales');
    }
};
