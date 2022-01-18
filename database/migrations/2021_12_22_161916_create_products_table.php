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
            $table->id();
            $table->string('name');
            $table->text('information');
            $table->unsignedInteger('price');
            $table->boolean('is_selling');
            $table->integer('sort_order')->nullable();
            $table->foreignId('member_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('secondary_category_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('image1')
                ->nullable()
                ->constrained('images')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('image2')
                ->nullable()
                ->constrained('images')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('image3')
                ->nullable()
                ->constrained('images')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('image4')
                ->nullable()
                ->constrained('images')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('image5')
                ->nullable()
                ->constrained('images')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('image6')
                ->nullable()
                ->constrained('images')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('image7')
                ->nullable()
                ->constrained('images')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('image8')
                ->nullable()
                ->constrained('images')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('image9')
                ->nullable()
                ->constrained('images')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamps();
            $table->boolean('delete')->default(0);
            $table->softDeletes();
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
