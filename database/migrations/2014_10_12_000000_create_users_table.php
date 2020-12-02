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
            $table->string('first_name');
            $table->string('last_name');
            $table->string('username')->nullable();
            $table->string('code')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('photo')->nullable();
            $table->string('phone');
            $table->unsignedInteger('points')->default(0);
            $table->unsignedTinyInteger('status')
                ->default(0)
                ->comment('0 => Inactive, 1 => Active');
            $table->unsignedTinyInteger('membership')
                ->default(0)
                ->comment('0 => Free, 1 => Normal, 2 => VIP, 3 => VIP/Gold, 4 => VIP/Diamond');
            $table->longText('address')->nullable();
            $table->string('attach');
            $table->integer('transactions_count')->default(0);
            $table->timestamp('approved_at')->nullable();

            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
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
