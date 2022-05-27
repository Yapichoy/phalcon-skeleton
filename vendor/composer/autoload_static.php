<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0ba1aac6bce4068074abdbac31f6ca47
{
    public static $prefixLengthsPsr4 = array (
        'V' => 
        array (
            'Vlad\\Phalcon\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Vlad\\Phalcon\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit0ba1aac6bce4068074abdbac31f6ca47::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit0ba1aac6bce4068074abdbac31f6ca47::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit0ba1aac6bce4068074abdbac31f6ca47::$classMap;

        }, null, ClassLoader::class);
    }
}