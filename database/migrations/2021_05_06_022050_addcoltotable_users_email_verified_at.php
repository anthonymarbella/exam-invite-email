<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use \Doctrine\DBAL\Types\Type;

class AddcoltotableUsersEmailVerifiedAt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Type::addType('timestamp', 'MarkTopper\DoctrineDBALTimestampType\TimestampType');

        Schema::table('users', function (Blueprint $table) {
            $table->timestamp('email_verified_at')->after('registered_at');
            $table->timestamp('registered_at')->nullable()->useCurrent()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
