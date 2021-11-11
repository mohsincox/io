<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('subject', 100);
            $table->string('phone_number', 50);
            $table->string('customer_name', 150);
            $table->integer('division_id')->unsigned()->nullable();
            $table->integer('district_id')->unsigned()->nullable();
            $table->string('customer_address')->nullable();
            $table->string('product_model', 150)->nullable();
            $table->string('usage_purpose', 150)->nullable();
            $table->integer('ticket_status_id')->unsigned();
            $table->integer('ticket_type_id')->unsigned();
            $table->integer('assigned_id')->unsigned();
            $table->string('cc_to', 50)->nullable();
            $table->date('date_of_purchase')->nullable();
            $table->string('verbatim_or_issue', 500)->nullable();
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('deleted_by')->unsigned()->nullable();
            $table->timestamp('deleted_at')->nullable();
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
        Schema::drop('tickets');
    }
}
