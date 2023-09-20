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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');
            $table->string('name_en');
            $table->string('name_ku');
            $table->string('name_tr');
            $table->string('first_title_ar');
            $table->string('first_title_en');
            $table->string('first_title_ku');
            $table->string('first_title_tr');
            $table->string('second_title_ar');
            $table->string('second_title_en');
            $table->string('second_title_ku');
            $table->string('second_title_tr');
            $table->string('third_title_ar');
            $table->string('third_title_en');
            $table->string('third_title_ku');
            $table->string('third_title_tr');
            $table->date('start_date');
            $table->date('end_date');
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
        Schema::dropIfExists('offers');
    }
};
