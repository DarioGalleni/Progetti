<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use PDO;

class DatabaseSyncController extends Controller
{
    // ==================== SINCRONIZZAZIONE DB ====================
    public function sync()
    {
        set_time_limit(300);
        ini_set('memory_limit', '512M');

        $source = 'mysql';       // Remoto
        $target = 'mysql_local'; // Locale

        try {
            // 1. Verifica e Creazione DB Locale se non esiste
            $this->ensureLocalDatabaseExists();

            // 2. Ottieni lista tabelle dal remoto
            $tables = DB::connection($source)->select('SHOW TABLES');
            $tables = array_map('current', $tables);

            // Disabilita controlli Foreign Key
            DB::connection($target)->statement('SET FOREIGN_KEY_CHECKS=0;');

            foreach ($tables as $table) {
                // 3. Clona struttura (DROP e CREATE)
                Schema::connection($target)->dropIfExists($table);

                $createTableSql = DB::connection($source)->select("SHOW CREATE TABLE `$table`")[0]->{'Create Table'};
                DB::connection($target)->statement($createTableSql);

                // 4. Copia dati a blocchi
                DB::connection($source)->table($table)->orderByRaw('1')->chunk(200, function ($rows) use ($target, $table) {
                    $data = array_map(fn($row) => (array) $row, $rows->toArray());
                    if (!empty($data)) {
                        DB::connection($target)->table($table)->insert($data);
                    }
                });
            }

            DB::connection($target)->statement('SET FOREIGN_KEY_CHECKS=1;');

            return back()->with('success', 'Database sincronizzato con successo! Struttura e dati aggiornati.');

        } catch (\Exception $e) {
            Log::error("Errore Sync DB: " . $e->getMessage());
            return back()->with('error', 'Errore Sync: ' . $e->getMessage());
        }
    }

    // ==================== HELPER: CREA DB SE MANCA ====================
    private function ensureLocalDatabaseExists()
    {
        try {
            // Tenta connessione normale
            DB::connection('mysql_local')->getPdo();
        } catch (\Exception $e) {
            // Se fallisce, prova a creare il DB
            $dbName = config('database.connections.mysql_local.database');

            // Configurazione temporanea senza nome DB
            Config::set('database.connections.mysql_temp', array_merge(
                config('database.connections.mysql_local'),
                ['database' => null]
            ));

            try {
                DB::connection('mysql_temp')->statement("CREATE DATABASE IF NOT EXISTS `$dbName` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
            } catch (\Exception $ex) {
                throw new \Exception("Impossibile creare il database locale. Verifica che MySQL sia avviato.");
            }
        }
    }
}
