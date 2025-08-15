<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('order_number');
            $table->decimal('total_amount', 10, 2);
            $table->string('status');
            $table->string('payment_method');
            $table->string('billing_name');
            $table->string('billing_company')->nullable();
            $table->string('billing_address1');
            $table->string('billing_address2')->nullable();
            $table->string('billing_city');
            $table->string('billing_postal_code');
            $table->string('billing_phone');
            $table->string('billing_email');
            $table->string('billing_country');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
