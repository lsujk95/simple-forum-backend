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
            'id' => 'ReplyController@store',
            'description' => 'Creates a new reply',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('actions')->insert([
            'id' => 'ReplyController@update',
            'description' => 'Updates existing reply',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('actions')->insert([
            'id' => 'ReplyController@destroy',
            'description' => 'Removes existing reply',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('roles')->insert([
            'id' => 'replies-management',
            'name' => 'Replies Management',
            'description' => 'Replies Management',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('action_role')->insert([
            'action_id' => 'ReplyController@store',
            'role_id' => 'replies-management',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('action_role')->insert([
            'action_id' => 'ReplyController@update',
            'role_id' => 'replies-management',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('action_role')->insert([
            'action_id' => 'ReplyController@destroy',
            'role_id' => 'replies-management',
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
        DB::table('actions')->delete(['id' => 'ReplyController@store']);
        DB::table('actions')->delete(['id' => 'ReplyController@update']);
        DB::table('actions')->delete(['id' => 'ReplyController@destroy']);

        DB::table('roles')->delete(['id' => 'replies-management']);
    }
};
