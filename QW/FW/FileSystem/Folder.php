<?php

namespace QW\FW\FileSystem;

use FilesystemIterator;
use QW\FW\Basic\IllegalArgumentException;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

final class Folder extends File
{
    public function __construct($dirName, $create = false)
    {
        //parent::__construct();

        if ((!is_dir($dirName) || !file_exists($dirName)) && $create == false)
            throw new IllegalArgumentException();
        else if (!file_exists($dirName) && $create == true)
            mkdir($dirName);

        $this->filePath = $dirName;
    }

    // http://stackoverflow.com/questions/478121/php-get-directory-size
    public function size()
    {
        $bytesTotal = 0;
        $path = realpath($this->filePath);
        if ($path !== false) {
            foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($this->filePath, FilesystemIterator::SKIP_DOTS)) as $object) {
                $bytesTotal += $object->getSize();
            }
        }

        return $bytesTotal;
    }

    public function delete()
    {
        return rmdir($this->filePath);
    }

    public function content()
    {
        $array = array();

        foreach (glob($this->filePath . '*') as $v) {
            if ($v == '.' || $v == '..')
                continue;

            $array[] = $v;

        }

        return $array;
    }
}