<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('identity');
            $table->string('keyword')->default('');
            $table->double('plagiarism_bi')->default(25);
            $table->double('plagiarism_bii')->default(25);
            $table->double('plagiarism_biii')->default(25);
            $table->double('plagiarism_biv')->default(25);
            $table->double('plagiarism_bv')->default(25);
            $table->integer('examiner_quo')->default(2);
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
        Schema::dropIfExists('departments');
    }
}
