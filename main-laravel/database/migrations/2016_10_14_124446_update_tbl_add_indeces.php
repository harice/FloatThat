<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTblAddIndeces extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // CONVERT TO INNODB THE FF TABLES;
        DB::statement('ALTER TABLE deals ENGINE = InnoDB');
        DB::statement('ALTER TABLE invites ENGINE = InnoDB');
        DB::statement('ALTER TABLE password_resets ENGINE = InnoDB');
        DB::statement('ALTER TABLE payments ENGINE = InnoDB');
        DB::statement('ALTER TABLE products ENGINE = InnoDB');
        DB::statement('ALTER TABLE sessions ENGINE = InnoDB');
        DB::statement('ALTER TABLE users ENGINE = InnoDB');
        DB::statement('ALTER TABLE winners ENGINE = InnoDB');


        Schema::table('deals', function($table)
        {
            $table->integer('user_id')->unsigned()->change();
            $table->index('user_id');
            
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('invites', function($table)
        {
            $table->integer('user_id')->unsigned()->change();
            $table->index('user_id');

            $table->integer('float_id')->unsigned()->change();
            $table->index('float_id');
            

            $table->foreign('float_id')->references('id')->on('deals');
            $table->foreign('user_id')->references('id')->on('users');
        });


        Schema::table('payments', function($table)
        {
            $table->index('success')->change();

            $table->integer('user_id')->unsigned()->change();
            $table->index('user_id');
            

            $table->integer('float_id')->unsigned()->nullable()->defaut(0)->change();
            $table->index('float_id');
            
            $table->foreign('user_id')->references('id')->on('users');
            
            // NOT APPLICABLE BECAUSE column has values that do not exist in deals table
            //$table->foreign('float_id')->references('id')->on('deals');
            
        });

        Schema::table('winners', function($table)
        {
            $table->integer('user_id')->unsigned()->change();
            $table->index('user_id');

            $table->integer('float_id')->unsigned()->change();
            $table->index('float_id');
            

            $table->foreign('float_id')->references('id')->on('deals');
            $table->foreign('user_id')->references('id')->on('users');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deals', function($table)
        {
            $table->dropForeign('deals_user_id_foreign');
            $table->dropIndex('deals_user_id_index');
        });

        Schema::table('invites', function($table)
        {
            $table->dropForeign('invites_user_id_foreign');
            $table->dropIndex('invites_user_id_index');

            $table->dropForeign('invites_float_id_foreign');
            $table->dropIndex('invites_float_id_index');
            
        });

        Schema::table('payments', function($table)
        {
            $table->dropIndex('payments_success_index');

            $table->dropForeign('payments_user_id_foreign');
            $table->dropIndex('payments_user_id_index');

            //$table->dropForeign('payments_float_id_foreign');
            $table->dropIndex('payments_float_id_index');
            
        });

        Schema::table('winners', function($table)
        {
            $table->dropForeign('winners_user_id_foreign');
            $table->dropIndex('winners_user_id_index');

            $table->dropForeign('winners_float_id_foreign');
            $table->dropIndex('winners_float_id_index');
            
        });


        // CONVERT TO INNODB THE FF TABLES;
        DB::statement('ALTER TABLE deals ENGINE = MyISAM');
        DB::statement('ALTER TABLE invites ENGINE = MyISAM');
        DB::statement('ALTER TABLE password_resets ENGINE = MyISAM');
        DB::statement('ALTER TABLE payments ENGINE = MyISAM');
        DB::statement('ALTER TABLE products ENGINE = MyISAM');
        DB::statement('ALTER TABLE sessions ENGINE = MyISAM');
        DB::statement('ALTER TABLE users ENGINE = MyISAM');
        DB::statement('ALTER TABLE winners ENGINE = MyISAM');
    }
}
