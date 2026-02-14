<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class BackupService
{
    /**
     * Create a database backup.
     *
     * @param string|null $filename Optional filename. If null, a timestamped one is generated.
     * @return string The partial path to the saved file (relative to storage/app).
     * @throws \Exception
     */
    public function createBackup($filename = null)
    {
        try {
            $tables = DB::select('SHOW TABLES');
            $tables = array_map('current', $tables);

            $content = "-- Backup Database: " . config('app.name') . "\n";
            $content .= "-- Date: " . now() . "\n";
            $content .= "SET FOREIGN_KEY_CHECKS=0;\n\n";

            foreach ($tables as $table) {
                // Structure
                $createTable = DB::select("SHOW CREATE TABLE `$table`");
                $content .= "DROP TABLE IF EXISTS `$table`;\n";
                $content .= $createTable[0]->{'Create Table'} . ";\n\n";

                // Data
                $rows = DB::table($table)->get();
                foreach ($rows as $row) {
                    $row = (array) $row;
                    $values = array_map(function ($value) {
                        if (is_null($value))
                            return "NULL";
                        return "'" . addslashes($value) . "'";
                    }, $row);

                    $content .= "INSERT INTO `$table` VALUES (" . implode(", ", $values) . ");\n";
                }
                $content .= "\n";
            }

            $content .= "SET FOREIGN_KEY_CHECKS=1;\n";

            // Save to file
            if (!$filename) {
                $filename = 'backup-' . date('Y-m-d_H-i-s') . '.sql';
            }

            $path = 'backups/' . $filename;

            Storage::disk('local')->put($path, $content);

            return $path;

        } catch (\Exception $e) {
            Log::error("Backup Error: " . $e->getMessage());
            throw $e;
        }
    }
}
