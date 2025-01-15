    <nav id="secondary-nav" class="sticky top-0 z-10 w-full bg-gray-100 shadow-md bg-black h-auto p-2 py-10 md:py-0">
        <div class="container flex flex-col md:flex-row items-center justify-between h-16 px-4 md:px-8 mx-auto max-w-7xl">
            
            <!-- Search Bar -->
            <form action="{{ route('product.all') }}" method="GET" class="relative flex items-center w-full max-w-full md:max-w-xl mb-4 md:mb-0">
                <input type="text" 
                    class="w-full py-2 pl-3 pr-10 border rounded-md border-gray-300 text-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-800 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-200"
                    placeholder="{{ __('Search product') }}..." id="search" name="search">
                <button class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-600 dark:text-gray-300">
                    <i class="fa fa-search"></i>
                </button>
            </form>
            
            <div class="flex items-center space-x-4">
                <a href="{{ route('product.all') }}" class="flex items-center space-x-2">
                    <i class="fa fa-shopping-bag text-2xl text-gray-100 dark:text-white"></i>
                    <span class="text-gray-100 dark:text-white">{{ __('Semua Produk') }}</span>
                </a>
            </div>
             </div>
    </nav>

