<?php

namespace EuleNetwork;

class Autoloader
{
    const FILE_EXTENSION = '.php';
    const ROOT = 'EuleNetwork';

    /**
     * @param string $classname
     * @return bool
     */
    public static function load($classname)
    {
        $parts = explode('\\', $classname);

        $base = array_shift($parts);
        if ($base !== self::ROOT) {
            return false;
        }
        $name = array_pop($parts);
        $path = '';
        foreach ($parts as $part) {
            $path .= $part . '/';
        }
        $filename = __DIR__.'/'.$path . $name . self::FILE_EXTENSION;
        if (file_exists($filename)) {
            require_once($filename);
            return true;
        } else {
            return false;
        }
    }
}
