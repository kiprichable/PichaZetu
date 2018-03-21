<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Blogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('blogs', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->references('id')->on('users');
			$table->string('name');
			$table->longText('description')->nullable();
			$table->softDeletes('deleted_at')->nullable();
			$table->string('created_by')->nullable();
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
		Schema::dropIfExists('blogs');
	}
}
