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
        Schema::create('action_role', function (Blueprint $table) {
            $table->id();
            $table->string('action_id', 64);
            $table->string('role_id', 64);
            $table->timestamps();
        });

        Schema::table('action_role', function (Blueprint $table) {
            $table->foreign('action_id')
                ->references('id')->on('actions')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('action_role', function (Blueprint $table) {
            $table->foreign('role_id')
                ->references('id')->on('roles')
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
        Schema::dropIfExists('action_role');
    }
};
