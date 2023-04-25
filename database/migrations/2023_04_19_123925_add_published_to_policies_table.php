<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPublishedToPoliciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('policies', function (Blueprint $table) {
            $table->dateTime('approved_at')->nullable();
            $table->dateTime('published_at')->nullable();
            $table->string('policy_id')->nullable();
            $table->foreignId('publisher_id')->nullable()->references('id')->on('users')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('policies', function (Blueprint $table) {
            $table->dropColumn(array_merge([
                'approved_at',
                'published_at',
                'publisher_id'
            ]));
        });
    }
}
