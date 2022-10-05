<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnInUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('users', 'instructorNo')) {
            Schema::table('users', function($table) {
                $table->string('instructorNo')->nullable()->after('email');
            });
        }

        if (!Schema::hasColumn('users', 'instructorInitials')) {
            Schema::table('users', function($table) {
                $table->string('instructorInitials')->nullable()->after('instructorNo');;
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
