<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf10cddec6f4fbf644d9f1809b4463051
{
    public static $classMap = array (
        'codeable_datepicker_widget\\app\\admin\\WidgetAdmin' => __DIR__ . '/../..' . '/app/admin/WidgetAdmin.php',
        'codeable_datepicker_widget\\app\\frontend\\DatepickerWidget' => __DIR__ . '/../..' . '/app/frontend/DatepickerWidget.php',
        'codeable_datepicker_widget\\app\\frontend\\JS_Widget' => __DIR__ . '/../..' . '/app/frontend/JS_Widget.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInitf10cddec6f4fbf644d9f1809b4463051::$classMap;

        }, null, ClassLoader::class);
    }
}
