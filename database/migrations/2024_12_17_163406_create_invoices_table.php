<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_code')->unique();
            $table->datetime('invoice_date');
            $table->string('customer_name');
            $table->text('customer_address');
            $table->string('notes');
            $table->decimal('total_amount', 10, 2);
            $table->decimal('vat_amount', 10, 2)->default(0);
            $table->decimal('discount_amount', 10, 2)->default(0); 
            $table->decimal('grand_total', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
