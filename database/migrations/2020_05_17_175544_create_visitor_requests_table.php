<?php

/**
 * CreateVisitorRequestsTable.php
 *
 * This migration creates the visitor_requests table.
 *
 * PHP version 7.2
 *
 * @category Migrations
 * @package  RedboxTracker
 * @author   Johnny Mast <mastjohnny@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/johnnymast/redbox-tracker
 * @since    GIT:1.0
 */


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateVisitorRequestsTable
 *
 * @category Migrations
 * @package  RedboxTracker
 * @author   Johnny Mast <mastjohnny@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/johnnymast/redbox-tracker
 * @since    GIT:1.0
 */
class CreateVisitorRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
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
    public function down(): void
    {
        Schema::dropIfExists('visitor_requests');
    }
}
