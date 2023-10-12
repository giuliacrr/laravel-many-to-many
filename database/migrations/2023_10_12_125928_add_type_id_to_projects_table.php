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
        Schema::table('projects', function (Blueprint $table) {
            // Creiamo prima la colonna come bigintg
            $table->unsignedBigInteger('type_id')->nullable()->after("slug");
            //La colonna creata viene resa foreign key
            $table->foreign('type_id')
                ->references('id')
                ->on("types");

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            // rimuovo la foreign key tramite il nome dell'indice assegnato automaticamente
            $table->dropForeign('projects_type_id_foreign');
            // rimuovo la colonna
            $table->dropColumn('type_id');
        });
    }
};
