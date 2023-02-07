<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('actions')->insert([
            'id' => 'ThreadController@store',
            'description' => 'Creates a new thread',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('actions')->insert([
            'id' => 'ThreadController@update',
            'description' => 'Updates existing thread',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('actions')->insert([
            'id' => 'ThreadController@destroy',
            'description' => 'Removes existing thread',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('roles')->insert([
            'id' => 'threads-management',
            'name' => 'Threads Management',
            'description' => 'Threads Management',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('action_role')->insert([
            'action_id' => 'ThreadController@store',
            'role_id' => 'threads-management',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('action_role')->insert([
            'action_id' => 'ThreadController@update',
            'role_id' => 'threads-management',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('action_role')->insert([
            'action_id' => 'ThreadController@destroy',
            'role_id' => 'threads-management',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('actions')->delete(['id' => 'ThreadController@store']);
        DB::table('actions')->delete(['id' => 'ThreadController@update']);
        DB::table('actions')->delete(['id' => 'ThreadController@destroy']);

        DB::table('roles')->delete(['id' => 'threads-management']);
    }
};
