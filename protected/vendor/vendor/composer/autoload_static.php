<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf888c9905d67856cfbeff0b517f74a27
{
    public static $files = array (
        '5255c38a0faeba867671b61dfda6d864' => __DIR__ . '/..' . '/paragonie/random_compat/lib/random.php',
        '72579e7bd17821bb1321b87411366eae' => __DIR__ . '/..' . '/illuminate/support/helpers.php',
    );

    public static $prefixLengthsPsr4 = array (
        'I' => 
        array (
            'Illuminate\\Support\\' => 19,
            'Illuminate\\Contracts\\' => 21,
        ),
        'F' => 
        array (
            'Fx3costa\\LaravelChartJs\\' => 24,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Illuminate\\Support\\' => 
        array (
            0 => __DIR__ . '/..' . '/illuminate/support',
        ),
        'Illuminate\\Contracts\\' => 
        array (
            0 => __DIR__ . '/..' . '/illuminate/contracts',
        ),
        'Fx3costa\\LaravelChartJs\\' => 
        array (
            0 => __DIR__ . '/..' . '/fx3costa/laravelchartjs/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'D' => 
        array (
            'Doctrine\\Common\\Inflector\\' => 
            array (
                0 => __DIR__ . '/..' . '/doctrine/inflector/lib',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf888c9905d67856cfbeff0b517f74a27::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf888c9905d67856cfbeff0b517f74a27::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInitf888c9905d67856cfbeff0b517f74a27::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
