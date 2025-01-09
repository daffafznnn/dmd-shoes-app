<x-guest-layout>
    <!-- Header Section -->
    <header class="z-50 w-full h-24 bg-white">
        <div class="container flex items-center justify-center h-full max-w-6xl px-8 mx-auto sm:justify-between xl:px-0">

            <a href="/" class="relative flex items-center inline-block h-5 h-full font-black leading-none">
                <img src="{{ asset('assets/images/dmd-logo.png') }}" alt="dmd-logo" class="w-16 h-16">
                <span class="ml-3 text-xl text-gray-800">DMD Shoes</span>
            </a>

            <nav id="nav"
                class="absolute top-0 left-0 z-50 flex flex-col items-center justify-between hidden w-full h-auto mt-24 text-sm text-gray-800 bg-white border-t border-gray-200 md:w-auto md:flex-row md:h-24 lg:text-base md:bg-transparent md:mt-0 md:border-none md:py-0 md:flex md:relative">

                <a href="#"
                    class="absolute left-0 ml-10 flex-col items-center hidden justify-center md:w-full pb-8 mt-48 border-b border-gray-200 md:relative md:w-auto md:bg-transparent md:border-none md:mt-0 md:flex-row md:p-0 md:items-end md:flex md:justify-between">
                    <div href="#"
                        class="flex items-center z-40 mr-0 py-2 px-3 bg-green-500 hover:bg-green-600 rounded-md text-sm font-bold text-white sm:mr-3 md:mt-0">
                        <i class="fa-brands fa-whatsapp text-2xl mr-2"></i>Chat onlline now!
                    </div>
                </a>

                <a href="#"
                    class="absolute left-0 ml-10 flex-col items-center justify-center hidden w-full pb-8 mt-48 border-b border-gray-200 md:relative md:w-auto md:bg-transparent md:border-none md:mt-0 md:flex-row md:p-0 md:items-end md:flex md:justify-between">
                    <div href="#"
                        class="relative z-40 mr-0 py-3 px-4 bg-blue-500 hover:bg-blue-600 rounded-md text-sm font-bold text-white sm:mr-3 md:mt-0">
                        Login
                    </div>
                </a>

                <div
                    class="flex flex-col block w-full font-medium border-t border-gray-200 text-green-500 hover:text-white hover:bg-green-500 md:hidden">
                    <a href="#_" class="w-full py-2 font-bold text-center"><i
                            class="fa-brands fa-whatsapp mr-2"></i>Chat online now!</a>
                </div>
                <div
                    class="flex flex-col block w-full font-medium border-t border-gray-200 text-blue-500 hover:text-white hover:bg-blue-500 md:hidden">
                    <a href="#_" class="w-full py-2 font-bold text-center">Login</a>
                </div>
            </nav>

            <div id="nav-mobile-btn"
                class="absolute top-0 right-0 z-50 block w-6 mt-8 mr-10 cursor-pointer select-none md:hidden sm:mt-10">
                <span class="block w-full h-1 mt-2 duration-200 transform bg-gray-800 rounded-full sm:mt-1"></span>
                <span class="block w-full h-1 mt-1 duration-200 transform bg-gray-800 rounded-full"></span>
            </div>

        </div>
    </header>

    <!-- New Navigation Below Header -->
    <nav id="secondary-nav" class="sticky top-0 z-10 w-full bg-gray-100 shadow-md bg-green-600">
        <div class="container flex items-center justify-center h-16 px-8 mx-auto max-w-7xl">

            <!-- Search Bar -->
            <form action="" method="GET" class="relative flex items-center w-full max-w-xl">
                <input type="text"
                    class="w-full py-2 pl-3 pr-10 border rounded-md border-gray-300 text-gray-800 focus:outline-none focus:ring-2 focus:ring-green-500 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-200"
                    placeholder="Cari produk..." id="keyword" name="keyword">
                <button class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-600 dark:text-gray-300">
                    <i class="fa fa-search"></i>
                </button>
            </form>
        </div>
    </nav>

    <div class="relative w-full max-w-6xl mx-auto overflow-hidden mt-5">
        <!-- Carousel container -->
        <div id="carousel" class="carousel flex transition-all duration-500 ease-in-out">
            <!-- Slide 1 -->
            <div class="relative flex-shrink-0 w-full h-64 lg:h-72 xl:h-80">
                <img src="{{ asset('assets/images/carousel-1.webp') }}" alt="Image 1" class="w-full h-full">
            </div>

            <!-- Slide 2 -->
            <div class="relative flex-shrink-0 w-full h-64 lg:h-72 xl:h-80">
                <img src="{{ asset('assets/images/carousel-1.webp') }}" alt="Image 2"
                    class="w-full h-full object-cover">
            </div>

            <!-- Slide 3 -->
            <div class="relative flex-shrink-0 w-full h-64 lg:h-72 xl:h-80">
                <img src="{{ asset('assets/images/carousel-1.webp') }}" alt="Image 3"
                    class="w-full h-full object-contain">
            </div>
        </div>

        <!-- Carousel Controls -->
        <button id="prev"
            class="absolute top-1/2 left-0 transform -translate-y-1/2 p-4 hover:bg-black hover:text-white text-black rounded-full">
            <i class="fa-solid fa-chevron-left"></i>
        </button>
        <button id="next"
            class="absolute top-1/2 right-0 transform -translate-y-1/2 p-4 hover:bg-black hover:text-white text-black rounded-full">
            <i class="fa-solid fa-chevron-right"></i>
        </button>
    </div>

    <section class="mt-5">
        <div class="container bg-white mx-auto mt-5">
            <h2 class="font-bold text-xl pt-4 px-4">Kategori</h2>
            <!-- Scrollable Card Container -->
            <div class="flex flex-wrap text-center justify-center gap-8 py-7">
                @foreach ($categories as $category)
                    <a href="?category={{ $category->id }}"
                        class="bg-gray-200 rounded-lg shadow-md overflow-hidden group transform transition duration-300 hover:scale-105 hover:shadow-lg flex flex-col w-64">
                        <div class="p-6 flex flex-col justify-center items-center">
                            <h3 class="text-xl font-semibold text-gray-800">{{ $category->name }}</h3>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Product --}}
    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

            @foreach ($products as $product)
                <a href="#"
                    class="bg-white shadow-md rounded-lg overflow-hidden hover:shadow-lg transform transition duration-200 hover:scale-105 hover:shadow-lg">
                    <img src="{{ $product->cover ? asset('assets/images/' . $product->cover) : asset('assets/images/no-image.png') }}"
                        alt="Product Image" class="w-full h-56 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800 truncate">{{ $product->name }}</h3>
                        <div class="flex items-center mt-2">
                            <span class="text-xl font-semibold text-green-500">Rp
                                {{ number_format($product->default_price, 0, ',', '.') }}</span>
                        </div>
                        <div class="mt-2">
                            <span class="text-sm text-gray-500 font-bold">{{ $product->type }}</span>
                        </div>
                        <div class="flex items-center gap-3 mt-4">
                            <button
                                class="w-full py-2 px-4 bg-green-500 font-semibold tracking-wider text-white rounded-md hover:bg-green-600 transition-colors duration-200"
                                title="Pesan produk">
                                <i class="fa-brands fa-whatsapp"></i> Order
                            </button>
                            <button
                                class="w-full py-2 px-4 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition-colors duration-200"
                                title="Lihat Detail Produk">
                                View Detail
                            </button>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

    <footer class="px-4 pt-12 pb-8 text-white bg-white border-t border-gray-200" id="about-us">
        <div class="container flex flex-col justify-between max-w-6xl px-4 mx-auto overflow-hidden lg:flex-row">
            <div class="w-full pl-12 mr-4 text-left lg:w-1/4 sm:text-center sm:pl-0 lg:text-left">
                <a href="/"
                    class="flex justify-start block text-left sm:text-center lg:text-left sm:justify-center lg:justify-start">
                    <span class="flex items-start sm:items-center">
                        <img src="{{ asset('assets/images/dmd-logo.png') }}" alt="dmd-logo" class="w-20 h-16">
                    </span>
                </a>
                <p class="mt-6 mr-4 text-base text-gray-500">Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                    Culpa, quasi?.
                </p>
            </div>
            <div class="block w-full pl-10 mt-6 text-sm lg:w-3/4 sm:flex lg:mt-0">
                <ul class="flex flex-col w-full p-0 font-medium text-left text-gray-700 list-none">
                    <li class="inline-block px-3 py-2 mt-5 font-bold tracking-wide text-gray-800 uppercase md:mt-0">
                        About Us</li>
                    <li><a href="#_"
                            class="inline-block px-3 py-2 text-gray-500 no-underline hover:text-gray-600">DMD Shoes</a>
                    </li>
                    <li><a href="#_"
                            class="inline-block px-3 py-2 text-gray-500 no-underline hover:text-gray-600">Lorem ipsum
                            dolor, sit amet consectetur adipisicing elit. Ipsum, earum.</a>
                    </li>
                    <li><a href="#_"
                            class="inline-block px-3 py-2 text-gray-500 no-underline hover:text-gray-600">Jln. Jendral
                            Sudirman no. 142</a>
                    </li>
                </ul>
                <div class="flex flex-col w-full text-gray-700">
                    <div class="inline-block px-3 py-2 mt-5 font-bold text-gray-800 uppercase md:mt-0">Follow Us</div>
                    <div class="flex justify-start pl-4 mt-2">
                        @foreach ($social_setting as $social)
                            <a class="flex items-center block mr-6 text-gray-400 no-underline hover:text-gray-600"
                                target="_blank" href="{{ $social->url }}">
                                <i class="fa-brands fa-{{ $social->icon }} text-2xl"></i>
                        @endforeach
                    </div>
                    <a href="#"
                        class="flex items-center justify-center py-3 border w-full border-green-500 hover:bg-green-500 text-green-500 hover:text-white mt-7 md:w-1/2 max-w-xs tracking-wide rounded-md font-bold">
                        <i class="fa-brands fa-whatsapp text-2xl mr-2"></i> Chat online now!
                    </a>
                </div>
            </div>
        </div>
        <div class="pt-4 pt-6 mt-10 text-center text-gray-500 border-t border-gray-100">© 2024 DMD Shoes. All rights
            reserved.</div>
    </footer>

    <!-- a little JS for the mobile nav button -->
    <script>
        if (document.getElementById('nav-mobile-btn')) {
            document.getElementById('nav-mobile-btn').addEventListener('click', function() {
                if (this.classList.contains('close')) {
                    document.getElementById('nav').classList.add('hidden');
                    this.classList.remove('close');
                } else {
                    document.getElementById('nav').classList.remove('hidden');
                    this.classList.add('close');
                }
            });
        }
    </script>
</x-guest-layout>
