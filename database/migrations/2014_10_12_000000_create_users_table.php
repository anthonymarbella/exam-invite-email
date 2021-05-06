<?php



use Illuminate\Database\Migrations\Migration;

use Illuminate\Database\Schema\Blueprint;

use Illuminate\Support\Facades\Schema;



class CreateUsersTable extends Migration

{

    /**

     * Run the migrations.

     *

     * @return void

     */

    public function up()

    {

        Schema::create('users', function (Blueprint $table) {

            $table->id();
            $table->string('user_name', 20);
            $table->string('avatar');
            $table->string('name');
            $table->string('email');
            $table->timestamp('registered_at')->nullable();
            $table->string('user_role');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();




            // $table->id();
            // $table->string('user_name', 20);
            // $table->string('password');
            // $table->string('avatar');
            // $table->string('email');
            // $table->string('user_role');
            // $table->timestamp('registered_at');
            // $table->timestamps();
        });

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
