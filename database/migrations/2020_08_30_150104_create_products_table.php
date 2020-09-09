<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id()->comment('ID sản phẩm');
            $table->bigInteger('category_id')->unsigned()->comment('ID danh mục');
            $table->string('name')->comment('Tên sản phẩm');
            $table->string('slug')->comment('Đường dẫn tĩnh của sản phẩm');
            $table->string('thumb')->comment('Ảnh đại diện của sản phẩm');
            $table->longText('description_short')->comment('Mô tả ngắn về sản phẩm');
            $table->longText('description_long')->comment('Mô tả dài về sản phẩm');
            $table->integer('status')->default(1)->comment('Trạng thái của sản phẩm: 0 - Draft, 1 - Public');
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
