<aside class="border-b ">
    <div class="container flex flex-wrap text-sm divide-y lg:justify-end lg:divide-y-none">
        <div class="inline-flex items-center justify-between w-full py-5 lg:w-auto">
            <span>@lang('banner.partnership')</span>
            <div class="flex items-center gap-2 pl-4 text-center sm:gap-4">
                <a href="http://www.dsu.mai.gov.ro/" target="_blank" rel="noopener"
                    class="inline-block focus:outline-none focus:ring">
                    <img src="{{ asset(mix('assets/images/dsu.png')) }}"
                        class="inline-block object-contain w-auto h-6 sm:h-8"
                        alt="">
                </a>

                <a href="https://romania.iom.int/" target="_blank" rel="noopener"
                    class="inline-block focus:outline-none focus:ring">
                    <img src="{{ asset(mix('assets/images/un-migration-ro.png')) }}"
                        class="inline-block object-contain w-auto h-6 sm:h-8"
                        alt="">
                </a>

                <a href="https://www.cnrr.ro/" target="_blank" rel="noopener"
                    class="inline-block focus:outline-none focus:ring">
                    <img src="{{ asset(mix('assets/images/cnrr.png')) }}"
                        class="inline-block object-contain w-auto h-8"
                        alt="">
                </a>
            </div>
        </div>
        <div class="inline-flex items-center justify-between w-full py-5 lg:pl-4 lg:w-auto">
            <span>@lang('banner.madeby')</span>
            <a href="https://code4.ro" target="_blank" rel="noopener"
                class="inline-block pl-4 focus:outline-none focus:ring">
                <img src="{{ asset(mix('assets/images/code4romania.svg')) }}"
                    class="inline-block object-contain w-auto h-6 sm:h-8" alt="">
            </a>
        </div>
    </div>
</aside>
