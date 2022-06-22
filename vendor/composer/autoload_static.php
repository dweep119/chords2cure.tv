<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitaa77c5418b9ff1ddc0f4f000b0752e29
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Stripe\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Stripe\\' => 
        array (
            0 => __DIR__ . '/..' . '/stripe/stripe-php/lib',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitaa77c5418b9ff1ddc0f4f000b0752e29::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitaa77c5418b9ff1ddc0f4f000b0752e29::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}