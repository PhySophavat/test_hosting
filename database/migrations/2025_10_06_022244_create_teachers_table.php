<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
   
        public function up(): void
{
    Schema::create('teachers', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id');
        $table->string('subject');
        $table->timestamps();

        // Foreign key (optional, if you have a users table)
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
}

   public function down(): void
{
    Schema::table('teachers', function (Blueprint $table) {
        if (Schema::hasColumn('teachers', 'user_id')) {
            $table->dropColumn('user_id');
        }
    });
}
}

