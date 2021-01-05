<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mails', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user_from')->constrained('users');
            $table->foreignId('id_user_to')->constrained('users');
            $table->string('subject')->nullable();
            $table->string('message')->nullable();
            $table->boolean('is_read')->default(false);
            $table->timestamp('sent')->nullable();
//            $table->timestamps();
            $table->timestamp('created')->nullable();
            $table->timestamp('created')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mails');
    }
}
