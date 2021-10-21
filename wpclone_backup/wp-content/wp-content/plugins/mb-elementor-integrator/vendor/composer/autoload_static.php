<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit567264d6ba3c4846783a9be6a28de4df
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'MBEI\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'MBEI\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit567264d6ba3c4846783a9be6a28de4df::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit567264d6ba3c4846783a9be6a28de4df::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit567264d6ba3c4846783a9be6a28de4df::$classMap;

        }, null, ClassLoader::class);
    }
}
