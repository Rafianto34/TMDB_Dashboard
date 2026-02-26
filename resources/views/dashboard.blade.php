<!DOCTYPE html>
<html>
<head>
    <title>Movie Analytics Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Flatpickr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>


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
    background: #e11d48;
    border: 1px solid #e11d48;
    color: #ffffffff;
    border-radius: 10px;
    padding: 8px 18px;
    text-decoration: none;
    transition: 0.2s;
}

.btn-reset:hover {
    background: #ffe4e6;
    color: #be123c;
}
/* =========================================
   FLATPICKR FULL FIX - PINK THEME CLEAN
========================================= */

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

/* =========================================
   DROPDOWN BULAN FIX TOTAL
========================================= */

/* Dropdown wrapper */
/* Better Month Dropdown Styling */
/* Better Month Dropdown Styling */
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
    background-color: #ffffff !important; /* White background for list */
    color: #111827 !important; /* Dark text for list */
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

/* =========================================
   WEEKDAY STYLE
========================================= */

.flatpickr-weekday {
    color: #e11d48 !important;
    font-weight: 600 !important;
}

/* =========================================
   DAY STYLE
========================================= */

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

/* =========================================
   ARROW NAVIGATION
========================================= */

.flatpickr-prev-month svg,
.flatpickr-next-month svg {
    fill: #ffffff !important;
}


        h6 { font-weight: 600; }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2 sidebar p-4">
            <h4> MovieApp</h4>
            <hr>
            <a href="{{ route('dashboard') }}" class="active">Dashboard</a>
            <a href="{{ route('movies.index') }}">Movies</a>
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
                    <a href="{{ route('sync.movies') }}" class="btn-red sync-btn">Sync Movies</a>
                </div>
            </div>

            <!-- Summary Cards -->
            <div class="row g-4 mb-4">
                <div class="col-md-3"><div class="card-custom"><div class="card-title-small">Total Movies</div><div class="card-value">{{ $totalMovies }}</div></div></div>
                <div class="col-md-3"><div class="card-custom"><div class="card-title-small">Top Genre</div><div class="card-value">{{ $topGenre }}</div></div></div>
                <div class="col-md-3"><div class="card-custom"><div class="card-title-small">Latest Movie</div><div class="card-value">{{ $latestMovie }}</div></div></div>
                <div class="col-md-3"><div class="card-custom"><div class="card-title-small">Last Sync</div><div class="card-value">{{ $lastSync }}</div></div></div>
            </div>

            <!-- Charts -->
            <div class="row g-4">
                <!-- Pie Chart: Genre Distribution -->
                <div class="col-md-6">
                    <div class="card-custom">
                        <h6 class="mb-3">Genre Distribution (1 Month)</h6>
                        <canvas id="genreChart"></canvas>
                    </div>
                </div>

                <!-- Bar Chart: Top 5 Most Frequent Genres -->
                <div class="col-md-6">
                    <div class="card-custom">
                        <h6 class="mb-3">Top 5 Most Frequent Genres</h6>
                        <canvas id="topGenreChart"></canvas>
                    </div>
                </div>

                <!-- Line Chart: Genre Trend Over 6 Months -->
                <div class="col-md-12 mt-4">
                    <div class="card-custom">
                        <h6 class="mb-3">Genre Trend Over Last 6 Months</h6>
                        <canvas id="genreTrendChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Movie Table -->
            <div class="card-custom mt-4">
                <div class="card-header bg-transparent border-0 px-0"><h5>Movie List</h5></div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Genre</th>
                                <th>Release Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($movies as $movie)
                                <tr>
                                    <td>{{ $movie->title }}</td>
                                    <td>{{ $movie->genre }}</td>
                                    <td>{{ $movie->release_date }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">No movies found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
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
    const topGenreChart = new Chart(document.getElementById('topGenreChart'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($top5GenresLabels) !!},
            datasets: [{ label: 'Count', data: {!! json_encode($top5GenresCounts) !!}, backgroundColor: '#e11d48' }]
        },
        options: { indexAxis: 'x', responsive: true }
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
</script>

</body>
</html>