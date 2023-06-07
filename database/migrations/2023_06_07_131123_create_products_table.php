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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title')->nullable();
            $table->text('short_desc')->nullable();
            $table->text('desc')->nullable();
            $table->unsignedBigInteger('brand_id');
            $table->unsignedBigInteger('cat_id');
            $table->unsignedBigInteger('sub_cat_id');
            $table->unsignedBigInteger('vendor_id')->nullable();
            $table->unsignedBigInteger('discount_id')->nullable();
            $table->string('main_image');
            $table->string('unit_price');
            $table->enum('unit_type',['kg','g','mg','l','ml','bbl','gl','in','sq.ft.','m','sq m.','sq. cm.','sq. ml','cm','ft','dozen','piece','bag','packet','box','carton'])->nullable();
            $table->string('sku')->nullable();
            $table->string('weight')->nullable();
            $table->string('size')->nullable();
            $table->string('color')->nullable();
            $table->string('tags')->nullable();
            $table->date('mfg')->nullable();
            $table->string('type')->nullable();        
              
            $table->timestamps();
            //define foreign key
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->foreign('cat_id')->references('id')->on('categories');
            $table->foreign('sub_cat_id')->references('id')->on('subcategories');
            $table->foreign('vendor_id')->references('id')->on('users');
            $table->foreign('discount_id')->references('id')->on('discounts');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
