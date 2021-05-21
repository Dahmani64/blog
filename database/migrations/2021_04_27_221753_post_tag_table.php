<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PostTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_tag', function(Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')
                  ->constrained()
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreignId('tag_id')
                  ->constrained()
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
