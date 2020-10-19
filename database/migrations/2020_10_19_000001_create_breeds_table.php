<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreatePersonalAccessTokensTable
 */
class CreateBreedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('breeds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('animal_type');
            $table->string('name');
            $table->string('temperament');
            $table->string('alternative_names');
            $table->integer('life_span');
            $table->string('origin');
            $table->string('wikipedia_url');
            $table->string('country_code');
            $table->text('description');
            $table->boolean('favourite')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('breeds');
    }
}
