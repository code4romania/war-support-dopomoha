<?php

declare(strict_types=1);

use Illuminate\Support\Collection;
use Illuminate\Support\Str;

if (! function_exists('locales')) {
    /**
     * Return the currently enabled locales.
     *
     * @return \Illuminate\Support\Collection
     */
    function locales(): Collection
    {
        return collect(config('translatable.locales'))
            ->reject(fn (array $config, string $locale) => ! $config['enabled']);
    }
}

if (! function_exists('localized_route')) {
    /**
     * Generate the URL to a named route for the current locale.
     *
     * @param  mixed  $name
     * @param  array  $parameters
     * @param  string $locale
     * @param  bool   $absolute
     * @return string
     */
    function localized_route($name, array $parameters = [], ?string $locale = null, bool $absolute = true): string
    {
        $parameters['locale'] = $locale ?? app()->getLocale();

        return route($name, $parameters, $absolute);
    }
}

if (! function_exists('settings')) {
    /**
     * @param  array|string|null $key
     * @return mixed
     */
    function settings(array|string|null $key = null): mixed
    {
        $prefix = 'website-factory.settings';

        if (is_null($key)) {
            return config($prefix);
        }

        if (is_array($key)) {
            return config()->set(
                collect($key)
                    ->mapWithKeys(fn ($v, $k) => [
                        "{$prefix}.{$k}" => $v,
                    ])
                    ->toArray()
            );
        }

        return config()->get("{$prefix}.{$key}");
    }
}

if (! function_exists('localized_settings')) {
    /**
     * @param  null|string $key
     * @return mixed
     */
    function localized_settings(?string $key = null): mixed
    {
        $key = rtrim("website-factory.settings.{$key}", '.');

        return config($key . '.' . app()->getLocale())
            ?? config($key . '.' . config('app.fallback_locale'));
    }
}

if (! function_exists('color_var')) {
    /**
     * @param  null|string $hex
     * @param  string      $name
     * @return string
     */
    function color_var(?string $hex, string $name): string
    {
        $hex = ltrim((string) $hex, '#');

        $rgb = match (Str::length($hex)) {
            3       => str_split($hex, 1),
            6       => str_split($hex, 2),
            default => str_split('000', 1),
        };

        $rgb = collect($rgb)
            ->map(fn (string $c) => hexdec(str_pad($c, 2, $c)))
            ->implode(',');

        return "--color-{$name}:{$rgb};";
    }
}
