<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit86015d32110463a47ad4a6d258d54ad5
{
    public static $prefixLengthsPsr4 = array (
        'a' => 
        array (
            'app\\' => 4,
            'admin\\models\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
        'admin\\models\\' => 
        array (
            0 => __DIR__ . '/../..' . '/admin/models',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit86015d32110463a47ad4a6d258d54ad5::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit86015d32110463a47ad4a6d258d54ad5::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
