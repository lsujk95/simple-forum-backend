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
            'id' => 'ForumController@store',
            'description' => 'Creates a new forum',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('actions')->insert([
            'id' => 'ForumController@update',
            'description' => 'Updates existing forum',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('actions')->insert([
            'id' => 'ForumController@destroy',
            'description' => 'Removes existing forum',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('roles')->insert([
            'id' => 'forums-management',
            'name' => 'Forums Management',
            'description' => 'Forums Management',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('action_role')->insert([
            'action_id' => 'ForumController@store',
            'role_id' => 'forums-management',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('action_role')->insert([
            'action_id' => 'ForumController@update',
            'role_id' => 'forums-management',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('action_role')->insert([
            'action_id' => 'ForumController@destroy',
            'role_id' => 'forums-management',
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
        DB::table('actions')->delete(['id' => 'ForumController@store']);
        DB::table('actions')->delete(['id' => 'ForumController@update']);
        DB::table('actions')->delete(['id' => 'ForumController@destroy']);

        DB::table('roles')->delete(['id' => 'forums-management']);
    }
};
