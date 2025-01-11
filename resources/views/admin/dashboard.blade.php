<x-app-layout>
    <!-- Content header -->
    <div class="flex items-center justify-between px-4 py-4 border-b lg:py-6 dark:border-primary-darker">
        <h1 class="text-2xl font-semibold">Dashboard</h1>
    </div>

    <!-- Content -->
    <div class="mt-2">
        <!-- State cards -->
        <div class="grid grid-cols-1 gap-8 p-4 lg:grid-cols-2 xl:grid-cols-4">
            <!-- Value card -->
            <div class="flex items-center justify-between p-4 bg-white rounded-md dark:bg-darker">
                <div>
                    <h6
                        class="text-xs font-medium leading-none tracking-wider text-gray-500 uppercase dark:text-primary-light">
                        {{ __('Pendapatan') }}
                    </h6>
                    <span
                        class="text-xl font-semibold">{{ \NumberFormatter::create('id_ID', \NumberFormatter::CURRENCY)->format($totalValue) }}</span>
                </div>
                <div>
                    <span>
                        <svg class="w-12 h-12 text-gray-300 dark:text-primary-dark" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </span>
                </div>
            </div>

            <!-- Users card -->
            <div class="flex items-center justify-between p-4 bg-white rounded-md dark:bg-darker">
                <div>
                    <h6
                        class="text-xs font-medium leading-none tracking-wider text-gray-500 uppercase dark:text-primary-light">
                        {{ __('Pengguna') }}
                    </h6>
                    <span class="text-xl font-semibold">{{ $totalUsers }}</span>
                </div>
                <div>
                    <span>
                        <svg class="w-12 h-12 text-gray-300 dark:text-primary-dark" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </span>
                </div>
            </div>

            <!-- Orders card -->
            <div class="flex items-center justify-between p-4 bg-white rounded-md dark:bg-darker">
                <div>
                    <h6
                        class="text-xs font-medium leading-none tracking-wider text-gray-500 uppercase dark:text-primary-light">
                        {{ __('Pesanan') }}
                    </h6>
                    <span class="text-xl font-semibold">{{ $totalOrders }}</span>
                </div>
                <div>
                    <span>
                        <svg class="w-12 h-12 text-gray-300 dark:text-primary-dark" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </span>
                </div>
            </div>

            <!-- Tickets card -->
            <div class="flex items-center justify-between p-4 bg-white rounded-md dark:bg-darker">
                <div>
                    <h6
                        class="text-xs font-medium leading-none tracking-wider text-gray-500 uppercase dark:text-primary-light">
                        {{ __('Product') }}
                    </h6>
                    <span class="text-xl font-semibold">{{ $totalProducts }}</span>
                </div>
                <div>
                    <span>
                        <svg class="w-12 h-12 text-gray-300 dark:text-primary-dark" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </span>
                </div>
            </div>
        </div>

        <!-- Charts -->
        <div class="grid grid-cols-1 p-4 space-y-8 lg:gap-8 lg:space-y-0 lg:grid-cols-3">
            <!-- Bar chart -->
            <div class="col-span-2 bg-white rounded-md dark:bg-darker">
                <div class="p-4 border-b dark:border-primary">
                    <h4 class="text-lg font-semibold text-gray-500 dark:text-light">Bar Chart</h4>
                </div>
                <div class="relative p-4 h-72">
                    <canvas id="barChart"></canvas>
                </div>
            </div>

            <!-- Doughnut chart -->
            <div class="bg-white rounded-md dark:bg-darker">
                <div class="p-4 border-b dark:border-primary">
                    <h4 class="text-lg font-semibold text-gray-500 dark:text-light">Doughnut Chart</h4>
                </div>
                <div class="relative p-4 h-72">
                    <canvas id="doughnutChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Data dari backend (pastikan data ini dinamis)
            const barChartData = @json($barChartData);
            const doughnutChartData = @json($doughnutChartData);

            // Bar Chart
            const ctxBarChart = document.getElementById('barChart').getContext('2d');
            new Chart(ctxBarChart, {
                type: 'bar',
                data: {
                    labels: barChartData.labels,
                    datasets: [{
                        label: barChartData.label,
                        data: barChartData.data,
                        backgroundColor: barChartData.backgroundColor,
                        borderColor: barChartData.borderColor,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });


            // Doughnut Chart
            // Doughnut Chart
            const ctxDoughnutChart = document.getElementById('doughnutChart').getContext('2d');
            new Chart(ctxDoughnutChart, {
                type: 'doughnut',
                data: {
                    labels: doughnutChartData.labels,
                    datasets: [{
                        label: doughnutChartData.label,
                        data: doughnutChartData.data,
                        backgroundColor: doughnutChartData.backgroundColor,
                        borderColor: doughnutChartData.borderColor,
                        borderWidth: 1
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            display: true
                        }
                    }
                }
            });

        });
    </script>
</x-app-layout>
