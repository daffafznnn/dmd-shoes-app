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

            <!-- Button Favorite -->
            <div>
                <a href="#" class="ml-4 text-white flex flex-col items-center">
                    <i class="bi bi-heart-fill"></i>
                    <span class="text-xs mt-1">{{ __('Favorite') }}</span>
                </a>
            </div>
        </div>
    </nav>

