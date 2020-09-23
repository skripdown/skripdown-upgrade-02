<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('identity');
            $table->string('name');
            $table->string('doc_id');
            $table->integer('status')->default(-1);
            $table->integer('progres')->default(0);
            $table->string('doc_title')->nullable();
            $table->string('doc_link')->nullable();
            $table->string('identity_l1')->nullable();
            $table->string('identity_l2')->nullable();
            $table->string('identity_dep')->nullable();
            $table->string('identity_fac')->nullable();
            $table->string('identity_univ')->nullable();
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
        Schema::dropIfExists('students');
    }
}
