<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit1f4bd250d207cf44a52c0128eac47a38
{
    public static $prefixesPsr0 = array (
        'S' => 
        array (
            'SimplePie' => 
            array (
                0 => __DIR__ . '/..' . '/simplepie/simplepie/library',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInit1f4bd250d207cf44a52c0128eac47a38::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
