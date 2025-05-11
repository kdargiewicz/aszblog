@extends('cms-main')
@section('content')

    <div class="w3-row-padding w3-margin-top">

        <div class="w3-quarter">
            <div class="w3-container w3-red w3-padding-16" style="height: 100%; min-height: 170px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); filter: brightness(90%);">
                <div class="w3-row">
                    <div class="w3-col s4">
                        <i class="fa fa-comment w3-xxxlarge"></i>
                    </div>
                    <div class="w3-col s8 w3-right-align">
                        <h3>{{ $articleCounter }}</h3>
                    </div>
                </div>
                <div class="w3-clear"></div>
                <p>liczba wszystkich art</p>
            </div>
        </div>

        <div class="w3-quarter">
            <div class="w3-container w3-blue w3-padding-16" style="height: 100%; min-height: 170px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); filter: brightness(90%);">
                <div class="w3-row">
                    <div class="w3-col s4">
                        <i class="fa fa-eye w3-xxxlarge"></i>
                    </div>
                    <div class="w3-col s8 w3-right-align">
                        <h3>{{ $visitCounter ?? 0 }}</h3>
                    </div>
                </div>
                <div class="w3-clear"></div>
                <p>liczba wszystkich odwiedzin</p>
            </div>
        </div>

        <div class="w3-quarter">
            <div class="w3-container w3-teal w3-padding-16" style="height: 100%; min-height: 170px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); filter: brightness(90%);">
                <div class="w3-row">
                    <div class="w3-col s4">
                        <i class="fa fa-share-alt w3-xxxlarge"></i>
                    </div>
                    <div class="w3-col s8 w3-right-align">
                        <h3>{{ $commentCount ?? 0 }}</h3>
                    </div>
                </div>
                <div class="w3-clear"></div>
                <p>liczba komentarzy</p>
            </div>
        </div>

        <div class="w3-quarter">
            <div class="w3-container w3-orange w3-padding-16" style="height: 100%; min-height: 170px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); filter: brightness(90%);">
                <div class="w3-row">
                    <div class="w3-col s4">
                        <i class="fa fa-users w3-xxxlarge"></i>
                    </div>
                    <div class="w3-col s8 w3-right-align">
                        <h3>{{ $userCount ?? 0 }}</h3>
                    </div>
                </div>
                <div class="w3-clear"></div>
                <p>aktywni użytkownicy</p>
            </div>
        </div>

    </div>

{{--    TEST CHARTS--}}
    <div class="w3-container">
        <div class="w3-container w3-light-grey w3-margin">
            <h2 class="w3-text-dark-grey w3-serif">Statystyki odwiedzin</h2>
            <canvas id="visitsChart" style="max-height: 400px;"></canvas>
        </div>

        <div class="w3-container w3-light-grey w3-margin">
            <h3 class="w3-margin-top">Najczęściej używane przeglądarki</h3>
            <canvas id="browserChart" style="max-height: 220px;"></canvas>
        </div>

        <div class="w3-container w3-light-grey w3-margin">
            <h3 class="w3-margin-top">Aktywność w dniach tygodnia</h3>
            <canvas id="radarChart" style="max-height: 350px;"></canvas>
        </div>

        <div class="w3-container w3-light-grey w3-margin">
            <h3 class="w3-margin-top">Typ odwiedzanego zasobu</h3>
            <canvas id="typeChart" style="max-height: 300px;"></canvas>
        </div>

        <div class="w3-container w3-light-grey w3-margin">
            <h3 class="w3-margin-top">Najczęściej odwiedzane zasoby (URL)</h3>
            <canvas id="urlDoughnutChart" style="max-height: 300px;"></canvas>
        </div>

        <div class="w3-container w3-light-grey w3-margin">
            <h3 class="w3-margin-top">Porównanie odwiedzin URL-i (gwiaździsty)</h3>
            <canvas id="urlRadarChart" style="max-height: 350px;"></canvas>
        </div>

        <div class="w3-container w3-light-grey w3-margin">
            <h3 class="w3-margin-top">Radar: porównanie przeglądarek dla najczęstszych URL-i</h3>
            <canvas id="multiRadarChart" style="max-height: 400px;"></canvas>
        </div>

    </div>
{{--    END TEST CHARTS--}}


{{--    KOD DO CHARTS--}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('visitsChart').getContext('2d');
        const visitsChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($dailyVisits->pluck('date')->values()) !!},
                datasets: [{
                    label: 'Odwiedziny dziennie',
                    data: {!! json_encode($dailyVisits->pluck('total')->values()) !!},
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    fill: true,
                    tension: 0.3,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Liczba odwiedzin'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Data'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return ' ' + context.parsed.y + ' odwiedzin';
                            }
                        }
                    }
                }
            }
        });

        //kolejny chart - przegladarki
        const browserCtx = document.getElementById('browserChart').getContext('2d');

        const browserLabels = {!! json_encode($browserStats->pluck('browser')) !!};
        const browserData = {!! json_encode($browserStats->pluck('total')) !!};

        const browserColors = {
            'Chrome': 'rgba(54, 162, 235, 0.6)',
            'Firefox': 'rgba(255, 99, 132, 0.6)',
            'Safari': 'rgba(255, 206, 86, 0.6)',
            'Edge': 'rgba(153, 102, 255, 0.6)',
            'Brave': 'rgba(75, 192, 192, 0.6)',
            'Opera': 'rgba(255, 159, 64, 0.6)',
            'Other': 'rgba(201, 203, 207, 0.6)'
        };

        const resolvedColors = browserLabels.map(label => browserColors[label] ?? browserColors['Other']);

        new Chart(browserCtx, {
            type: 'bar',
            data: {
                labels: browserLabels,
                datasets: [{
                    label: 'Liczba odwiedzin',
                    data: browserData,
                    backgroundColor: resolvedColors,
                    borderColor: resolvedColors.map(c => c.replace('0.6', '1')),
                    borderWidth: 1,
                    barThickness: 12
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                animation: {
                    duration: 1000,
                    easing: 'easeOutQuart'
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });

        //wykres radarowy
        const radarCtx = document.getElementById('radarChart').getContext('2d');
        new Chart(radarCtx, {
            type: 'radar',
            data: {
                labels: {!! json_encode($weekdayStats->pluck('day')) !!},
                datasets: [{
                    label: 'Odwiedziny',
                    data: {!! json_encode($weekdayStats->pluck('total')) !!},
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    pointBackgroundColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                scales: {
                    r: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        position: 'top'
                    }
                }
            }
        });

        //wykres kolowy
        const typeCtx = document.getElementById('typeChart').getContext('2d');
        new Chart(typeCtx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($typeStats->pluck('type')) !!},
                datasets: [{
                    data: {!! json_encode($typeStats->pluck('total')) !!},
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(153, 102, 255, 0.6)',
                        'rgba(255, 159, 64, 0.6)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'right'
                    }
                }
            }
        });

        //wykres url
        const urlDoughnutCtx = document.getElementById('urlDoughnutChart').getContext('2d');

        new Chart(urlDoughnutCtx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($urlStats->pluck('url')) !!},
                datasets: [{
                    data: {!! json_encode($urlStats->pluck('total')) !!},
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(153, 102, 255, 0.6)',
                        'rgba(255, 159, 64, 0.6)',
                        'rgba(201, 203, 207, 0.6)',
                        'rgba(255, 99, 255, 0.6)',
                        'rgba(64, 159, 255, 0.6)',
                        'rgba(128, 128, 128, 0.6)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'right'
                    }
                }
            }
        });

        //wykres url radarowy
        const urlRadarCtx = document.getElementById('urlRadarChart').getContext('2d');

        new Chart(urlRadarCtx, {
            type: 'radar',
            data: {
                labels: {!! json_encode($urlStats->pluck('url')) !!},
                datasets: [{
                    label: 'Odwiedziny',
                    data: {!! json_encode($urlStats->pluck('total')) !!},
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    pointBackgroundColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                scales: {
                    r: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        position: 'top'
                    }
                }
            }
        });

        //radar - przyklad wielu dataset
        const multiRadarCtx = document.getElementById('multiRadarChart').getContext('2d');

        const urlLabels = {!! json_encode($topUrls) !!};
        const browserStats = {!! json_encode($browserStatsByUrl) !!};

        // kolor dla przeglądarki
        const multiRadarCtxBrowserColors = {
            'Chrome': 'rgba(255, 99, 132, ',
            'Firefox': 'rgba(54, 162, 235, ',
            'Safari': 'rgba(255, 206, 86, ',
            'Edge': 'rgba(153, 102, 255, ',
            'Brave': 'rgba(75, 192, 192, ',
            'Opera': 'rgba(255, 159, 64, ',
            'Other': 'rgba(201, 203, 207, '
        };

        const datasets = Object.entries(browserStats).map(([browser, entries]) => {
            const color = multiRadarCtxBrowserColors[browser] || multiRadarCtxBrowserColors['Other'];
            const data = urlLabels.map(url => {
                const match = entries.find(e => e.url === url);
                return match ? parseInt(match.total) : 0;
            });

            return {
                label: browser,
                data: data,
                backgroundColor: color + '0.2)',
                borderColor: color + '1)',
                pointBackgroundColor: color + '1)',
                borderWidth: 2
            };
        });

        new Chart(multiRadarCtx, {
            type: 'radar',
            data: {
                labels: urlLabels,
                datasets: datasets
            },
            options: {
                responsive: true,
                scales: {
                    r: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        position: 'top'
                    }
                }
            }
        });
    </script>


@endsection
