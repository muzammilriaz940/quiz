<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCreatedByInTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('exams', 'created_by')) {
            Schema::table('exams', function($table) {
                $table->string('created_by')->nullable();
            });
        }

        if (!Schema::hasColumn('exams', 'updated_by')) {
            Schema::table('exams', function($table) {
                $table->string('updated_by')->nullable();
            });
        }

        if (!Schema::hasColumn('users', 'created_by')) {
            Schema::table('users', function($table) {
                $table->string('created_by')->nullable();
            });
        }

        if (!Schema::hasColumn('users', 'updated_by')) {
            Schema::table('users', function($table) {
                $table->string('updated_by')->nullable();
            });
        }

        if (!Schema::hasColumn('tests', 'created_by')) {
            Schema::table('tests', function($table) {
                $table->string('created_by')->nullable();
            });
        }

        if (!Schema::hasColumn('tests', 'updated_by')) {
            Schema::table('tests', function($table) {
                $table->string('updated_by')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
            //
    }
}
