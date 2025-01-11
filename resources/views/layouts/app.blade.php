@php
    $settings = \App\Models\Setting::first();
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta property="og:title" content="{{ $settings->name ?? config('app.name', 'Laravel') }}" />
    <meta property="og:description" content="{{ $settings->description ?? '' }}" />
    <meta property="og:image" content="{{ asset('storage/' . $settings->logo ?? '') }}" />
    <meta property="og:url" content="{{ url('/') }}" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="{{ $settings->name ?? config('app.name', 'Laravel') }}" />
    <meta name="twitter:description" content="{{ $settings->description ?? '' }}" />
    <meta name="twitter:image" content="{{ asset('storage/' . $settings->logo ?? '') }}" />

    <link rel="shortcut icon" href="{{ asset('storage/' . $settings->favicon ?? '') }}" type="image/x-icon">

    <title>{{ $settings->name ?? config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="{{ asset('css/tailwind.css') }}">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])   
    @stack('styles')
    @livewireStyles
</head>

<body class="font-sans antialiased">

    @if(!$settings->is_maintenance)
        <div x-data="setup()" x-init="$refs.loading.classList.add('hidden');
        setColors(color);" :class="{ 'dark': isDark }">
            <div class="flex h-screen antialiased text-gray-900 bg-gray-100 dark:bg-dark dark:text-light">
                <x-loading-screen ref="loading" />
                <!-- Sidebar -->
                <x-sidebar />

                <div class="flex-1 h-full overflow-x-hidden overflow-y-auto">
                    <!-- Page Heading -->
                    <x-header />

                    <!-- Page Content -->
                    <main>
                        {{ $slot }}
                    </main>
                    <!-- Main footer -->
                    {{-- <x-footer /> --}}
                </div>
                <!-- Panels -->
                <x-settings-panel />
                <x-notification-panel />
                <x-search-panel />
            </div>
        </div>
    @else
        <x-maintenance />
    @endif
    @stack('scripts')
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
    <script>
        const setup = () => {
            const getTheme = () => {
                if (window.localStorage.getItem('dark')) {
                    return JSON.parse(window.localStorage.getItem('dark'))
                }

                return !!window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches
            }

            const setTheme = (value) => {
                window.localStorage.setItem('dark', value)
            }

            const getColor = () => {
                if (window.localStorage.getItem('color')) {
                    return window.localStorage.getItem('color')
                }
                return 'cyan'
            }

            const setColors = (color) => {
                const root = document.documentElement
                root.style.setProperty('--color-primary', `var(--color-${color})`)
                root.style.setProperty('--color-primary-50', `var(--color-${color}-50)`)
                root.style.setProperty('--color-primary-100', `var(--color-${color}-100)`)
                root.style.setProperty('--color-primary-light', `var(--color-${color}-light)`)
                root.style.setProperty('--color-primary-lighter', `var(--color-${color}-lighter)`)
                root.style.setProperty('--color-primary-dark', `var(--color-${color}-dark)`)
                root.style.setProperty('--color-primary-darker', `var(--color-${color}-darker)`)
                this.selectedColor = color
                window.localStorage.setItem('color', color)
                //
            }

            const updateBarChart = (on) => {
                const data = {
                    data: randomData(),
                    backgroundColor: 'rgb(207, 250, 254)',
                }
                if (on) {
                    barChart.data.datasets.push(data)
                    barChart.update()
                } else {
                    barChart.data.datasets.splice(1)
                    barChart.update()
                }
            }

            const updateDoughnutChart = (on) => {
                const data = random()
                const color = 'rgb(207, 250, 254)'
                if (on) {
                    doughnutChart.data.labels.unshift('Seb')
                    doughnutChart.data.datasets[0].data.unshift(data)
                    doughnutChart.data.datasets[0].backgroundColor.unshift(color)
                    doughnutChart.update()
                } else {
                    doughnutChart.data.labels.splice(0, 1)
                    doughnutChart.data.datasets[0].data.splice(0, 1)
                    doughnutChart.data.datasets[0].backgroundColor.splice(0, 1)
                    doughnutChart.update()
                }
            }

            const updateLineChart = () => {
                lineChart.data.datasets[0].data.reverse()
                lineChart.update()
            }

            return {
                loading: true,
                isDark: getTheme(),
                toggleTheme() {
                    this.isDark = !this.isDark
                    setTheme(this.isDark)
                },
                setLightTheme() {
                    this.isDark = false
                    setTheme(this.isDark)
                },
                setDarkTheme() {
                    this.isDark = true
                    setTheme(this.isDark)
                },
                color: getColor(),
                selectedColor: 'cyan',
                setColors,
                toggleSidbarMenu() {
                    this.isSidebarOpen = !this.isSidebarOpen
                },
                isSettingsPanelOpen: false,
                openSettingsPanel() {
                    this.isSettingsPanelOpen = true
                    this.$nextTick(() => {
                        this.$refs.settingsPanel.focus()
                    })
                },
                isNotificationsPanelOpen: false,
                openNotificationsPanel() {
                    this.isNotificationsPanelOpen = true
                    this.$nextTick(() => {
                        this.$refs.notificationsPanel.focus()
                    })
                },
                isSearchPanelOpen: false,
                openSearchPanel() {
                    this.isSearchPanelOpen = true
                    this.$nextTick(() => {
                        this.$refs.searchInput.focus()
                    })
                },
                isMobileSubMenuOpen: false,
                openMobileSubMenu() {
                    this.isMobileSubMenuOpen = true
                    this.$nextTick(() => {
                        this.$refs.mobileSubMenu.focus()
                    })
                },
                isMobileMainMenuOpen: false,
                openMobileMainMenu() {
                    this.isMobileMainMenuOpen = true
                    this.$nextTick(() => {
                        this.$refs.mobileMainMenu.focus()
                    })
                },
                updateBarChart,
                updateDoughnutChart,
                updateLineChart,
            }
        }
    </script>
    @livewireScripts
</body>

</html>

