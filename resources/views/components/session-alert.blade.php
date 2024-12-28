@if (session('success') || session('error'))
    <div id="session-alert" class="fixed top-4 right-4 z-50 opacity-0 transition-opacity duration-500">
        @if (session('success'))
            <div class="alert alert-success shadow-lg mb-4">
                <div class="flex items-center justify-between w-full">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="ml-2">{{ session('success') }}</span>
                    </div>
                    <button type="button" class="btn btn-sm btn-ghost ml-4" onclick="closeAlert()">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-1.5 mt-2">
                    <div id="progress-bar" class="bg-green-500 h-1.5 rounded-full transition-all duration-[5000ms]"></div>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-error shadow-lg">
                <div class="flex items-center justify-between w-full">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        <span class="ml-2">{{ session('error') }}</span>
                    </div>
                    <button type="button" class="btn btn-sm btn-ghost ml-4" onclick="closeAlert()">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-1.5 mt-2">
                    <div id="progress-bar" class="bg-red-500 h-1.5 rounded-full transition-all duration-[5000ms]"></div>
                </div>
            </div>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const alertElement = document.getElementById('session-alert');
            const progressBar = document.getElementById('progress-bar');

            // Fade in animation
            alertElement.classList.add('opacity-100');

            // Start progress bar animation
            progressBar.style.width = '100%';

            // Close alert after 5 seconds
            setTimeout(() => {
                fadeOut(alertElement);
            }, 5000);
        });

        // Fade out animation
        function fadeOut(element) {
            element.classList.remove('opacity-100');
            element.classList.add('opacity-0');
            setTimeout(() => {
                element.remove();
            }, 500); // Match the duration of transition-opacity
        }

        // Close alert manually
        function closeAlert() {
            const alertElement = document.getElementById('session-alert');
            fadeOut(alertElement);
        }
    </script>
@endif
