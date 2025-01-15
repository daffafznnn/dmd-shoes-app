<footer class="px-4 pt-12 pb-8 text-white bg-black border-t border-gray-900" id="about-us">
    <div class="container flex flex-col justify-between max-w-6xl px-4 mx-auto overflow-hidden lg:flex-row">
        <div class="w-full pl-12 mr-4 text-left lg:w-1/4 sm:text-center sm:pl-0 lg:text-left">
            <a href="/"
                class="flex justify-start block text-left sm:text-center lg:text-left sm:justify-center lg:justify-start">
                <span class="flex items-start sm:items-center">
                    <img src="{{ asset('storage/' . $setting->logo) }}" alt="dmd-logo" class="w-20 h-16 bg-white p-2 rounded">
                </span>
            </a>
            <p class="mt-6 mr-4 text-base text-gray-400">{{ $setting->description }}</p>
        </div>
        <div class="block w-full pl-10 mt-6 text-sm lg:w-3/4 sm:flex lg:mt-0">
            <ul class="flex flex-col w-full p-0 font-medium text-left text-gray-400 list-none">
                <li class="inline-block px-3 py-2 mt-5 font-bold tracking-wide text-white uppercase md:mt-0">
                    {{ __('Support & Contact') }}
                </li>
                <li><a href="tel:{{ $setting->phone }}"
                        class="inline-block px-3 py-2 text-gray-400 no-underline hover:text-white">{{ $setting->phone }}</a>
                </li>
                <li><a href="mailto:{{ $setting->email }}"
                        class="inline-block px-3 py-2 text-gray-400 no-underline hover:text-white">{{ $setting->email }}</a>
                </li>
                <li><a href="#_" class="inline-block px-3 py-2 text-gray-400 no-underline hover:text-white">{{ $setting->address }}</a>
                </li>
            </ul>
            <div class="flex flex-col w-full text-gray-400">
                <div class="inline-block px-3 py-2 mt-5 font-bold text-white uppercase md:mt-0">{{ __('Follow Us') }}
                </div>
                <div class="flex justify-start pl-4 mt-2">
                    @forelse ($socials as $social)
                        <a class="flex items-center block mr-6 text-gray-400 no-underline hover:text-white"
                            target="_blank" href="{{ $social->url }}">
                            <i class="bi {{ $social->icon }} text-2xl"></i>
                        </a>
                    @empty
                        <p class="text-gray-400">{{ __('No social links available') }}.</p>
                    @endforelse
                </div>
                <a href="#"
                    class="flex items-center justify-center py-3 border w-full border-white hover:bg-white text-white hover:text-primary-dark mt-7 md:w-1/2 max-w-xs tracking-wide rounded-md font-bold">
                    <i class="bi bi-whatsapp text-2xl mr-2"></i> {{ __('Chat online now') }}!
                </a>
            </div>
        </div>
    </div>
    <div class="pt-4 pt-6 mt-10 text-center text-gray-400 border-t border-gray-800">© 2024 {{ $setting->name }}.
        {{ __('All rights reserved') }}.</div>
</footer>

