        <!-- Search panel -->
        <!-- Backdrop -->
        <div
          x-transition:enter="transition duration-300 ease-in-out"
          x-transition:enter-start="opacity-0"
          x-transition:enter-end="opacity-100"
          x-transition:leave="transition duration-300 ease-in-out"
          x-transition:leave-start="opacity-100"
          x-transition:leave-end="opacity-0"
          x-show="isSearchPanelOpen"
          @click="isSearchPanelOpen = false"
          class="fixed inset-0 z-10 bg-primary-darker"
          style="opacity: 0.5"
          aria-hidden="ture"
        ></div>
        <!-- Panel -->
        <section
          x-transition:enter="transition duration-300 ease-in-out transform sm:duration-500"
          x-transition:enter-start="-translate-x-full"
          x-transition:enter-end="translate-x-0"
          x-transition:leave="transition duration-300 ease-in-out transform sm:duration-500"
          x-transition:leave-start="translate-x-0"
          x-transition:leave-end="-translate-x-full"
          x-show="isSearchPanelOpen"
          @keydown.escape="isSearchPanelOpen = false"
          class="fixed inset-y-0 z-20 w-full max-w-xs bg-white shadow-xl dark:bg-darker dark:text-light sm:max-w-md focus:outline-none"
        >
          <div class="absolute right-0 p-2 transform translate-x-full">
            <!-- Close button -->
            <button @click="isSearchPanelOpen = false" class="p-2 text-white rounded-md focus:outline-none focus:ring">
              <svg
                class="w-5 h-5"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>

          <h2 class="sr-only">Search panel</h2>
          <!-- Panel content -->
          <div class="flex flex-col h-screen">
            <!-- Panel header (Search input) -->
            <div
              class="relative flex-shrink-0 px-4 py-8 text-gray-400 border-b dark:border-primary-darker dark:focus-within:text-light focus-within:text-gray-700"
            >
              <span class="absolute inset-y-0 inline-flex items-center px-4">
                <svg
                  class="w-5 h-5"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                  />
                </svg>
              </span>
              <input
                x-ref="searchInput"
                type="text"
                class="w-full py-2 pl-10 pr-4 border rounded-full dark:bg-dark dark:border-transparent dark:text-light focus:outline-none focus:ring"
                placeholder="Search..."
              />
            </div>

            <!-- Panel content (Search result) -->
            <div class="flex-1 px-4 pb-4 space-y-4 overflow-y-hidden h hover:overflow-y-auto">
              <h3 class="py-2 text-sm font-semibold text-gray-600 dark:text-light">History</h3>
              <a href="#" class="flex space-x-4">
                <div class="flex-shrink-0">
                  <img class="w-10 h-10 rounded-lg" src="build/images/cover.jpg" alt="Post cover" />
                </div>
                <div class="flex-1 max-w-xs overflow-hidden">
                  <h4 class="text-sm font-semibold text-gray-600 dark:text-light">Header</h4>
                  <p class="text-sm font-normal text-gray-400 truncate dark:text-primary-lighter">
                    Lorem ipsum dolor, sit amet consectetur.
                  </p>
                  <span class="text-sm font-normal text-gray-400 dark:text-primary-light"> Post </span>
                </div>
              </a>
              <a href="#" class="flex space-x-4">
                <div class="flex-shrink-0">
                  <img class="w-10 h-10 rounded-lg" src="build/images/avatar.jpg" alt="Ahmed Kamel" />
                </div>
                <div class="flex-1 max-w-xs overflow-hidden">
                  <h4 class="text-sm font-semibold text-gray-600 dark:text-light">Ahmed Kamel</h4>
                  <p class="text-sm font-normal text-gray-400 truncate dark:text-primary-lighter">
                    Last activity 3h ago.
                  </p>
                  <span class="text-sm font-normal text-gray-400 dark:text-primary-light"> Offline </span>
                </div>
              </a>
              <a href="#" class="flex space-x-4">
                <div class="flex-shrink-0">
                  <img class="w-10 h-10 rounded-lg" src="build/images/cover-2.jpg" alt="K-WD Dashboard" />
                </div>
                <div class="flex-1 max-w-xs overflow-hidden">
                  <h4 class="text-sm font-semibold text-gray-600 dark:text-light">K-WD Dashboard</h4>
                  <p class="text-sm font-normal text-gray-400 truncate dark:text-primary-lighter">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                  </p>
                  <span class="text-sm font-normal text-gray-400 dark:text-primary-light"> Updated 3h ago. </span>
                </div>
              </a>
              <template x-for="i in 10" x-key="i">
                <a href="#" class="flex space-x-4">
                  <div class="flex-shrink-0">
                    <img class="w-10 h-10 rounded-lg" src="build/images/cover-3.jpg" alt="K-WD Dashboard" />
                  </div>
                  <div class="flex-1 max-w-xs overflow-hidden">
                    <h4 class="text-sm font-semibold text-gray-600 dark:text-light">K-WD Dashboard</h4>
                    <p class="text-sm font-normal text-gray-400 truncate dark:text-primary-lighter">
                      Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                    </p>
                    <span class="text-sm font-normal text-gray-400 dark:text-primary-light"> Updated 3h ago. </span>
                  </div>
                </a>
              </template>
            </div>
          </div>
        </section>