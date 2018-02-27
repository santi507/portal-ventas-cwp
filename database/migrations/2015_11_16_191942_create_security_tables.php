<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSecurityTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Roles', function (Blueprint $table) {
            $table->increments('IDRoles');
            $table->string('name', 255);
            $table->string('description', 255);
        });

        Schema::create('Permissions', function (Blueprint $table) {
            $table->increments('IDPermissions');
            $table->string('name', 255);
            $table->string('description', 255);
        });

        Schema::create('Permissions_Roles', function (Blueprint $table) {
            $table->integer('FK_IDPermissions')->unsigned();
            $table->integer('FK_IDRoles')->unsigned();
            $table->foreign('FK_IDPermissions', 'FK__Permissions__Roles')->references('IDPermissions')->on('Permissions')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('FK_IDRoles', 'FK__Roles__Permissions')->references('IDRoles')->on('Roles')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::create('Audit', function (Blueprint $table) {
            $table->increments('IDAudit');
            $table->string('domain', 255);
            $table->string('user', 255);
            $table->string('role', 255);
            $table->string('ip', 15);
            $table->string('module', 255);
            $table->string('action', 255);
            $table->string('item_id', 45);
            $table->longText('context');
            $table->datetime('created_at');
        });

        Schema::create('Settings', function (Blueprint $table) {
            $table->string('option_name', 64);
            $table->string('option_value', 255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('Permissions_Roles');
        Schema::drop('Permissions');
        Schema::drop('Roles');
        Schema::drop('Audit');
        Schema::drop('Settings');
    }
}
