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
        Schema::create('events', function (Blueprint $table) {
           $table->id();
           $table->string('title',50);
           $table->text('description');
           $table->date('date');
           $table->time('time');
           $table->string('location');
           $table->integer('attendance')->nullable()->default(0);

           //foreign key
           $table->unsignedBigInteger('user_id');
           $table->unsignedBigInteger('category_id');
        //relationship
           $table->foreign('user_id')->references('id')->on('users')
           ->cascadeOnUpdate()
           ->restrictOnDelete();

           $table->foreign('category_id')->references('id')->on('event_categoties')
           ->cascadeOnUpdate()
           ->restrictOnDelete();

           $table->timestamp('created_at')->useCurrent();
           $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
