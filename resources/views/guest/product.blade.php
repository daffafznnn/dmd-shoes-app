<x-guest-layout>
    <!-- Header Section -->
    <header class="sticky top-0 z-50 w-full h-24 bg-gray-200">
        <div class="container flex items-center justify-center h-full max-w-6xl px-8 mx-auto sm:justify-between xl:px-0">

            <a href="/" class="relative flex items-center inline-block h-5 h-full font-black leading-none">
                <img src="{{ asset('assets/images/dmd-logo.png') }}" alt="dmd-logo" class="w-16 h-16">
                <span class="ml-3 text-xl text-gray-800">DMD Shoes</span>
            </a>

            <nav id="nav"
                class="absolute top-0 left-0 z-50 flex flex-col items-center justify-between hidden w-full h-64 pt-5 mt-24 text-sm text-gray-800 bg-white border-t border-gray-200 md:w-auto md:flex-row md:h-24 lg:text-base md:bg-transparent md:mt-0 md:border-none md:py-0 md:flex md:relative">

                <!-- Dropdown for Category -->
                <div class="relative group">
                    <a href="javascript:void(0);"
                        class="font-bold text-sm md:text-base text-gray-800 hover:text-green-500 transition-all duration-200">
                        Kategori
                        <i class="fa-solid fa-chevron-down transition-transform transform group-hover:rotate-180"></i>
                    </a>
                    <div
                        class="absolute hidden group-hover:block bg-white shadow-lg border border-gray-200 w-48 z-20 mt-2 rounded-md">
                        <a href="#superiority-subitem1"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-600 hover:text-white">Kategori
                            1</a>
                        <a href="#superiority-subitem2"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-600 hover:text-white">Kategori
                            2</a>
                    </div>
                </div>

                <!-- Dropdown for Type -->
                <div class="relative group mx-10">
                    <a href="javascript:void(0);"
                        class="font-bold text-sm md:text-base text-gray-800 hover:text-green-500 transition-all duration-200">
                        Tipe
                        <i class="fa-solid fa-chevron-down transition-transform transform group-hover:rotate-180"></i>
                    </a>
                    <div
                        class="absolute hidden group-hover:block bg-white shadow-lg border border-gray-200 w-48 z-20 mt-2 rounded-md">
                        <a href="#superiority-subitem1"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-600 hover:text-white">Classic</a>
                        <a href="#superiority-subitem2"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-600 hover:text-white">Sport</a>
                    </div>
                </div>

                <!-- Dropdown for Material -->
                <div class="relative group">
                    <a href="javascript:void(0);"
                        class="font-bold text-sm md:text-base text-gray-800 hover:text-green-500 transition-all duration-200">
                        Bahan
                        <i class="fa-solid fa-chevron-down transition-transform transform group-hover:rotate-180"></i>
                    </a>
                    <div
                        class="absolute hidden group-hover:block bg-white shadow-lg border border-gray-200 w-48 z-20 mt-2 rounded-md">
                        <a href="#superiority-subitem1"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-600 hover:text-white">Kulit</a>
                        <a href="#superiority-subitem2"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-600 hover:text-white">Karet</a>
                    </div>
                </div>

                <a href="#"
                    class="absolute left-0 ml-10 flex-col items-center justify-center hidden w-full pb-8 mt-48 border-b border-gray-200 md:relative md:w-auto md:bg-transparent md:border-none md:mt-0 md:flex-row md:p-0 md:items-end md:flex md:justify-between">
                    <div href="#" class="relative z-40 mr-0 py-2 px-3 bg-green-500 hover:bg-green-600 rounded-md text-sm font-bold text-white sm:mr-3 md:mt-0">
                        Login
                    </div>
                </a>

                <div class="flex flex-col block w-full font-medium border-t border-gray-200 md:hidden">
                    <a href="#_" class="w-full py-2 font-bold text-center text-white bg-green-500">Login</a>
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
    <nav id="secondary-nav" class="sticky top-24 z-10 w-full bg-gray-100 shadow-md">
        <div class="container flex items-center justify-center h-16 px-8 mx-auto max-w-7xl">

            <!-- Search Bar -->
            <div class="relative flex items-center w-full max-w-xl md:mr-8">
                <input type="text"
                    class="w-full py-2 pl-3 pr-10 border rounded-md border-gray-300 text-gray-800 focus:outline-none focus:ring-2 focus:ring-green-500 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-200"
                    placeholder="Cari produk...">
                <button class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-600 dark:text-gray-300">
                    <i class="fa fa-search"></i>
                </button>
            </div>

            <div
                class="left-0 flex-col ml-5 border-b border-gray-200 md:relative md:w-auto md:bg-transparent md:border-none md:mt-0 md:flex-row md:p-0 md:items-end md:flex md:justify-between">
                <a href="#" class="relative z-40 mr-0 text-sm font-bold text-white sm:mr-3 md:mt-0">
                    <i class="fa-solid fa-cart-shopping text-xl text-black"></i>
                </a>
            </div>

        </div>
    </nav>

    {{-- Product --}}
    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

            <!-- Product Card 1 -->
            <a href="#" class="bg-white shadow-md rounded-lg overflow-hidden hover:shadow-lg transform transition duration-200 hover:scale-105 hover:shadow-lg">
                <img src="{{ asset('assets/images/product_1.jpg') }}" alt="Product Image"
                    class="w-full h-56 object-cover">
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-800 truncate">Sepatu Sneakers Pria Stylish</h3>
                    <div class="flex items-center mt-2">
                        <span class="text-xl font-semibold text-green-500">Rp 450.000</span>
                        <span class="ml-2 text-sm text-gray-500 line-through">Rp 500.000</span>
                    </div>
                    <div class="mt-2">
                        <span class="text-sm text-gray-500 font-bold">Casual</span>
                    </div>
                    <button
                        class="w-full mt-4 py-2 px-4 bg-green-500 text-white rounded-md hover:bg-green-600 transition-colors duration-200">
                        Tambahkan ke Keranjang
                    </button>
                </div>
            </a>

            <!-- Product Card 2 -->
            <a href="#" class="bg-white shadow-md rounded-lg overflow-hidden hover:shadow-lg transform transition duration-200 hover:scale-105 hover:shadow-lg">
                <img src="{{ asset('assets/images/product_1.jpg') }}" alt="Product Image"
                    class="w-full h-56 object-cover">
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-800 truncate">Tas Wanita Kulit Asli</h3>
                    <div class="flex items-center mt-2">
                        <span class="text-xl font-semibold text-green-500">Rp 750.000</span>
                        <span class="ml-2 text-sm text-gray-500 line-through">Rp 900.000</span>
                    </div>
                    <div class="mt-2">
                        <span class="text-sm text-gray-500 font-bold">Classic</span>
                    </div>
                    <button
                        class="w-full mt-4 py-2 px-4 bg-green-500 text-white rounded-md hover:bg-green-600 transition-colors duration-200">
                        Tambahkan ke Keranjang
                    </button>
                </div>
            </a>

            <!-- Product Card 3 -->
            <a href="#" class="bg-white shadow-md rounded-lg overflow-hidden hover:shadow-lg transform transition duration-200 hover:scale-105 hover:shadow-lg">
                <img src="{{ asset('assets/images/product_1.jpg') }}" alt="Product Image"
                    class="w-full h-56 object-cover">
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-800 truncate">Jam Tangan Digital Pria</h3>
                    <div class="flex items-center mt-2">
                        <span class="text-xl font-semibold text-green-500">Rp 320.000</span>
                        <span class="ml-2 text-sm text-gray-500 line-through">Rp 400.000</span>
                    </div>
                    <div class="mt-2">
                        <span class="text-sm text-gray-500 font-bold">Sport</span>
                    </div>
                    <button
                        class="w-full mt-4 py-2 px-4 bg-green-500 text-white rounded-md hover:bg-green-600 transition-colors duration-200">
                        Tambahkan ke Keranjang
                    </button>
                </div>
            </a>

            <!-- Product Card 4 -->
            <a href="#" class="bg-white shadow-md rounded-lg overflow-hidden hover:shadow-lg transform transition duration-200 hover:scale-105 hover:shadow-lg">
                <img src="{{ asset('assets/images/product_1.jpg') }}" alt="Product Image"
                    class="w-full h-56 object-cover">
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-800 truncate">Kamera Mirrorless Sony Alpha</h3>
                    <div class="flex items-center mt-2">
                        <span class="text-xl font-semibold text-green-500">Rp 8.500.000</span>
                        <span class="ml-2 text-sm text-gray-500 line-through">Rp 9.000.000</span>
                    </div>
                    <div class="mt-2">
                        <span class="text-sm text-gray-500 font-bold">Casual</span>
                    </div>
                    <button
                        class="w-full mt-4 py-2 px-4 bg-green-500 text-white rounded-md hover:bg-green-600 transition-colors duration-200">
                        Tambahkan ke Keranjang
                    </button>
                </div>
            </a>
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
                        <a class="flex items-center block mr-6 text-gray-400 no-underline hover:text-gray-600"
                            target="_blank" rel="noopener noreferrer" href="https://devdojo.com">
                            <i class="fa-brands fa-facebook text-2xl"></i>
                        </a>
                        <a class="flex items-center block mr-6 text-gray-400 no-underline hover:text-gray-600"
                            target="_blank" rel="noopener noreferrer" href="https://devdojo.com">
                            <i class="fa-brands fa-instagram text-2xl"></i>
                        </a>
                        <a class="flex items-center block mr-6 text-gray-400 no-underline hover:text-gray-600"
                            target="_blank" rel="noopener noreferrer" href="https://devdojo.com">
                            <i class="fa-brands fa-twitter text-2xl"></i>
                        </a>
                        <a class="flex items-center block text-gray-400 no-underline hover:text-gray-600"
                            target="_blank" rel="noopener noreferrer" href="https://devdojo.com">
                            <i class="fa-brands fa-youtube text-2xl"></i>
                        </a>
                    </div>
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
