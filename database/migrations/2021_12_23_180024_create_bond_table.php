<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBondTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bond', function (Blueprint $table) {
            $table->id();
            $table->date('issue_date');
            $table->date('turnover_date');
            $table->integer('nominal_price');
            $table->enum('coupon_payment_frequency', [1,2,4,12]);
            $table->enum('interest_accrual_period', [360,364,365]);
            $table->integer('coupon_rate');
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
        Schema::dropIfExists('bond');
    }
}
