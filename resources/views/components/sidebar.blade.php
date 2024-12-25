<!-- Sidebar -->
<aside class="flex-shrink-0 hidden w-64 bg-white border-r dark:border-primary-darker dark:bg-darker md:block">
    <div class="flex flex-col h-full">
        <!-- Sidebar links -->
        <nav aria-label="Main" class="flex-1 px-2 py-4 space-y-2 overflow-y-hidden hover:overflow-y-auto">
            <!-- Dashboard link -->
            <div x-data="{ isActive: {{ Request::is('admin/dashboard') || Request::is('admin/dashboard/*') ? 'true' : 'false' }}, open: false }">
                <a href="{{ route('admin.dashboard') }}" 
                    class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                    :class="{ 'bg-primary-100 dark:bg-primary': isActive || open }" role="button" aria-haspopup="true"
                    :aria-expanded="(open || isActive) ? 'true' : 'false'">
                    <span aria-hidden="true">
                        <i class="bi bi-house-door w-5 h-5"></i> <!-- Bootstrap Icon for Dashboard -->
                    </span>
                    <span class="ml-2 text-sm"> Dashboard </span>
                </a>
            </div>

            <!-- Product Management -->
            <div x-data="{ isActive: {{ Request::is('admin/master/products') || Request::is('admin/master/products/*') ? 'true' : 'false' }}, open: false }">
                <a href="#" @click="$event.preventDefault(); open = !open"
                    class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary-100"
                    :class="{ 'bg-primary-100 dark:bg-primary': isActive || open }" role="button" aria-haspopup="true"
                    :aria-expanded="(open || isActive) ? 'true' : 'false'">
                    <span aria-hidden="true">
                        <i class="bi bi-box w-5 h-5"></i> <!-- Bootstrap Icon for Products -->
                    </span>
                    <span class="ml-2 text-sm"> Produk </span>
                    <span class="ml-auto" aria-hidden="true">
                        <svg class="w-4 h-4 transition-transform transform" :class="{ 'rotate-180': open }"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </span>
                </a>
                <div role="menu" x-show="open" class="mt-2 space-y-2 px-7">
                    <a href="#" 
                        class="block p-2 text-sm text-gray-700 transition-colors duration-200 rounded-md dark:text-light dark:hover:text-light hover:text-gray-700">Daftar Produk</a>
                    <a href="#" 
                        class="block p-2 text-sm text-gray-700 transition-colors duration-200 rounded-md dark:text-light dark:hover:text-light hover:text-gray-700">Tambah Produk</a>
                </div>
            </div>

            <!-- Order Management -->
            <div x-data="{ isActive: {{ Request::is('admin/orders') || Request::is('admin/orders/*') ? 'true' : 'false' }}, open: false }">
                <a href="#" @click="$event.preventDefault(); open = !open"
                    class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary-100"
                    :class="{ 'bg-primary-100 dark:bg-primary': isActive || open }" role="button" aria-haspopup="true"
                    :aria-expanded="(open || isActive) ? 'true' : 'false'">
                    <span aria-hidden="true">
                        <i class="bi bi-cart w-5 h-5"></i> <!-- Bootstrap Icon for Orders -->
                    </span>
                    <span class="ml-2 text-sm"> Pesanan </span>
                    <span class="ml-auto" aria-hidden="true">
                        <svg class="w-4 h-4 transition-transform transform" :class="{ 'rotate-180': open }"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </span>
                </a>
                <div role="menu" x-show="open" class="mt-2 space-y-2 px-7">
                    <a href="#" 
                        class="block p-2 text-sm text-gray-700 transition-colors duration-200 rounded-md dark:text-light dark:hover:text-light hover:text-gray-700">Daftar Pesanan</a>
                    <a href="#" 
                        class="block p-2 text-sm text-gray-700 transition-colors duration-200 rounded-md dark:text-light dark:hover:text-light hover:text-gray-700">Tambah Pesanan</a>
                </div>
            </div>

            <!-- User Management -->
             <div x-data="{ isActive: {{ Request::is('admin/users') || Request::is('admin/users/*') ? 'true' : 'false' }}, open: false }">
                <a href="#" @click="$event.preventDefault(); open = !open"
                    class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary-100"
                    :class="{ 'bg-primary-100 dark:bg-primary': isActive || open }" role="button" aria-haspopup="true"
                    :aria-expanded="(open || isActive) ? 'true' : 'false'">
                    <span aria-hidden="true">
                        <i class="bi bi-person w-5 h-5"></i> <!-- Bootstrap Icon for Users -->
                    </span>
                    <span class="ml-2 text-sm"> Pengguna </span>
                    <span class="ml-auto" aria-hidden="true">
                        <svg class="w-4 h-4 transition-transform transform" :class="{ 'rotate-180': open }"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </span>
                </a>
                <div role="menu" x-show="open" class="mt-2 space-y-2 px-7">
                    <a href="{{ route('admin.users.index') }}" 
                        class="block p-2 text-sm text-gray-700 transition-colors duration-200 rounded-md dark:text-light dark:hover:text-light hover:text-gray-700
                        {{ Request::is('admin/users') || Request::is('admin/users/*') ? 'text-primary-200' : '' }}">Daftar Pengguna</a>
                    <a href="{{ route('admin.users.create') }}" 
                        class="block p-2 text-sm text-gray-700 transition-colors duration-200 rounded-md dark:text-light dark:hover:text-light hover:text-gray-700
                        {{ Request::is('admin/users/create') ? 'text-primary-200' : '' }}">Tambah Pengguna</a>
                </div>
            </div>

            <!-- Settings -->
            <div x-data="{ isActive: {{ Request::is('admin/settings') || Request::is('admin/settings/*') ? 'true' : 'false' }}, open: false }">
                <a href="#" @click="$event.preventDefault(); open = !open"
                    class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary-100"
                    :class="{ 'bg-primary-100 dark:bg-primary': isActive || open }" role="button" aria-haspopup="true"
                    :aria-expanded="(open || isActive) ? 'true' : 'false'">
                    <span aria-hidden="true">
                        <i class="bi bi-gear w-5 h-5"></i> <!-- Bootstrap Icon for Settings -->
                    </span>
                    <span class="ml-2 text-sm"> Pengaturan </span>
                    <span class="ml-auto" aria-hidden="true">
                        <svg class="w-4 h-4 transition-transform transform" :class="{ 'rotate-180': open }"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </span>
                </a>
                <div role="menu" x-show="open" class="mt-2 space-y-2 px-7">
                    <a href="#" 
                        class="block p-2 text-sm text-gray-700 transition-colors duration-200 rounded-md dark:text-light dark:hover:text-light hover:text-gray-700">Pengaturan Umum</a>
                    <a href="#" 
                        class="block p-2 text-sm text-gray-700 transition-colors duration-200 rounded-md dark:text-light dark:hover:text-light hover:text-gray-700">Metode Pembayaran</a>
                </div>
            </div>

        </nav>

        <!-- Sidebar footer -->
        <div class="flex-shrink-0 px-2 py-4 space-y-2">
            <button @click="openSettingsPanel" type="button"
                class="flex items-center justify-center w-full px-4 py-2 text-sm text-white rounded-md bg-primary hover:bg-primary-dark focus:outline-none focus:ring focus:ring-primary-dark focus:ring-offset-1 focus:ring-offset-white dark:focus:ring-offset-dark">
                <span aria-hidden="true">
                    <i class="bi bi-sliders w-4 h-4 mr-2"></i> <!-- Bootstrap Icon for Customize -->
                </span>
                <span>Customize</span>
            </button>
        </div>
    </div>
</aside>
