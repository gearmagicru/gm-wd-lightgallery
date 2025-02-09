<?php
/**
 * Этот файл является частью виджета веб-приложения GearMagic.
 * 
 * Файл конфигурации установки виджета.
 * 
 * @link https://gearmagic.ru
 * @copyright Copyright (c) 2015 Веб-студия GearMagic
 * @license https://gearmagic.ru/license/
 */

return [
    'use'         => FRONTEND,
    'id'          => 'gm.wd.lightgallery',
    'category'    => 'gallery',
    'name'        => 'LightGallery',
    'description' => 'Gallery widget',
    'namespace'   => 'Gm\Widget\LightGallery',
    'path'        => '/gm/gm.wd.lightgallery',
    'shortcodes'  => ['lightgallery'],
    'editor'      => [
        'shortcodes' => [
            'lightgallery' => [
                'name'     => 'lightgallery',
                'text'     => 'LightGallery',
                'settings' => 'Settings\ShortcodeSettings',
                'icon'     => '/images/icon_shortcode.svg'
            ]
        ]
    ],
    'locales'     => ['ru_RU', 'en_GB'],
    'events'      => [],
    'required'    => [
        ['php', 'version' => '8.2'],
        ['app', 'code' => 'GM MS'],
        ['app', 'code' => 'GM CMS'],
        ['app', 'code' => 'GM CRM']
    ]
];
