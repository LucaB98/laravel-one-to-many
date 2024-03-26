<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Type;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->foreignIdFor(Type::class)->after('id')->nullable()->constrained()->nullOnDelete();

            //$table->foreignId('type_id')->after('id')->nullable()->constrained()->nullOnDelete(); (alternativa)

            //$table->foreign('type_id')->references('id')->on('types')->nullOnDelete(); (alternativa)

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            //rimuovo la relazione
            $table->dropForeignIdFor(Type::class);
            //rimuovo la colonna
            $table->dropColumn('type_id');

            //$table->dropForeign('projects_category_id_foreign'); (alternativa)
        });
    }
};
