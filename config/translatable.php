<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Application Locales
    |--------------------------------------------------------------------------
    |
    | Contains an array with the applications available locales.
    |
    */
    'locales' => [
        'uk' => [
            'enabled' => true,
            'name'    => 'Українська',
            'code'    => 'uk_UA',
            'ts_lang' => 'simple',
        ],
        'ro' => [
            'enabled' => true,
            'name'    => 'Română',
            'code'    => 'ro_RO',
            'ts_lang' => 'romanian',
        ],
        'en' => [
            'enabled' => true,
            'name'    => 'English',
            'code'    => 'en_GB',
            'ts_lang' => 'english',
        ],
        'ru' => [
            'enabled' => true,
            'name'    => 'Русский',
            'code'    => 'ru_RU',
            'ts_lang' => 'russian',
        ],
    ],

    /*
     * If a translation has not been set for a given locale and the fallback locale,
     * any other locale will be chosen instead.
     */
    'fallback_any' => true,

];
