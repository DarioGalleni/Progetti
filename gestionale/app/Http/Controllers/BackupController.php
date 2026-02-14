<?php

namespace App\Http\Controllers;

use App\Services\BackupService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BackupController extends Controller
{
    protected $backupService;

    public function __construct(BackupService $backupService)
    {
        $this->backupService = $backupService;
    }

    public function create()
    {
        try {
            $path = $this->backupService->createBackup();

            // Path completo per il messaggio user-friendly
            $fullPath = storage_path('app/private/' . $path);

            return back()->with('success', "Backup creato con successo! File salvato in: " . $fullPath);

        } catch (\Exception $e) {
            return back()->with('error', "Errore durante il backup: " . $e->getMessage());
        }
    }
}
