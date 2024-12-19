@props(['setting'])

{{-- get in touch  --}}
<div class="lg:mx-24">
    <div class="p-3 bg-[#3ca860] mt-4 text-white text-2xl font-bold">
        <p>{{ __('Get in Touch with Us') }}</p>
    </div>

    <div class="flex w-full flex-wrap lg:flex-nowrap">
        <div class="w-full text-center lg:text-left lg:w-1/2 ml-3">
            <h2 class="mt-5 text-xl font-semibold mb-4 ">{{ __('Our Company') }}</h2>
            <ul class="flex gap-4 flex-col mb-4">
                <li>{{ __('About Us') }}</li>
                <li>{{ __('Our Products') }}</li>
                <li>{{ __('Contact Us') }}</li>
            </ul>
            <p>

                <i class="fa-solid fa-share-nodes mr-3"></i> <span>{{ __('Share us Via') }}</span>
                <i class="fa-brands fa-facebook ml-3 text-blue-800 text-xl"></i>
                <i class="fa-brands fa-twitter ml-3 text-blue-800 text-xl"></i>
                <i class="fa-brands fa-linkedin ml-3 text-blue-800 text-xl"></i>

            </p>
        </div>

        <div class="w-full text-center lg:text-left mt-3 lg:w-1/3 ml-3">
            <h2 class="mt-5 text-xl font-semibold mb-4 ">{{ __('Reach Us') }}</h2>
            <ul class="flex gap-4 mb-4  justify-center lg:justify-start">
                <li><i class="fa-solid fa-location-dot"></i></li>
                <li>{{ $setting->address ?? ''}}</li>

            </ul>
        </div>
    </div>
</div>