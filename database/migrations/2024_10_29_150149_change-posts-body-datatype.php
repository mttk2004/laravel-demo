<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration {
	public function up(): void
	{
		Schema::table('posts', function (Blueprint $table) {
			// change the datatype of column `body` to longText
			$table->longText('body')->change();
		});
	}
	
	public function down(): void
	{
		Schema::table('posts', function (Blueprint $table) {
			//
		});
	}
};
