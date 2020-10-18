<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmitRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submit_requests', function (Blueprint $table) {
            $table->id();
            $table->string('author_id');
            $table->string('l1_id');
            $table->string('l2_id');
            $table->integer('l1_agreement')->default(0);
            $table->integer('l2_agreement')->default(0);
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
        Schema::dropIfExists('submit_requests');
    }
}
