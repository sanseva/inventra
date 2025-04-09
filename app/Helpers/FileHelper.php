<?php

namespace App\Helpers;

class FileHelper
{
    public static function listDirByDate($path)
    {
        // Ensure the path ends with a directory separator
        $path = rtrim($path, '/') . '/';

        // Define the backup directory
        $backupPath = $path . 'backup/';

        // Check if the backup directory exists
        if (!is_dir($backupPath)) {
            throw new \Exception("Directory not found: " . $backupPath);
        }

        // Open the backup directory
        $dir = opendir($backupPath);
        $list = [];

        if ($dir) {
            while (($file = readdir($dir)) !== false) {
                if ($file !== '.' && $file !== '..') {
                    // Get the creation time of the file
                    $ctime = filectime($backupPath . $file);
                    // Store the file name with its creation time as the key
                    $list[$ctime] = $file;
                }
            }
            closedir($dir);
        }

        // Sort the list in reverse order by creation time
        krsort($list);
        
        return $list;
    }


}
