<x-site.code4 />

<header x-data="{ menuOpen: false }" class="relative shadow">
    <x-site.search-form class="container py-4 md:hidden" />

    <nav class="container py-4 space-y-4">
        <div class="relative flex items-center justify-between gap-3">
            <a href="{{ route('front.pages.index') }}" class="inline-flex">
                <img src="{{ $logo }}" class="h-16 max-w-48 sm:max-w-64" alt="{{ $title }}">
            </a>

            <div class="flex items-center gap-3">
                <x-site.search-form class="hidden md:block" />

                @if ($alternateUrls)
                    <div x-data="{ langOpen: false }" x-on:click.away="langOpen = false">
                        <button
                            class="flex items-center px-3 py-2 font-light rounded hover:bg-gray-100 focus:bg-gray-200 focus:outline-none"
                            x-on:click="langOpen = !langOpen">
                            <x-ri-global-line class="w-5 h-5 text-gray-900" />
                            <x-ri-arrow-drop-down-line class="w-5 h-5 ml-1 -mr-1" />
                        </button>

                        <div
                            class="absolute right-0 w-48 mt-2 origin-top-right bg-white shadow-xs"
                            x-show="langOpen"
                            x-collapse
                            x-cloak>
                            <ul class="shadow-lg">
                                @foreach ($alternateUrls as $locale => $url)
                                    <li class="text-sm">
                                        @if (app()->getLocale() === $locale)
                                            <span
                                                class="flex px-3 py-2 font-bold rounded">
                                                {{ config("translatable.locales.{$locale}.name") }}
                                            </span>
                                        @else
                                            <a
                                                class="flex px-3 py-2 rounded hover:bg-gray-100 focus:bg-gray-200 focus:outline-none"
                                                hreflang="{{ $locale }}"
                                                href="{{ $url }}">
                                                {{ config("translatable.locales.${locale}.name") }}
                                            </a>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <button type="button" @@click="menuOpen = !menuOpen" class="lg:hidden">
                    <x-ri-menu-line x-show="!menuOpen" class="w-5 h-5" />
                    <x-ri-close-line x-show="menuOpen" class="w-5 h-5" x-cloak />
                </button>
            </div>
        </div>

        <ul class="items-center hidden text-sm gap-x-6 lg:flex lg:flex-wrap">
            @foreach ($menu as $item)
                <li
                    @if ($item->children->isNotEmpty()) x-data="{ open: false }" x-on:click.outside="open = false" :class="{ 'bg-primary bg-opacity-10': open }" @endif
                    @class([
                        'flex flex-wrap border-b-2 border-transparent',
                        $item->isCurrentUrl()
                            ? 'border-primary text-primary'
                            : 'text-gray-700 hover:text-primary',
                    ])>

                    <x-dynamic-component
                        :component="$item->component"
                        :item="$item"
                        class="py-2 font-semibold" />

                    @if ($item->children->isNotEmpty())
                        <button
                            @@click="open = !open"
                            class="flex items-center py-2 ml-2 font-semibold">

                            <x-ri-arrow-down-s-line class="w-4 h-4" />
                        </button>

                        <div
                            class="absolute inset-x-0 z-10 text-gray-600 transform bg-white shadow-lg top-full"
                            x-show="open"
                            x-cloak>
                            <ul
                                class="container relative grid grid-cols-1 py-8 sm:grid-cols-2 lg:grid-cols-4 gap-y-10 sm:gap-x-8 sm:py-12">
                                @foreach ($item->children as $item)
                                    <li>
                                        <x-dynamic-component
                                            :component="$item->component"
                                            :item="$item"
                                            class="font-semibold"
                                            inactive-class="text-gray-700 hover:text-primary"
                                            active-class="border-primary text-primary" />

                                        @if ($item->children)
                                            <ul class="pt-2 mt-2 space-y-2 border-t border-gray-200">
                                                @foreach ($item->children as $item)
                                                    <li class="flex">
                                                        <x-dynamic-component
                                                            :component="$item->component"
                                                            :item="$item"
                                                            class="hover:text-gray-800"
                                                            inactive-class="text-gray-700 hover:text-primary"
                                                            active-class="border-primary text-primary" />
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </li>
            @endforeach
        </ul>
    </nav>

    <nav
        x-on:click.outside="menuOpen = false"
        class="absolute inset-x-0 z-50 transition origin-top transform bg-white shadow-lg top-full lg:hidden"
        x-show="menuOpen"
        x-collapse
        x-cloak>
        <ul x-data="{
            open: null,
            toggle(id) {
                this.open = this.open !== id ? id : null;
            }
        }" class="container py-4 space-y-6 text-gray-600 md:py-8">
            @foreach ($menu as $item)
                <li class="flex flex-wrap">
                    <x-dynamic-component
                        :component="$item->component"
                        :item="$item"
                        class="flex-1" />

                    @if ($item->children->count())
                        <button
                            @@click="toggle({{ $loop->index }}) "
                            type="button">

                            <x-ri-arrow-down-s-line
                                class="transform w-7 h-7 p-0.5 text-gray-400"
                                ::class="{ '-rotate-180': open === {{ $loop->index }}, 'rotate-0': !(open)  }" />
                        </button>

                        <ul class="w-full mt-4 space-y-6" x-show="open === {{ $loop->index }}" x-collapse>
                            @foreach ($item->children as $item)
                                <li>
                                    <x-dynamic-component
                                        :component="$item->component"
                                        :item="$item"
                                        class="font-medium" />

                                    @if ($item->children->count())
                                        <ul class="pt-2 mt-2 space-y-2 border-t border-gray-200">
                                            @foreach ($item->children as $item)
                                                <li>
                                                    <x-dynamic-component
                                                        :component="$item->component"
                                                        :item="$item" />
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>

    </nav>
</header>

<x-site.banner />
