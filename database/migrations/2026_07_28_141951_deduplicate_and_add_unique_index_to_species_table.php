<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * 1) Trova gruppi di specie con lo stesso "name" (es. due righe 'Cat').
     * 2) Tiene la riga con id più basso e riassegna a quella tutte le
     *    breeds e i pets che puntavano alle righe duplicate.
     * 3) Elimina le righe duplicate.
     * 4) Aggiunge un indice UNIQUE su species.name per impedire che
     *    il problema si ripresenti in futuro.
     */
    public function up(): void
    {
        $duplicateGroups = DB::table('species')
            ->select('name')
            ->groupBy('name')
            ->havingRaw('COUNT(*) > 1')
            ->pluck('name');

        foreach ($duplicateGroups as $name) {
            $rows = DB::table('species')
                ->where('name', $name)
                ->orderBy('id')
                ->pluck('id');

            $keepId = $rows->first();
            $duplicateIds = $rows->slice(1)->values();

            if ($duplicateIds->isEmpty()) {
                continue;
            }

            DB::table('breeds')
                ->whereIn('species_id', $duplicateIds)
                ->update(['species_id' => $keepId]);

            DB::table('pets')
                ->whereIn('species_id', $duplicateIds)
                ->update(['species_id' => $keepId]);

            DB::table('species')
                ->whereIn('id', $duplicateIds)
                ->delete();
        }

        Schema::table('species', function (Blueprint $table) {
            $table->unique('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('species', function (Blueprint $table) {
            $table->dropUnique(['name']);
        });
    }
};
