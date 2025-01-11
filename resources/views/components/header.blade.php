         @php
             $settings = \App\Models\Setting::first();
         @endphp
         @auth
             <header class="relative bg-white dark:bg-darker">
                 <div class="flex items-center justify-between p-2 border-b dark:border-primary-darker">
                     <!-- Mobile menu button -->
                     <button @click="isMobileMainMenuOpen = !isMobileMainMenuOpen"
                         class="p-1 transition-colors duration-200 rounded-md text-primary-lighter bg-primary-50 hover:text-primary hover:bg-primary-100 dark:hover:text-light dark:hover:bg-primary-dark dark:bg-dark md:hidden focus:outline-none focus:ring">
                         <span class="sr-only">Open main manu</span>
                         <span aria-hidden="true">
                             <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                     d="M4 6h16M4 12h16M4 18h16" />
                             </svg>
                         </span>
                     </button>

                     <!-- Brand -->
                     <a href="{{ route('admin.dashboard') }}"
                         class="inline-block text-2xl font-bold tracking-wider uppercase text-primary-dark dark:text-light">
                         {{ $settings->name }} 
                     </a>

                     <!-- Mobile sub menu button -->
                     <button @click="isMobileSubMenuOpen = !isMobileSubMenuOpen"
                         class="p-1 transition-colors duration-200 rounded-md text-primary-lighter bg-primary-50 hover:text-primary hover:bg-primary-100 dark:hover:text-light dark:hover:bg-primary-dark dark:bg-dark md:hidden focus:outline-none focus:ring">
                         <span class="sr-only">Open sub manu</span>
                         <span aria-hidden="true">
                             <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                     d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                             </svg>
                         </span>
                     </button>

                     <!-- Desktop Right buttons -->
                     <nav aria-label="Secondary" class="hidden space-x-2 md:flex md:items-center">
                         <!-- Toggle dark theme button -->
                         <button aria-hidden="true" class="relative focus:outline-none" x-cloak @click="toggleTheme">
                             <div
                                 class="w-12 h-6 transition rounded-full outline-none bg-primary-100 dark:bg-primary-lighter">
                             </div>
                             <div class="absolute top-0 left-0 inline-flex items-center justify-center w-6 h-6 transition-all duration-150 transform scale-110 rounded-full shadow-sm"
                                 :class="{
                                     'translate-x-0 -translate-y-px  bg-white text-primary-dark': !
                                         isDark,
                                     'translate-x-6 text-primary-100 bg-primary-darker': isDark
                                 }">
                                 <svg x-show="!isDark" class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                         d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                                 </svg>
                                 <svg x-show="isDark" class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                         d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                 </svg>
                             </div>
                         </button>

                         {{-- <!-- Notification button -->
                         <button @click="openNotificationsPanel"
                             class="p-2 transition-colors duration-200 rounded-full text-primary-lighter bg-primary-50 hover:text-primary hover:bg-primary-100 dark:hover:text-light dark:hover:bg-primary-dark dark:bg-dark focus:outline-none focus:bg-primary-100 dark:focus:bg-primary-dark focus:ring-primary-darker">
                             <span class="sr-only">Open Notification panel</span>
                             <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor" aria-hidden="true">
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                     d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                             </svg>
                         </button>

                         <!-- Search button -->
                         <button @click="openSearchPanel"
                             class="p-2 transition-colors duration-200 rounded-full text-primary-lighter bg-primary-50 hover:text-primary hover:bg-primary-100 dark:hover:text-light dark:hover:bg-primary-dark dark:bg-dark focus:outline-none focus:bg-primary-100 dark:focus:bg-primary-dark focus:ring-primary-darker">
                             <span class="sr-only">Open search panel</span>
                             <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor" aria-hidden="true">
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                     d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                             </svg>
                         </button> --}}

                         <!-- Settings button -->
                         <button @click="openSettingsPanel"
                             class="p-2 transition-colors duration-200 rounded-full text-primary-lighter bg-primary-50 hover:text-primary hover:bg-primary-100 dark:hover:text-light dark:hover:bg-primary-dark dark:bg-dark focus:outline-none focus:bg-primary-100 dark:focus:bg-primary-dark focus:ring-primary-darker">
                             <span class="sr-only">Open settings panel</span>
                             <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor" aria-hidden="true">
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                     d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                     d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                             </svg>
                         </button>

                         <!-- User avatar button -->
                         <div class="relative" x-data="{ open: false }">
                             <button @click="open = !open; $nextTick(() => { if(open){ $refs.userMenu.focus() } })"
                                 type="button" aria-haspopup="true" :aria-expanded="open ? 'true' : 'false'"
                                 class="p-2 transition-colors duration-200 rounded-full text-primary-lighter bg-primary-50 hover:text-primary hover:bg-primary-100 dark:hover:text-light dark:hover:bg-primary-dark dark:bg-dark focus:outline-none focus:bg-primary-100 dark:focus:bg-primary-dark focus:ring-primary-darker">
                                 <span class="sr-only">User menu</span>
                                 <svg class="w-8 h-8 rounded-full dark:text-primary-light"
                                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor">
                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                         d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                 </svg>
                             </button>

                             <!-- User dropdown menu -->
                             <div x-show="open" x-ref="userMenu" x-transition:enter="transition-all transform ease-out"
                                 x-transition:enter-start="translate-y-1/2 opacity-0"
                                 x-transition:enter-end="translate-y-0 opacity-100"
                                 x-transition:leave="transition-all transform ease-in"
                                 x-transition:leave-start="translate-y-0 opacity-100"
                                 x-transition:leave-end="translate-y-1/2 opacity-0" @click.away="open = false"
                                 @keydown.escape="open = false"
                                 class="absolute right-0 w-48 py-1 bg-white rounded-md shadow-lg top-12 ring-1 ring-black ring-opacity-5 dark:bg-dark focus:outline-none"
                                 tabindex="-1" role="menu" aria-orientation="vertical" aria-label="User menu">
                                 <a href="{{ route('profile.edit') }}" role="menuitem"
                                     class="block px-4 py-2 text-sm text-gray-700 transition-colors hover:bg-gray-100 dark:text-light dark:hover:bg-primary">
                                     {{ __('Your Profile') }}
                                 </a>
                                 <!-- Form Logout -->
                                 <form action="{{ route('logout') }}" method="POST"
                                     class="block px-4 py-2 text-sm text-gray-700 transition-colors hover:bg-gray-100 dark:text-light dark:hover:bg-primary">
                                     @csrf
                                     <button type="submit" role="menuitem" class="w-full text-left">
                                         {{ __('Logout') }}
                                     </button>
                                 </form>
                             </div>
                         </div>

                     </nav>

                     <!-- Mobile sub menu -->
                     <nav x-transition:enter="transition duration-200 ease-in-out transform sm:duration-500"
                         x-transition:enter-start="-translate-y-full opacity-0"
                         x-transition:enter-end="translate-y-0 opacity-100"
                         x-transition:leave="transition duration-300 ease-in-out transform sm:duration-500"
                         x-transition:leave-start="translate-y-0 opacity-100"
                         x-transition:leave-end="-translate-y-full opacity-0" x-show="isMobileSubMenuOpen"
                         @click.away="isMobileSubMenuOpen = false"
                         class="absolute flex items-center p-4 bg-white rounded-md shadow-lg dark:bg-darker top-16 inset-x-4 md:hidden"
                         aria-label="Secondary">
                         <div class="space-x-2">
                             <!-- Toggle dark theme button -->
                             <button aria-hidden="true" class="relative focus:outline-none" x-cloak @click="toggleTheme">
                                 <div
                                     class="w-12 h-6 transition rounded-full outline-none bg-primary-100 dark:bg-primary-lighter">
                                 </div>
                                 <div class="absolute top-0 left-0 inline-flex items-center justify-center w-6 h-6 transition-all duration-200 transform scale-110 rounded-full shadow-sm"
                                     :class="{
                                         'translate-x-0 -translate-y-px  bg-white text-primary-dark': !
                                             isDark,
                                         'translate-x-6 text-primary-100 bg-primary-darker': isDark
                                     }">
                                     <svg x-show="!isDark" class="w-4 h-4" xmlns="http://www.w3.org/2000/svg"
                                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                             d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                                     </svg>
                                     <svg x-show="isDark" class="w-4 h-4" xmlns="http://www.w3.org/2000/svg"
                                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                             d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                     </svg>
                                 </div>
                             </button>

                             {{-- <!-- Notification button -->
                             <button @click="openNotificationsPanel(); $nextTick(() => { isMobileSubMenuOpen = false })"
                                 class="p-2 transition-colors duration-200 rounded-full text-primary-lighter bg-primary-50 hover:text-primary hover:bg-primary-100 dark:hover:text-light dark:hover:bg-primary-dark dark:bg-dark focus:outline-none focus:bg-primary-100 dark:focus:bg-primary-dark focus:ring-primary-darker">
                                 <span class="sr-only">Open notifications panel</span>
                                 <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                         d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                 </svg>
                             </button>

                             <!-- Search button -->
                             <button
                                 @click="openSearchPanel(); $nextTick(() => { $refs.searchInput.focus(); setTimeout(() => {isMobileSubMenuOpen= false}, 100) })"
                                 class="p-2 transition-colors duration-200 rounded-full text-primary-lighter bg-primary-50 hover:text-primary hover:bg-primary-100 dark:hover:text-light dark:hover:bg-primary-dark dark:bg-dark focus:outline-none focus:bg-primary-100 dark:focus:bg-primary-dark focus:ring-primary-darker">
                                 <span class="sr-only">Open search panel</span>
                                 <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                         d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                 </svg>
                             </button> --}}

                             <!-- Settings button -->
                             <button @click="openSettingsPanel(); $nextTick(() => { isMobileSubMenuOpen = false })"
                                 class="p-2 transition-colors duration-200 rounded-full text-primary-lighter bg-primary-50 hover:text-primary hover:bg-primary-100 dark:hover:text-light dark:hover:bg-primary-dark dark:bg-dark focus:outline-none focus:bg-primary-100 dark:focus:bg-primary-dark focus:ring-primary-darker">
                                 <span class="sr-only">Open settings panel</span>
                                 <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                         d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                         d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                 </svg>
                             </button>
                         </div>

                         <!-- User avatar button -->
                         <div class="relative ml-auto" x-data="{ open: false }">
                             <button @click="open = !open; $nextTick(() => { if(open){ $refs.userMenu.focus() } })"
                                 type="button" aria-haspopup="true" :aria-expanded="open ? 'true' : 'false'"
                                 class="p-2 transition-colors duration-200 rounded-full text-primary-lighter bg-primary-50 hover:text-primary hover:bg-primary-100 dark:hover:text-light dark:hover:bg-primary-dark dark:bg-dark focus:outline-none focus:bg-primary-100 dark:focus:bg-primary-dark focus:ring-primary-darker">
                                 <span class="sr-only">User menu</span>
                                 <svg class="w-8 h-8 rounded-full dark:text-primary-light"
                                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor">
                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                         d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                 </svg>
                             </button>

                             <!-- User dropdown menu -->
                             <div x-show="open" x-transition:enter="transition-all transform ease-out"
                                 x-transition:enter-start="translate-y-1/2 opacity-0"
                                 x-transition:enter-end="translate-y-0 opacity-100"
                                 x-transition:leave="transition-all transform ease-in"
                                 x-transition:leave-start="translate-y-0 opacity-100"
                                 x-transition:leave-end="translate-y-1/2 opacity-0" @click.away="open = false"
                                 class="absolute right-0 w-48 py-1 origin-top-right bg-white rounded-md shadow-lg top-12 ring-1 ring-black ring-opacity-5 dark:bg-dark z-50"
                                 role="menu" aria-orientation="vertical" aria-label="User menu">
                                 <a href="#" role="menuitem"
                                     class="block px-4 py-2 text-sm text-gray-700 transition-colors hover:bg-gray-100 dark:text-light dark:hover:bg-primary">
                                     Your Profile
                                 </a>
                                 <a href="#" role="menuitem"
                                     class="block px-4 py-2 text-sm text-gray-700 transition-colors hover:bg-gray-100 dark:text-light dark:hover:bg-primary">
                                     Settings
                                 </a>
                                  <form action="{{ route('logout') }}" method="POST"
                                     class="block px-4 py-2 text-sm text-gray-700 transition-colors hover:bg-gray-100 dark:text-light dark:hover:bg-primary">
                                     @csrf
                                     <button type="submit" role="menuitem" class="w-full text-left">
                                         {{ __('Logout') }}
                                     </button>
                                 </form>
                             </div>
                         </div>
                     </nav>
                 </div>
                 <!-- Mobile main manu -->
                 <div class="border-b md:hidden dark:border-primary-darker" x-show="isMobileMainMenuOpen"
                     @click.away="isMobileMainMenuOpen = false">
                     <nav aria-label="Main" class="px-2 py-4 space-y-2">
                         <!-- Dashboards links -->
                         <div x-data="{ isActive: {{ Request::is('admin/dashboard') || Request::is('admin/dashboard/*') ? 'true' : 'false' }}, open: false }">
                             <a href="{{ route('admin.dashboard') }}"
                                 class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                                 :class="{ 'bg-primary-100 dark:bg-primary': isActive || open }" role="button"
                                 aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
                                 <span aria-hidden="true">
                                     <i class="bi bi-house-door w-5 h-5"></i> <!-- Bootstrap Icon for Dashboard -->
                                 </span>
                                 <span class="ml-2 text-sm"> {{ __('Dashboard') }} </span>
                             </a>
                         </div>

                         <!-- Product & Variation Management -->
                         <div x-data="{
                             isActive: {{ Request::is('admin/master/products*') || Request::is('admin/master/units*') || Request::is('admin/master/categories*') || Request::is('admin/master/materials*') || Request::is('admin/master/sizes*') || Request::is('admin/master/colors*') ? 'true' : 'false' }},
                             open: {{ Request::is('admin/master/products*') || Request::is('admin/master/units*') || Request::is('admin/master/categories*') || Request::is('admin/master/materials*') || Request::is('admin/master/sizes*') || Request::is('admin/master/colors*') ? 'true' : 'false' }}
                         }">
                             <a href="#" @click="$event.preventDefault(); open = !open"
                                 class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                                 :class="{ 'bg-primary-100 dark:bg-primary': isActive || open }" role="button"
                                 aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
                                 <span aria-hidden="true">
                                     <i class="bi bi-box w-5 h-5"></i> <!-- Bootstrap Icon for Products -->
                                 </span>
                                 <span class="ml-2 text-sm"> {{ __('Manajemen Produk & Variasi') }} </span>
                                 <span class="ml-auto" aria-hidden="true">
                                     <svg class="w-4 h-4 transition-transform transform" :class="{ 'rotate-180': open }"
                                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke="currentColor">
                                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                             d="M19 9l-7 7-7-7" />
                                     </svg>
                                 </span>
                             </a>
                             <div role="menu" x-show="open" class="mt-2 space-y-2 px-7">
                                 <!-- Dropdown for Multiple Categories (Category, Unit, etc.) -->
                                 <div x-data="{
                                     masterMenuOpen: {{ Request::is('admin/master/categories*') || Request::is('admin/master/units*') || Request::is('admin/master/materials*') || Request::is('admin/master/sizes*') || Request::is('admin/master/colors*') ? 'true' : 'false' }}
                                 }">
                                     <a href="#" @click="$event.preventDefault(); masterMenuOpen = !masterMenuOpen"
                                         class="flex items-center p-2 text-sm text-gray-700 transition-colors duration-200 rounded-md dark:text-light dark:hover:text-light hover:text-gray-700"
                                         :class="{ 'bg-primary-100 dark:bg-primary': masterMenuOpen }">
                                         {{ __('Manajemen Variasi') }}
                                         <span class="ml-auto" aria-hidden="true">
                                             <svg class="w-4 h-4 transition-transform transform"
                                                 :class="{ 'rotate-180': masterMenuOpen }"
                                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke="currentColor">
                                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                     d="M19 9l-7 7-7-7" />
                                             </svg>
                                         </span>
                                     </a>
                                     <div role="menu" x-show="masterMenuOpen" class="ml-4 space-y-2">
                                         <a href="{{ route('master.categories.index') }}"
                                             class="block p-2 text-sm text-gray-700 transition-colors duration-200 rounded-md dark:text-light dark:hover:text-light hover:text-gray-700"
                                             :class="{ 'text-primary-100 dark:text-primary': {{ Request::is('admin/master/categories*') ? 'true' : 'false' }} }">
                                             {{ __('Kategori') }}
                                         </a>
                                         <a href="{{ route('master.units.index') }}"
                                             class="block p-2 text-sm text-gray-700 transition-colors duration-200 rounded-md dark:text-light dark:hover:text-light hover:text-gray-700"
                                             :class="{ 'text-primary-100 dark:text-primary': {{ Request::is('admin/master/units*') ? 'true' : 'false' }} }">
                                             {{ __('Unit') }}
                                         </a>
                                         <a href="{{ route('master.materials.index') }}"
                                             class="block p-2 text-sm text-gray-700 transition-colors duration-200 rounded-md dark:text-light dark:hover:text-light hover:text-gray-700"
                                             :class="{ 'text-primary-100 dark:text-primary': {{ Request::is('admin/master/materials*') ? 'true' : 'false' }} }">
                                             {{ __('Material') }}
                                         </a>
                                         <a href="{{ route('master.sizes.index') }}"
                                             class="block p-2 text-sm text-gray-700 transition-colors duration-200 rounded-md dark:text-light dark:hover:text-light hover:text-gray-700"
                                             :class="{ 'text-primary-100 dark:text-primary': {{ Request::is('admin/master/sizes*') ? 'true' : 'false' }} }">
                                             {{ __('Ukuran') }}
                                         </a>
                                         <a href="{{ route('master.colors.index') }}"
                                             class="block p-2 text-sm text-gray-700 transition-colors duration-200 rounded-md dark:text-light dark:hover:text-light hover:text-gray-700"
                                             :class="{ 'text-primary-100 dark:text-primary': {{ Request::is('admin/master/colors*') ? 'true' : 'false' }} }">
                                             {{ __('Warna') }}
                                         </a>
                                     </div>
                                 </div>

                                 <!-- Dropdown for Product Management -->
                                 <a href="{{ route('master.products.index') }}"
                                     class="block p-2 text-sm text-gray-700 transition-colors duration-200 rounded-md dark:text-light dark:hover:text-light hover:text-gray-700"
                                     :class="{ 'text-primary-100 dark:text-primary': {{ Request::is('admin/master/products') ? 'true' : 'false' }} }">
                                     {{ __('Daftar Produk') }}
                                 </a>
                                 <a href="{{ route('master.products.create') }}"
                                     class="block p-2 text-sm text-gray-700 transition-colors duration-200 rounded-md dark:text-light dark:hover:text-light hover:text-gray-700"
                                     :class="{ 'text-primary-100 dark:text-primary': {{ Request::is('admin/master/products/create') ? 'true' : 'false' }} }">
                                     {{ __('Tambah Produk') }}
                                 </a>
                             </div>
                         </div>


                         <!-- Order Management -->
                         <div x-data="{ isActive: {{ Request::is('admin/orders*') ? 'true' : 'false' }}, open: {{ Request::is('admin/orders*') ? 'true' : 'false' }} }">
                             <a href="#" @click="$event.preventDefault(); open = !open"
                                 class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                                 :class="{ 'bg-primary-100 dark:bg-primary': isActive || open }" role="button"
                                 aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
                                 <span aria-hidden="true">
                                     <i class="bi bi-cart w-5 h-5"></i> <!-- Bootstrap Icon for Orders -->
                                 </span>
                                 <span class="ml-2 text-sm"> {{ __('Manajemen Pesanan') }} </span>
                                 <span class="ml-auto" aria-hidden="true">
                                     <svg class="w-4 h-4 transition-transform transform" :class="{ 'rotate-180': open }"
                                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke="currentColor">
                                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                             d="M19 9l-7 7-7-7" />
                                     </svg>
                                 </span>
                             </a>
                             <div role="menu" x-show="open" class="mt-2 space-y-2 px-7">
                                 <a href="#"
                                     class="block p-2 text-sm text-gray-700 transition-colors duration-200 rounded-md dark:text-light dark:hover:text-light hover:text-gray-700">{{ __('Daftar Pesanan') }}</a>
                                 <a href="#"
                                     class="block p-2 text-sm text-gray-700 transition-colors duration-200 rounded-md dark:text-light dark:hover:text-light hover:text-gray-700">{{ __('Tambah Pesanan') }}</a>
                             </div>
                         </div>

                         <!-- Banner Management -->
                         <div x-data="{ isActive: {{ Request::is('admin/master/banners*') ? 'true' : 'false' }}, open: {{ Request::is('admin/master/banners*') ? 'true' : 'false' }} }">
                             <a href="#" @click="$event.preventDefault(); open = !open"
                                 class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                                 :class="{ 'bg-primary-100 dark:bg-primary': isActive || open }" role="button"
                                 aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
                                 <span aria-hidden="true">
                                     <i class="bi bi-image w-5 h-5"></i> <!-- Bootstrap Icon for Banners -->
                                 </span>
                                 <span class="ml-2 text-sm"> {{ __('Manajemen Banner') }} </span>
                                 <span class="ml-auto" aria-hidden="true">
                                     <svg class="w-4 h-4 transition-transform transform" :class="{ 'rotate-180': open }"
                                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke="currentColor">
                                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                             d="M19 9l-7 7-7-7" />
                                     </svg>
                                 </span>
                             </a>
                             <div role="menu" x-show="open" class="mt-2 space-y-2 px-7">
                                 <a href="{{ route('master.banners.index') }}"
                                     class="block p-2 text-sm text-gray-700 transition-colors duration-200 rounded-md dark:text-light dark:hover:text-light hover:text-gray-700"
                                     :class="{ 'text-primary-100 dark:text-primary': {{ Request::is('admin/master/banners') ? 'true' : 'false' }} }">{{ __('Daftar Banner') }}</a>
                                 <a href="{{ route('master.banners.create') }}"
                                     class="block p-2 text-sm text-gray-700 transition-colors duration-200 rounded-md dark:text-light dark:hover:text-light hover:text-gray-700"
                                     :class="{ 'text-primary-100 dark:text-primary': {{ Request::is('admin/master/banners/create') ? 'true' : 'false' }} }">{{ __('Tambah Banner') }}</a>
                             </div>
                         </div>

                         @if (Auth::user()->role == 'superadmin')
                             <!-- User Management -->
                             <a href="{{ route('admin.users.index') }}"
                                 class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                                 :class="{ 'bg-primary-100 dark:bg-primary': {{ Request::is('admin/users') || Request::is('admin/users/*') ? 'true' : 'false' }} }"
                                 role="button" aria-haspopup="true"
                                 :aria-expanded="{{ Request::is('admin/users/*') ? 'true' : 'false' }}">
                                 <span aria-hidden="true">
                                     <i class="bi bi-person w-5 h-5"></i> <!-- Bootstrap Icon for Users -->
                                 </span>
                                 <span class="ml-2 text-sm"> {{ __('Manajemen Pengguna') }} </span>
                             </a>

                             <!-- Settings -->
                             <div x-data="{ isActive: {{ Request::is('admin/settings') || Request::is('admin/settings/*') ? 'true' : 'false' }}, open: {{ Request::is('admin/settings/*') ? 'true' : 'false' }} }">
                                 <a href="#" @click="$event.preventDefault(); open = !open"
                                     class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                                     :class="{ 'bg-primary-100 dark:bg-primary': isActive || open }" role="button"
                                     aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
                                     <span aria-hidden="true">
                                         <i class="bi bi-gear w-5 h-5"></i> <!-- Bootstrap Icon for Settings -->
                                     </span>
                                     <span class="ml-2 text-sm"> {{ __('Pengaturan Aplikasi') }} </span>
                                     <span class="ml-auto" aria-hidden="true">
                                         <svg class="w-4 h-4 transition-transform transform"
                                             :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg"
                                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                 d="M19 9l-7 7-7-7" />
                                         </svg>
                                     </span>
                                 </a>
                                 <div role="menu" x-show="open" class="mt-2 space-y-2 px-7">
                                     <a href="{{ route('admin.settings.edit') }}"
                                         class="block p-2 text-sm text-gray-700 transition-colors duration-200 rounded-md dark:text-light dark:hover:text-light hover:text-gray-700"
                                         :class="{ 'text-primary-100 dark:text-primary': {{ Request::is('admin/settings/general') ? 'true' : 'false' }} }">{{ __('Pengaturan Umum') }}</a>
                                     <a href="{{ route('admin.payment-methods.index') }}"
                                         class="block p-2 text-sm text-gray-700 transition-colors duration-200 rounded-md dark:text-light dark:hover:text-light hover:text-gray-700"
                                         :class="{ 'text-primary-100 dark:text-primary': {{ Request::is('admin/settings/payment-methods*') ? 'true' : 'false' }} }">{{ __('Metode Pembayaran') }}</a>
                                     <a href="{{ route('admin.shipping-methods.index') }}"
                                         class="block p-2 text-sm text-gray-700 transition-colors duration-200 rounded-md dark:text-light dark:hover:text-light hover:text-gray-700"
                                         :class="{ 'text-primary-100 dark:text-primary': {{ Request::is('admin/settings/shipping-methods*') ? 'true' : 'false' }} }">{{ __('Metode Ekspedisi') }}</a>
                                     <a href="{{ route('admin.socials.index') }}"
                                         class="block p-2 text-sm text-gray-700 transition-colors duration-200 rounded-md dark:text-light dark:hover:text-light hover:text-gray-700"
                                         :class="{ 'text-primary-100 dark:text-primary': {{ Request::is('admin/settings/socials*') ? 'true' : 'false' }} }">{{ __('Sosial Media') }}</a>
                                 </div>
                             </div>
                         @endif
                     </nav>
                 </div>
             </header>
         @endauth
