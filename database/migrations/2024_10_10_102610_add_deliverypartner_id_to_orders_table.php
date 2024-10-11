<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeliverypartnerIdToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Adding deliverypartner_id column
            $table->unsignedBigInteger('delivery_partner_id')->nullable()->after('id'); // Or specify after which column to place it

            // Adding foreign key constraint
            $table->foreign('delivery_partner_id')->references('id')->on('delivery_partners')->onDelete('set null'); // Adjust to your needs
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Dropping the foreign key and the column
            $table->dropForeign(['delivery_partner_id']);
            $table->dropColumn('delivery_partner_id');
        });
    }
}
