<x-guest-layout>
    <!-- Header Section -->
    <header class="sticky top-0 border-b border-gray-200 z-50 w-full h-24 bg-white shadow-b shadow-md">
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

    {{-- Detail Product --}}
    <div class="container px-5 mt-8">
        <!-- Product Detail Container -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 bg-white py-4 p-5">
            <!-- Product Image -->
            <div class="relative">
                <img src="{{ asset('assets/images/' . $product->cover) }}" alt="{{ $product['name'] }}"
                    class="w-full h-96 object-contain rounded-lg shadow-lg p-4">
            </div>

            <!-- Product Info -->
            <div class="flex flex-col justify-between">
                <div>
                    <h1 class="text-3xl font-semibold text-gray-900 mt-3 md:mt-0">{{ $product->name }}</h1>
                    <p class="text-lg text-gray-600 mt-2">{{ $product->description }}</p>

                    <div class="mt-4">
                        <p class="text-xl font-bold text-gray-900">Rp
                            {{ number_format($product->default_price, 0, ',', '.') }}
                        </p>
                        <div class="mt-2 grid grid-cols-2 gap-2 md:gap-4">
                            <div class="mt-2">
                                <span class="font-semibold">size :</span>
                                <div class="grid grid-cols-3 md:grid-cols-4 gap-1 mt-1 text-center">
                                    <a href="" class="border border-gray-200 hover:bg-gray-100 px-3 py-2">40</a>
                                    <a href="" class="border border-gray-200 hover:bg-gray-100 px-3 py-2">41</a>
                                    <a href="" class="border border-gray-200 hover:bg-gray-100 px-3 py-2">42</a>
                                    <a href="" class="border border-gray-200 hover:bg-gray-100 px-3 py-2">43</a>
                                    <a href="" class="border border-gray-200 hover:bg-gray-100 px-3 py-2">44</a>
                                </div>
                            </div>
                            <div class="mt-2">
                                <span class="font-semibold">color :</span>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-1 mt-1 text-center">
                                    <a href="" class="border border-gray-200 hover:bg-gray-100 px-3 py-2">red</a>
                                    <a href=""
                                        class="border border-gray-200 hover:bg-gray-100 px-3 py-2">yellow</a>
                                    <a href=""
                                        class="border border-gray-200 hover:bg-gray-100 px-3 py-2">blue</a>
                                    <a href=""
                                        class="border border-gray-200 hover:bg-gray-100 px-3 py-2">brown</a>
                                    <a href=""
                                        class="border border-gray-200 hover:bg-gray-100 px-3 py-2">pink</a>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5">
                            <h2 class="text-lg font-semibold text-gray-900">Stok tersedia :
                                {{ $product->default_stock . ' ' . $product->units->acronym }}</h2>
                        </div>
                    </div>
                </div>

                <div class="py-4 mt-2 md:mt-0">
                    <!-- Buy Now Button -->
                    <div>
                        <a href="#"
                            class="w-full sm:w-auto px-4 py-3 border border-green-500 text-green-500 hover:text-white font-medium rounded-lg shadow-md hover:bg-green-500 transition duration-200">
                            <i class="fa-brands fa-whatsapp mr-2"></i> Order Now!
                        </a>
                    </div>
                </div>
            </div>
            <div class="hidden md:block">
                <div class="grid grid-cols-3 md:grid-cols-4 gap-2">
                    <a href="" class="transform transition duration-200 hover:scale-105">
                        <img src="{{ asset('assets/images/' . $product->cover) }}" alt=""
                            class="w-24 h-24 md:w-32 md:h-32 border hover:border-4 border-gray-200 rounded-sm hover:shadow-md">
                    </a>
                    <a href="" class="transform transition duration-200 hover:scale-105">
                        <img src="{{ asset('assets/images/' . $product->cover) }}" alt=""
                            class="w-24 h-24 md:w-32 md:h-32 border hover:border-4 border-gray-200 rounded-sm hover:shadow-md">
                    </a>
                    <a href="" class="transform transition duration-200 hover:scale-105">
                        <img src="{{ asset('assets/images/' . $product->cover) }}" alt=""
                            class="w-24 h-24 md:w-32 md:h-32 border hover:border-4 border-gray-200 rounded-sm hover:shadow-md">
                    </a>
                    <a href="" class="transform transition duration-200 hover:scale-105">
                        <img src="{{ asset('assets/images/' . $product->cover) }}" alt=""
                            class="w-24 h-24 md:w-32 md:h-32 border hover:border-4 border-gray-200 rounded-sm hover:shadow-md">
                    </a>
                </div>
            </div>
        </div>

        <!-- Related Products Section (Optional) -->
        <div class="mt-16">
            <h2 class="text-2xl font-semibold text-gray-900 mb-4">Related Products</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($related_products as $related)
                    <a href="#"
                        class="bg-white shadow-md rounded-lg overflow-hidden hover:shadow-lg transform transition duration-200 hover:scale-105 hover:shadow-lg">
                        <img src="{{ $related->cover ? asset('assets/images/' . $related->cover) : asset('assets/images/no-image.png') }}"
                            alt="related Image" class="w-full h-56 object-cover">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-800 truncate">{{ $related->name }}</h3>
                            <div class="flex items-center mt-2">
                                <span class="text-xl font-semibold text-green-500">Rp
                                    {{ number_format($related->default_price, 0, ',', '.') }}</span>
                            </div>
                            <div class="mt-2">
                                <span class="text-sm text-gray-500 font-bold">{{ $related->type }}</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <button
                                    class="w-full mt-4 py-2 px-4 bg-green-500 font-semibold tracking-wider text-white rounded-md hover:bg-green-600 transition-colors duration-200"
                                    title="Pesan produk">
                                    <i class="fa-brands fa-whatsapp"></i> Order
                                </button>
                                <button
                                    class="w-full mt-4 py-2 px-4 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition-colors duration-200"
                                    title="Lihat Detail Produk">
                                    View Detail
                                </button>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <footer class="px-4 pt-12 pb-8 text-white bg-white mt-10 border-t border-gray-200" id="about-us">
        <div class="flex flex-col justify-between max-w-6xl px-4 mx-auto overflow-hidden lg:flex-row">
            <div class="w-full md:pl-12 mr-4 px-3 text-left lg:w-1/4 sm:text-center sm:pl-0 lg:text-left">
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
            <div class="block w-full md:pl-10 mt-6 text-sm lg:w-3/4 sm:flex lg:mt-0">
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
