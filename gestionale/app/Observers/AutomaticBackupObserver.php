<?php

namespace App\Observers;

use App\Services\BackupService;
use Illuminate\Support\Facades\Log;

class AutomaticBackupObserver
{
    protected $backupService;

    public function __construct(BackupService $backupService)
    {
        $this->backupService = $backupService;
    }

    /**
     * Handle the "saved" event.
     */
    public function saved($model)
    {
        $this->backup();
    }

    /**
     * Handle the "deleted" event.
     */
    public function deleted($model)
    {
        $this->backup();
    }

    /**
     * Perform the backup.
     */
    protected function backup()
    {
        try {
            // Overwrite the same file 'autosave_backup.sql' to prevent disk filling.
            // If the user wants history, they can use the manual button.
            $this->backupService->createBackup('autosave_backup.sql');
        } catch (\Exception $e) {
            // Log quietly so we don't interrupt the user experience
            Log::error("Automatic Backup Failed: " . $e->getMessage());
        }
    }
}
