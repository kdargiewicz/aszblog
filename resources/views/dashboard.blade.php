@extends('cms-main')
@section('content')

    <div class="w3-row-padding w3-margin-bottom" style="padding-top:22px">
        <div class="w3-quarter">
            <div class="w3-container w3-red w3-padding-16">
                <div class="w3-left"><i class="fa fa-comment w3-xxxlarge"></i></div>
                <div class="w3-right">
                    <h3>{{ $articleCounter }}</h3>
                </div>
                <div class="w3-clear"></div>
                <h4>liczba wszystkich art</h4>
            </div>
        </div>
        <div class="w3-quarter">
            <div class="w3-container w3-blue w3-padding-16">
                <div class="w3-left"><i class="fa fa-eye w3-xxxlarge"></i></div>
                <div class="w3-right">
{{--                    <h3>99</h3>--}}
                    <h3>@if(isset($visitCounter)){{ $visitCounter }} @else 0 @endif</h3>
                </div>
                <div class="w3-clear"></div>
                <h4>liczba wszystkich odwiedzin, klikniej zeby szczegoly ogarnac</h4>
            </div>
        </div>
        <div class="w3-quarter">
            <div class="w3-container w3-teal w3-padding-16">
                <div class="w3-left"><i class="fa fa-share-alt w3-xxxlarge"></i></div>
                <div class="w3-right">
                    <h3>23</h3>
                </div>
                <div class="w3-clear"></div>
                <h4>liczba komentarzy</h4>
            </div>
        </div>
        <div class="w3-quarter">
            <div class="w3-container w3-orange w3-text-white w3-padding-16">
                <div class="w3-left"><i class="fa fa-users w3-xxxlarge"></i></div>
                <div class="w3-right">
                    <h3>50</h3>
                </div>
                <div class="w3-clear"></div>
                <h4>chuj wie</h4>
            </div>
        </div>
    </div>

    <div class="w3-panel">
        <div class="w3-row-padding" style="margin:0 -16px">
            <div class="w3-third">
                <h5>Regions</h5>
                <img src="https://www.w3schools.com/w3images/region.jpg" style="width:100%" alt="Google Regional Map">
            </div>
            <div class="w3-twothird">
                <h5>Feeds</h5>
                <table class="w3-table w3-striped w3-white">
                    <tr>
                        <td><i class="fa fa-user w3-text-blue w3-large"></i></td>
                        <td>New record, over 90 views.</td>
                        <td><i>10 mins</i></td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-bell w3-text-red w3-large"></i></td>
                        <td>Database error.</td>
                        <td><i>15 mins</i></td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-users w3-text-yellow w3-large"></i></td>
                        <td>New record, over 40 users.</td>
                        <td><i>17 mins</i></td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-comment w3-text-red w3-large"></i></td>
                        <td>New comments.</td>
                        <td><i>25 mins</i></td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-bookmark w3-text-blue w3-large"></i></td>
                        <td>Check transactions.</td>
                        <td><i>28 mins</i></td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-laptop w3-text-red w3-large"></i></td>
                        <td>CPU overload.</td>
                        <td><i>35 mins</i></td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-share-alt w3-text-green w3-large"></i></td>
                        <td>New shares.</td>
                        <td><i>39 mins</i></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <hr>

{{--    TEST CHARTS--}}
    <div class="w3-container">
        <h5>test charts</h5>
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

    <div class="w3-container">
        <h5>General Stats</h5>
        <p>New Visitors</p>
        <div class="w3-grey">
            <div class="w3-container w3-center w3-padding w3-green" style="width:25%">+25%</div>
        </div>

        <p>New Users</p>
        <div class="w3-grey">
            <div class="w3-container w3-center w3-padding w3-orange" style="width:50%">50%</div>
        </div>

        <p>Bounce Rate</p>
        <div class="w3-grey">
            <div class="w3-container w3-center w3-padding w3-red" style="width:75%">75%</div>
        </div>
    </div>
    <hr>

    <div class="w3-container">
        <h5>Countries</h5>
        <table class="w3-table w3-striped w3-bordered w3-border w3-hoverable w3-white">
            <tr>
                <td>United States</td>
                <td>65%</td>
            </tr>
            <tr>
                <td>UK</td>
                <td>15.7%</td>
            </tr>
            <tr>
                <td>Russia</td>
                <td>5.6%</td>
            </tr>
            <tr>
                <td>Spain</td>
                <td>2.1%</td>
            </tr>
            <tr>
                <td>India</td>
                <td>1.9%</td>
            </tr>
            <tr>
                <td>France</td>
                <td>1.5%</td>
            </tr>
        </table>
        <br>
        <button class="w3-button w3-dark-grey">More Countries  <i class="fa fa-arrow-right"></i></button>
    </div>
    <hr>
    <div class="w3-container">
        <h5>Recent Users</h5>
        <ul class="w3-ul w3-card-4 w3-white">
            <li class="w3-padding-16">
                <img src="https://www.w3schools.com/w3images/avatar2.png" class="w3-left w3-circle w3-margin-right"
                     style="width:35px">
                <span class="w3-xlarge">Mike</span><br>
            </li>
            <li class="w3-padding-16">
                <img src="https://www.w3schools.com/w3images/avatar5.png" class="w3-left w3-circle w3-margin-right"
                     style="width:35px">
                <span class="w3-xlarge">Jill</span><br>
            </li>
            <li class="w3-padding-16">
                <img src="https://www.w3schools.com/w3images/avatar6.png" class="w3-left w3-circle w3-margin-right"
                     style="width:35px">
                <span class="w3-xlarge">Jane</span><br>
            </li>
        </ul>
    </div>
    <hr>

    <div class="w3-container">
        <h5>Recent Comments</h5>
        <div class="w3-row">
            <div class="w3-col m2 text-center">
                <img class="w3-circle" src="https://www.w3schools.com/w3images/avatar3.png"
                     style="width:96px;height:96px">
            </div>
            <div class="w3-col m10 w3-container">
                <h4>John <span class="w3-opacity w3-medium">Sep 29, 2014, 9:12 PM</span></h4>
                <p>Keep up the GREAT work! I am cheering for you!! Lorem ipsum dolor sit amet, consectetur adipiscing
                    elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p><br>
            </div>
        </div>

        <div class="w3-row">
            <div class="w3-col m2 text-center">
                <img class="w3-circle" src="https://www.w3schools.com/w3images/avatar1.png"
                     style="width:96px;height:96px">
            </div>
            <div class="w3-col m10 w3-container">
                <h4>Bo <span class="w3-opacity w3-medium">Sep 28, 2014, 10:15 PM</span></h4>
                <p>Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p><br>
            </div>
        </div>
    </div>
    <br>
    <div class="w3-container w3-dark-grey w3-padding-32">
        <div class="w3-row">
            <div class="w3-container w3-third">
                <h5 class="w3-bottombar w3-border-green">Demographic</h5>
                <p>Language</p>
                <p>Country</p>
                <p>City</p>
            </div>
            <div class="w3-container w3-third">
                <h5 class="w3-bottombar w3-border-red">System</h5>
                <p>Browser</p>
                <p>OS</p>
                <p>More</p>
            </div>
            <div class="w3-container w3-third">
                <h5 class="w3-bottombar w3-border-orange">Target</h5>
                <p>Users</p>
                <p>Active</p>
                <p>Geo</p>
                <p>Interests</p>
            </div>
        </div>
    </div>

{{----------------------------}}
    {{----------------------------}}
    {{----------------------------}}
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
