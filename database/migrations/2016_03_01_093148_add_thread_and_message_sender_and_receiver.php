<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddThreadAndMessageSenderAndReceiver extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('messages', function ($table) {
            $table->integer('sender_id');
            $table->integer('receiver_id');
        });
        Schema::table('threads', function ($table) {
            $table->integer('sender_id');
            $table->integer('receiver_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('messages', function($table) {
            $table->dropColumn('sender_id');
            $table->dropColumn('receiver_id');
        });
        Schema::table('threads', function($table) {
            $table->dropColumn('sender_id');
            $table->dropColumn('receiver_id');
        });
    }
}
