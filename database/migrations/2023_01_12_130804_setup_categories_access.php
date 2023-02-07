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
            'id' => 'CategoryController@store',
            'description' => 'Creates a new category',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('actions')->insert([
            'id' => 'CategoryController@update',
            'description' => 'Updates existing category',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('actions')->insert([
            'id' => 'CategoryController@destroy',
            'description' => 'Removes existing category',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('roles')->insert([
            'id' => 'categories-management',
            'name' => 'Categories Management',
            'description' => 'Categories Management',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('action_role')->insert([
            'action_id' => 'CategoryController@store',
            'role_id' => 'categories-management',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('action_role')->insert([
            'action_id' => 'CategoryController@update',
            'role_id' => 'categories-management',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('action_role')->insert([
            'action_id' => 'CategoryController@destroy',
            'role_id' => 'categories-management',
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
        DB::table('actions')->delete(['id' => 'CategoryController@store']);
        DB::table('actions')->delete(['id' => 'CategoryController@update']);
        DB::table('actions')->delete(['id' => 'CategoryController@destroy']);

        DB::table('roles')->delete(['id' => 'categories-management']);
    }
};
