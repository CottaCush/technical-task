<?php

declare(strict_types=1);

namespace App\Models;

use App\Interfaces\CacheInterface;
use Exception;

class CacheModel implements CacheInterface
{
    /**
     * @throws Exception
     */
    public function set(string $key, $value, int $duration)
    {
        // TODO: Implement set() method.
        // Opening the file for writing
        $fopen = fopen( $key,'w');
        if (!$fopen) throw new Exception('Could not write to file cache');

        // Serializing data along with the duration
        $data = serialize([time() + $duration, $value]);
        if (fwrite($fopen, $data) === false) {
            throw new Exception('Could not write to file cache');
        }
        fclose($fopen);
    }

    public function get(string $key)
    {
        // TODO: Implement get() method.
        $filename = $key;
        if (!file_exists($filename) || !is_readable($filename)) return false;
        $fileContents = file_get_contents($filename);

        $data = unserialize($fileContents);
        // checking if the data was expired or if unserializing failed
        if (!$data | time() > $data[0]) {
            unlink($filename);
            return null;
        }

        return $data[1];
    }
}