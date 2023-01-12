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
            'id' => 'ThreadsController@store',
            'description' => 'Creates a new thread',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('actions')->insert([
            'id' => 'ThreadsController@update',
            'description' => 'Updates existing thread',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('actions')->insert([
            'id' => 'ThreadsController@destroy',
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
            'action_id' => 'ThreadsController@store',
            'role_id' => 'threads-management',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('action_role')->insert([
            'action_id' => 'ThreadsController@update',
            'role_id' => 'threads-management',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('action_role')->insert([
            'action_id' => 'ThreadsController@destroy',
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
        DB::table('actions')->delete(['id' => 'ThreadsController@store']);
        DB::table('actions')->delete(['id' => 'ThreadsController@update']);
        DB::table('actions')->delete(['id' => 'ThreadsController@destroy']);

        DB::table('roles')->delete(['id' => 'threads-management']);
    }
};
