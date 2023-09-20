<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('owner_name')->nullable();
            $table->string('restaurant_code')->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('restaurant_name')->nullable();
            $table->integer('is_admin')->default(0);
            // $table->foreignId('role_id')->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
           $table->text('token')->nullable();
            $table->text('address')->nullable();
            $table->date('start_reg')->nullable();
            $table->date('end_reg')->nullable();
            $table->string('price_reg')->nullable();
            $table->string('password');
            $table->string('phone_restaurant')->nullable();
            $table->string('phone_owner')->nullable();
            $table->integer('status')->default(1);
            $table->integer('added_by')->nullable();
            $table->string('facebook')->nullable();
            $table->string('insta')->nullable();
            $table->string('snapchat')->nullable();
            $table->foreignId('theme_id')->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('subscription_id')->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();

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
        Schema::dropIfExists('admins');
    }
};
