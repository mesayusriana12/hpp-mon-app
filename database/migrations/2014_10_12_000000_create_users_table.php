<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username',50)->unique();
            $table->string('email',60);
            $table->string('password',100);
            $table->string('fullname',100);
            $table->string('phone_number',13)->nullable();
            $table->string('profile_picture',100)->default('default.jpg');
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id')->references('id')->on('m_role')->onUpdate('cascade')->onDelete('restrict');
            $table->rememberToken();
            $table->timestamps();
        });
        DB::table('users')->insert([
            [
                'id' => 1,
                'username' => 'admin',
                'email' => 'admin@hppmon.com',
                'password' => Hash::make('hppmon'),
                'fullname' => 'Super Admin HPP-Monitoring',
                'phone_number' => '0812345678910',
                'profile_picture' => 'default.jpg',
                'role_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 2,
                'username' => 'staff',
                'email' => 'staff@hppmon.com',
                'password' => Hash::make('hppmon'),
                'fullname' => 'Staff HPP-Monitoring',
                'phone_number' => '0810987654321',
                'profile_picture' => 'default.jpg',
                'role_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
