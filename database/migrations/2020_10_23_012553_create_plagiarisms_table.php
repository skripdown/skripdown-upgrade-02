<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlagiarismsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plagiarisms', function (Blueprint $table) {
            $table->id();
            $table->string('author_id')->default('');
            $table->double('bab_i')->default(0.0);
            $table->double('bab_ii')->default(0.0);
            $table->double('bab_iii')->default(0.0);
            $table->double('bab_iv')->default(0.0);
            $table->double('bab_v')->default(0.0);
            $table->boolean('pass')->default(false);
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
        Schema::dropIfExists('plagiarisms');
    }
}
