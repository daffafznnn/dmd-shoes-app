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
    @push('scripts')
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
    @endpush