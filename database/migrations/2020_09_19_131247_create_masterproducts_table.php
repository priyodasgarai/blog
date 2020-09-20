<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterproductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masterproducts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('section_id');
            $table->string('product_name');
            $table->string('product_code');
            $table->float('product_price');
            $table->float('product_discount');
            $table->float('product_weight');
            $table->string('product_video');
            $table->string('main_image');
            $table->text('description');         
            $table->string('meta_title');
            $table->string('meta_description');
            $table->string('meta_keywords');
            $table->enum('is_featured',['No','Yes']);
            $table->tinyinteger('units_of_measurement_types')->default(1)->comment('1 = kg ; 2 = Lt');
            $table->tinyinteger('status')->default(1)->comment('0 = Block ; 1 = Active');
            $table->foreign('category_id')->references('id')->on('categories')->constrained();
            $table->foreign('section_id')->references('id')->on('sections')->constrained();
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
        Schema::dropIfExists('masterproducts');
    }
}
