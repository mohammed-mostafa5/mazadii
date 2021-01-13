<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRulesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rules', function (Blueprint $table) {
            $table->increments('id');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('rule_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rule_id')->unsigned();
            $table->string('locale', 2)->index();
            $table->string('title');
            $table->text('description');

            $table->unique(['rule_id', 'locale']);

            $table->foreign('rule_id')
                ->references('id')
                ->on('rules')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('rule_translations');
        Schema::drop('rules');
    }
}
