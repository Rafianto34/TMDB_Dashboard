<!DOCTYPE html>
<html>
<head>
    <title>CineDash Analytics</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Flatpickr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


 <style>
        body { background-color: #f5f6fa; font-family: 'Segoe UI', sans-serif; }

        /* Sidebar */
        .sidebar { height: 100vh; background: #ffffff; border-right: 1px solid #e5e7eb; }
        .sidebar h4 { font-weight: 600; color: #e11d48; }
        .sidebar a { color: #6b7280; text-decoration: none; padding: 10px 15px; border-radius: 10px; display: block; margin-bottom: 5px; transition: 0.2s; }
        .sidebar a:hover, .sidebar a.active { background-color: #ffe4e6; color: #e11d48; }

        /* Topbar */
        .topbar { background: linear-gradient(90deg, #fb7185, #e11d48); padding: 18px 25px; border-radius: 15px; color: white; margin-bottom: 25px; }

        /* Card */
        .card-custom { border: none; border-radius: 18px; box-shadow: 0 6px 25px rgba(0,0,0,0.05); padding: 20px; background: white; transition: 0.2s; }
        .card-custom:hover { transform: translateY(-3px); }
        .card-title-small { font-size: 14px; color: #9ca3af; }
        .card-value { font-size: 26px; font-weight: 600; color: #111827; }

        /* Buttons */
        .btn-red {   background: #e11d48;
    border: 1px solid #e11d48;
    color: #ffffffff;
    border-radius: 10px;
    padding: 8px 18px;
    text-decoration: none;
    transition: 0.2s; }
        .btn-red:hover {  background: #ffe4e6;
    color: #be123c;}

        /* Date input */
        .date-input {
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            padding: 8px 14px;
            height: 40px;
            transition: 0.2s;
        }
        .date-input:focus {
            border-color: #e11d48;
            box-shadow: 0 0 0 3px rgba(225,29,72,0.15);
        }

       /* ===== Flatpickr Custom Clean Pink Theme ===== */
.btn-reset {
    background: #991b1b;
    color: white;
    border-radius: 10px;
    padding: 8px 18px;
    text-decoration: none;
    transition: 0.2s;
}

.btn-reset:hover {
    background: #7f1d1d;
    color: white;
}


/* Calendar container */
.flatpickr-calendar {
    border-radius: 18px !important;
    box-shadow: 0 15px 40px rgba(225, 29, 72, 0.18) !important;
    border: none !important;
    font-family: 'Segoe UI', sans-serif !important;
}

/* Header (bulan + tahun area) */
.flatpickr-months {
    background: linear-gradient(90deg, #fb7185, #e11d48) !important;
    border-radius: 18px 18px 0 0 !important;
}

/* Month & year text */
.flatpickr-current-month {
    color: #ffffff !important;
}

.flatpickr-current-month .cur-month {
    color: #ffffff !important;
    font-weight: 600 !important;
}

.flatpickr-current-month input.cur-year {
    color: #ffffff !important;
    font-weight: 600 !important;
}


.flatpickr-current-month .flatpickr-monthDropdown-months {
    background: rgba(255, 255, 255, 0.15) !important;
    color: white !important;
    font-weight: 600 !important;
    padding: 0 10px !important;
    border-radius: 8px !important;
    border: 1px solid rgba(255, 255, 255, 0.3) !important;
    transition: all 0.2s !important;
    margin: 0 5px !important;
    height: 30px !important;
    cursor: pointer !important;
}
.flatpickr-current-month .flatpickr-monthDropdown-months:hover {
    background: rgba(255, 255, 255, 0.3) !important;
    border-color: rgba(255, 255, 255, 0.5) !important;
}
/* Ensure options are visible and have contrast */
.flatpickr-current-month .flatpickr-monthDropdown-month {
    background-color: #ffffff !important; 
    color: #111827 !important;
}

/* Year Input Styling */
.flatpickr-current-month input.cur-year {
    font-weight: 600;
}

.flatpickr-current-month .numInputWrapper span.arrowUp:after {
    border-bottom-color: white;
}

.flatpickr-current-month .numInputWrapper span.arrowDown:after {
    border-top-color: white;
}



.flatpickr-weekday {
    color: #e11d48 !important;
    font-weight: 600 !important;
}



.flatpickr-day {
    border-radius: 10px !important;
}

.flatpickr-day:hover {
    background: #ffe4e6 !important;
    color: #e11d48 !important;
}

.flatpickr-day.selected,
.flatpickr-day.startRange,
.flatpickr-day.endRange {
    background: #e11d48 !important;
    border-color: #e11d48 !important;
    color: #ffffff !important;
}

.flatpickr-day.today {
    border: 2px solid #e11d48 !important;
}



.flatpickr-prev-month svg,
.flatpickr-next-month svg {
    fill: #ffffff !important;
}


        h6 { font-weight: 600; }

        /* Modal Styling */
        .modal-content { border-radius: 20px; border: none; box-shadow: 0 10px 40px rgba(0,0,0,0.1); }
        .modal-header { border-bottom: none; padding: 25px 25px 10px; }
        .modal-body { padding: 25px; }
        .detail-image { border-radius: 15px; width: 100%; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
        
        tr.clickable-row { cursor: pointer; transition: 0.2s; }
        tr.clickable-row:hover { background-color: #fff1f2 !important; }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2 sidebar p-4">
            <h4 class="text-center mb-3">CineDash</h4>
            <hr style="margin-top: 0;">
            <a href="{{ route('dashboard') }}" class="active">Dashboard</a>
            <a href="{{ route('movies.index') }}">Movies</a>
            <a href="{{ route('tv_shows.index') }}">TV Shows</a>
            <a href="{{ route('people.index') }}">People</a>
        </div>

        <!-- Main -->
        <div class="col-md-10 p-4">
            <!-- Topbar -->
            <div class="topbar d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Dashboard Analytics</h4>
                <div class="d-flex gap-2 align-items-center">
                    <form method="GET" action="{{ route('dashboard') }}" class="d-flex gap-2 filter-box align-items-center">
    
    <input type="text" id="start_date" name="start_date"
        value="{{ request('start_date') }}"
        class="form-control date-input"
        placeholder="Start Date">

    <input type="text" id="end_date" name="end_date"
        value="{{ request('end_date') }}"
        class="form-control date-input"
        placeholder="End Date">

    <button type="submit" class="btn-red">Apply</button>

    <a href="{{ route('dashboard') }}" class="btn-reset">Reset</a>

</form>
                    <button onclick="syncMovies()" class="btn-red sync-btn">Sync Data</button>
                </div>
            </div>

            <!-- Summary Cards -->
            <div class="row g-4 mb-4">
                <div class="col-md-3"><div class="card-custom"><div class="card-title-small">Total Movies</div><div class="card-value">{{ $totalMovies }}</div></div></div>
                <div class="col-md-3"><div class="card-custom"><div class="card-title-small">Total TV shows</div><div class="card-value">{{ $totalTv }}</div></div></div>
                <div class="col-md-3"><div class="card-custom"><div class="card-title-small">Total People</div><div class="card-value">{{ $totalPeople }}</div></div></div>
                <div class="col-md-3"><div class="card-custom"><div class="card-title-small">Last Sync</div><div class="card-value">{{ $lastSync }}</div></div></div>
            </div>

            <!-- Charts Section 1: Movies & TV -->
            <div class="row g-4">
                <!-- Pie Chart: Movie Genre Distribution -->
                <div class="col-md-4">
                    <div class="card-custom">
                        <h6 class="mb-3">Movie Genres</h6>
                        <canvas id="genreChart" style="max-height: 250px;"></canvas>
                    </div>
                </div>

                <!-- Pie Chart: TV Genre Distribution -->
                <div class="col-md-4">
                    <div class="card-custom">
                        <h6 class="mb-3">TV Genre Distribution</h6>
                        <canvas id="tvGenreChart" style="max-height: 250px;"></canvas>
                    </div>
                </div>

                <!-- Bar Chart: Top 5 Movie Genres -->
                <div class="col-md-4">
                    <div class="card-custom">
                        <h6 class="mb-3">Top 5 Movie Genres</h6>
                        <canvas id="topGenreChart" style="max-height: 250px;"></canvas>
                    </div>
                </div>
            </div>

            <!-- Charts Section 2: Trends & People -->
            <div class="row g-4 mt-2">
                <!-- Bar Chart: Top Popular People -->
                <div class="col-md-4">
                    <div class="card-custom">
                        <h6 class="mb-3">Top 5 Popular People</h6>
                        <canvas id="peopleChart" style="max-height: 250px;"></canvas>
                    </div>
                </div>

                <!-- Line Chart: Genre Trend -->
                <div class="col-md-8">
                    <div class="card-custom">
                        <h6 class="mb-3">Movie Genre Trend (Last 6 Months)</h6>
                        <canvas id="genreTrendChart" style="max-height: 250px;"></canvas>
                    </div>
                </div>
            </div>

            <!-- Latest Updates Row -->
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card-custom">
                        <div class="card-header bg-transparent border-0 px-0 d-flex justify-content-between">
                            <h5 class="mb-0">Latest Movies</h5>
                            <small class="text-muted">Newest Releases</small>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Release Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($latestMovies as $movie)
                                        <tr class="clickable-row" 
                                            data-bs-toggle="modal" data-bs-target="#detailModal"
                                            data-title="{{ $movie->title }}"
                                            data-date="{{ $movie->release_date }}"
                                            data-genre="{{ $movie->genre }}"
                                            data-overview="{{ $movie->overview ?? 'No description available.' }}"
                                            data-image="{{ $movie->poster_path ? (Str::startsWith($movie->poster_path, 'http') || Str::startsWith($movie->poster_path, '/storage') ? $movie->poster_path : 'https://image.tmdb.org/t/p/w500'.$movie->poster_path) : '' }}">
                                            <td><strong>{{ $movie->title }}</strong></td>
                                            <td><span class="badge bg-light text-dark">{{ $movie->release_date }}</span></td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="2" class="text-center">No movies found</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card-custom">
                        <div class="card-header bg-transparent border-0 px-0 d-flex justify-content-between">
                            <h5 class="mb-0">Latest TV Series</h5>
                            <small class="text-muted">Recent Air Dates</small>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>First Air Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($latestTvShows as $tv)
                                        <tr class="clickable-row"
                                            data-bs-toggle="modal" data-bs-target="#detailModal"
                                            data-title="{{ $tv->name }}"
                                            data-date="{{ $tv->first_air_date }}"
                                            data-genre="{{ $tv->genre }}"
                                            data-overview="{{ $tv->overview ?? 'No description available.' }}"
                                            data-image="{{ $tv->poster_path ? (Str::startsWith($tv->poster_path, 'http') || Str::startsWith($tv->poster_path, '/storage') ? $tv->poster_path : 'https://image.tmdb.org/t/p/w500'.$tv->poster_path) : '' }}">
                                            <td><strong>{{ $tv->name }}</strong></td>
                                            <td><span class="badge bg-light text-dark">{{ $tv->first_air_date }}</span></td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="2" class="text-center">No TV shows found</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Most Popular Row -->
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card-custom">
                        <div class="card-header bg-transparent border-0 px-0 d-flex justify-content-between">
                            <h5 class="mb-0">Popular Movies</h5>
                            <small class="text-muted">By Popularity Score</small>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Popularity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($popularMovies as $movie)
                                        <tr class="clickable-row"
                                            data-bs-toggle="modal" data-bs-target="#detailModal"
                                            data-title="{{ $movie->title }}"
                                            data-date="{{ $movie->release_date }}"
                                            data-genre="{{ $movie->genre }}"
                                            data-overview="{{ $movie->overview ?? 'No description available.' }}"
                                            data-image="{{ $movie->poster_path ? (Str::startsWith($movie->poster_path, 'http') || Str::startsWith($movie->poster_path, '/storage') ? $movie->poster_path : 'https://image.tmdb.org/t/p/w500'.$movie->poster_path) : '' }}">
                                            <td><strong>{{ $movie->title }}</strong></td>
                                            <td><span class="text-danger font-weight-bold">{{ round($movie->popularity, 1) }}</span></td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="2" class="text-center">No movies found</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card-custom">
                        <div class="card-header bg-transparent border-0 px-0 d-flex justify-content-between">
                            <h5 class="mb-0">Popular TV Series</h5>
                            <small class="text-muted">By Popularity Score</small>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Popularity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($popularTvShows as $tv)
                                        <tr class="clickable-row"
                                            data-bs-toggle="modal" data-bs-target="#detailModal"
                                            data-title="{{ $tv->name }}"
                                            data-date="{{ $tv->first_air_date }}"
                                            data-genre="{{ $tv->genre }}"
                                            data-overview="{{ $tv->overview ?? 'No description available.' }}"
                                            data-image="{{ $tv->poster_path ? (Str::startsWith($tv->poster_path, 'http') || Str::startsWith($tv->poster_path, '/storage') ? $tv->poster_path : 'https://image.tmdb.org/t/p/w500'.$tv->poster_path) : '' }}">
                                            <td><strong>{{ $tv->name }}</strong></td>
                                            <td><span class="text-danger font-weight-bold">{{ round($tv->popularity, 1) }}</span></td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="2" class="text-center">No TV shows found</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- People Table Row -->
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card-custom">
                        <div class="card-header bg-transparent border-0 px-0"><h5>Top Popular People</h5></div>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Department</th>
                                        <th>Popularity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($people as $person)
                                    <tr class="clickable-row"
                                        data-bs-toggle="modal" data-bs-target="#detailModal"
                                        data-title="{{ $person->name }}"
                                        data-date="Popularity: {{ $person->popularity }}"
                                        data-genre="{{ $person->known_for_department }}"
                                        data-overview="{{ $person->biography ?? 'Known for department: ' . $person->known_for_department }}"
                                        data-image="{{ $person->profile_path ? (Str::startsWith($person->profile_path, 'http') || Str::startsWith($person->profile_path, '/storage') ? $person->profile_path : 'https://image.tmdb.org/t/p/w500'.$person->profile_path) : '' }}">
                                        <td>{{ $person->name }}</td>
                                        <td>{{ $person->known_for_department }}</td>
                                        <td>{{ $person->popularity }}</td>
                                    </tr>
                                    @empty
                                    <tr><td colspan="3" class="text-center">No people found</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
        flatpickr("#start_date", {
        dateFormat: "Y-m-d",
        allowInput: true
    });

    flatpickr("#end_date", {
        dateFormat: "Y-m-d",
        allowInput: true
    });
    // Pie Chart Genre Distribution
    const genreChart = new Chart(document.getElementById('genreChart'), {
        type: 'pie',
        data: {
            labels: {!! json_encode($genreLabels) !!},
            datasets: [{ data: {!! json_encode($genreCounts) !!}, backgroundColor: ['#fb7185','#f43f5e','#e11d48','#be123c','#fecdd3','#fda4af'] }]
        }
    });

    // Bar Chart Top 5 Most Frequent Genres
    const top5Labels = {!! json_encode($top5GenresLabels) !!};
    const top5Data = {!! json_encode($top5GenresCounts) !!};
    const chartColors = ['#e11d48', '#fb7185', '#f43f5e', '#be123c', '#9f1239'];

    const topGenreChart = new Chart(document.getElementById('topGenreChart'), {
        type: 'bar',
        data: {
            labels: top5Labels,
            datasets: [{
                data: top5Data,
                backgroundColor: chartColors,
                borderRadius: 10,
                borderSkipped: false,
            }]
        },
        options: { 
            responsive: true,
            plugins: {
                legend: {
                    display: false // Hide the "Count" legend/filter
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return ` Count: ${context.raw}`;
                        }
                    }
                }
            },
            scales: {
                x: { 
                    grid: { display: false }
                },
                y: { 
                    beginAtZero: true,
                    grid: { color: '#f3f4f6' },
                    ticks: { precision: 0 }
                }
            }
        }
    });

    // Line Chart Genre Trend Over 6 Months
    const genreTrendChart = new Chart(document.getElementById('genreTrendChart'), {
        type: 'line',
        data: {
            labels: {!! json_encode($genreTrendLabels) !!},
            datasets: [
                @foreach ($genreTrendData as $genre => $counts)
                {
                    label: "{{ $genre }}",
                    data: {!! json_encode(array_values($counts)) !!},
                    borderColor: "#" + Math.floor(Math.random()*16777215).toString(16),
                    fill: false,
                    tension: 0.2
                },
                @endforeach
            ]
        },
        options: { responsive: true, plugins: { legend: { position: 'top' } } }
    });

    // TV Genre Distribution Chart
    new Chart(document.getElementById('tvGenreChart'), {
        type: 'pie',
        data: {
            labels: {!! json_encode($tvGenreLabels) !!},
            datasets: [{
                data: {!! json_encode($tvGenreCounts) !!},
                backgroundColor: [
                    '#fb7185', '#e11d48', '#be123c', '#9f1239', '#881337',
                    '#fda4af', '#f43f5e', '#dc2626', '#b91c1c', '#991b1b'
                ]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });

    // Popular People Chart
    new Chart(document.getElementById('peopleChart'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($peopleLabels) !!},
            datasets: [{
                label: 'Popularity Score',
                data: {!! json_encode($peoplePopularity) !!},
                backgroundColor: '#14b8a6',
                borderRadius: 8
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            plugins: {
                legend: { display: false }
            }
        }
    });

    // AJAX Sync Movies Function
    function syncMovies() {
        Swal.fire({
            title: 'Syncing Data...',
            html: 'Please wait while we fetch the latest data.',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        fetch("{{ route('sync.movies') }}", {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => {
            return response.json().then(data => {
                if (response.ok && data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sync Success!',
                        text: data.message || 'Latest movie data synced successfully.',
                        showConfirmButton: false,
                        timer: 2000
                    }).then(() => {
                        window.location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Sync Failed!',
                        text: data.message || 'An error occurred while syncing data.'
                    });
                }
            });
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Could not connect to the server or a fatal error occurred.'
            });
        });
    }

    // Modal Details Logic
    document.addEventListener('DOMContentLoaded', function() {
        const detailModal = document.getElementById('detailModal');
        if (detailModal) {
            detailModal.addEventListener('show.bs.modal', function (event) {
                const trigger = event.relatedTarget;
                const title = trigger.getAttribute('data-title');
                const date = trigger.getAttribute('data-date');
                const genre = trigger.getAttribute('data-genre');
                const overview = trigger.getAttribute('data-overview');
                const image = trigger.getAttribute('data-image');

                detailModal.querySelector('#modalTitle').textContent = title;
                detailModal.querySelector('#modalDate').textContent = date;
                detailModal.querySelector('#modalGenre').textContent = genre;
                detailModal.querySelector('#modalOverview').textContent = overview;
                
                const imgElement = detailModal.querySelector('#modalImage');
                imgElement.onerror = function() {
                    this.src = 'https://via.placeholder.com/500x750?text=No+Image';
                };
                if (image) {
                    imgElement.src = image;
                    imgElement.style.display = 'block';
                } else {
                    imgElement.src = 'https://via.placeholder.com/500x750?text=No+Image';
                    imgElement.style.display = 'block';
                }
            });
        }
    });
</script>

<!-- Detail Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title fw-bold" id="modalTitle">Detail Information</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-5">
                        <img src="" id="modalImage" class="detail-image mb-3" alt="Poster">
                    </div>
                    <div class="col-md-7">
                        <div class="mb-3">
                            <span class="badge bg-danger mb-2" id="modalGenre">Genre</span>
                            <p class="text-muted mb-1"><i class="far fa-calendar-alt me-2"></i><span id="modalDate">Release Date</span></p>
                        </div>
                        <h6 class="fw-bold">Overview</h6>
                        <p id="modalOverview" class="text-secondary" style="line-height: 1.6;"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>