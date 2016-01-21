<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 512);
            $table->string('author', 512);
            $table->string('publisher');
            $table->string('isbn');
            $table->string('pages');
            $table->string('price');
            $table->string('tags');
            $table->string('get_id');
            $table->string('classnumber');
            $table->mediumText('content');
            $table->mediumText('annotation');
            $table->float('rating');
            $table->mediumText('d_tags');
            $table->text('url');
            $table->text('image');
            $table->text('large');
            $table->mediumText('author_intro');
            $table->mediumText('summary');
            $table->mediumText('catalog');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('books');
    }
}
