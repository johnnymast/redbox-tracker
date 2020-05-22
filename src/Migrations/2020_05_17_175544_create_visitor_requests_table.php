<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitorRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
          'visitor_requests',
          function (Blueprint $table) {
              $table->increments('id');
              $table->unsignedInteger('visitor_id');
              $table->string('domain')->nullable();
              $table->string('method')->nullable();
              $table->string('path')->nullable();
              $table->string('route')->nullable();
              $table->string('referer')->nullable();
              $table->boolean('is_secure')->default(false);
              $table->boolean('is_ajax')->default(false);
              $table->timestamps();
              
              $table->foreign('visitor_id')
                ->references('id')
                ->on('visitors')
                ->onDelete('cascade');
          }
        );
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visitor_requests');
    }
}
