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
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            $table->string('photo')->nullable()->default('avatar.jpg');
            $table->string('phone');
            $table->unsignedInteger('points')->default(0);
            $table->unsignedTinyInteger('status')
                ->default(1)
                ->comment('0 => Inactive, 1 => Active, 2 => Suspended for 1 month, 3 => Suspended for 3 months, 3 => Suspended PERMANENTLY');
            $table->unsignedTinyInteger('membership')
                ->default(0)
                ->comment('0 => Free, 1 => Normal, 2 => VIP, 3 => VIP/Gold, 4 => VIP/Diamond');
            $table->longText('address')->nullable();
            $table->string('attach');
            $table->integer('transactions_count')->default(0);

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
