<?php

/**
 * CreateVisitorsTable.php
 *
 * This migration creates the visitors table.
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
 * Class CreateVisitorsTable
 *
 * @category Migrations
 * @package  RedboxTracker
 * @author   Johnny Mast <mastjohnny@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/johnnymast/redbox-tracker
 * @since    GIT:1.0
 */
class CreateVisitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'visitors', function (Blueprint $table) {

                $table->increments('id');
                $table->string('unique_id');
                $table->unsignedInteger('user_id')->nullable();
                $table->string('ip', 40);
                $table->string('user_agent')->nullable();
                $table->boolean('is_desktop')->default(false);
                $table->boolean('is_mobile')->default(false);
                $table->boolean('is_bot')->default(false);
                $table->string('bot')->nullable();
                $table->string('os')->default('');
                $table->string('browser_version')->default('');
                $table->string('browser')->default('');
                $table->string('country')->default('');
                $table->string('country_code')->default('');
                $table->string('city')->default('');
                $table->double('lat')->nullable();
                $table->double('long')->nullable();
                $table->string('browser_language_family', 4)->default('');
                $table->string('browser_language', 7)->default('');
                $table->timestamps();
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
        Schema::dropIfExists('visitors');
    }
}
