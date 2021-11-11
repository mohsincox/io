<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('phone_number', 50);
            $table->string('agent', 150);
            $table->string('customer_name', 150)->nullable();
            $table->integer('division_id')->unsigned()->nullable();
            $table->integer('district_id')->unsigned()->nullable();
            $table->string('customer_address')->nullable();
            $table->string('profession')->nullable();
            $table->string('previous_purchased', 50)->nullable();
            $table->string('will_purchase', 50)->nullable();
            $table->string('which_product_will_purchase', 100)->nullable();
            $table->string('ton', 50)->nullable();
            $table->string('sources_of_purchase')->nullable();
            $table->string('product_serial')->nullable();
            $table->date('date_of_purchase')->nullable();
            $table->string('offer_message_provided', 50)->nullable();
            $table->string('follow_up')->nullable();
            $table->date('appoinment_date')->nullable();
            $table->string('customer_complain')->nullable();
            $table->string('query_type')->nullable();
            $table->string('source_of_call', 100)->nullable();
            $table->string('create_ticket', 50)->nullable();
            $table->string('verbatim_or_issue', 500)->nullable();
            $table->string('call_remarks', 100)->nullable();
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
        Schema::drop('crms');
    }
}
