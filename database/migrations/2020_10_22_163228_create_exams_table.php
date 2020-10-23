<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->string('author_id');
            $table->string('examiner1_id')->nullable();
            $table->string('examiner2_id')->nullable();
            $table->text('examiner1_msg')->default('tidak ada');
            $table->text('examiner2_msg')->default('tidak ada');
            $table->boolean('examiner1_pass')->default(false);
            $table->boolean('examiner2_pass')->default(false);
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
        Schema::dropIfExists('exams');
    }
}
