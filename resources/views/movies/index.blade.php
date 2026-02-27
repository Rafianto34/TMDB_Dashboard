<!DOCTYPE html>
<html>
<head>
    <title>Movies List</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Flatpickr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
    body { background-color: #f5f6fa; font-family: 'Segoe UI', sans-serif; }

    .sidebar { height: 100vh; background: #fff; border-right: 1px solid #e5e7eb; position: fixed; width: 16.66%; padding: 30px 20px; }
    .sidebar h4 { font-weight: 600; color: #e11d48; margin-bottom: 20px; }
    .sidebar a { color: #6b7280; text-decoration: none; padding: 12px 15px; border-radius: 10px; display: block; margin-bottom: 8px; transition: 0.2s; }
    .sidebar a:hover, .sidebar a.active { background-color: #ffe4e6; color: #e11d48; }

    .main-content { margin-left: 16.66%; padding: 30px; }

    .topbar { background: linear-gradient(90deg, #fb7185, #e11d48); padding: 20px 30px; border-radius: 15px; color: white; margin-bottom: 25px; display: flex; justify-content: space-between; align-items: center; }

    .btn-add { 
        background-color: #0d9488; 
        color: white; 
        border: none; 
        border-radius: 10px; 
        padding: 8px 15px; 
        font-weight: 600; 
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: 0.2s;
    }
    .btn-add:hover {
        background-color: #0f766e;
        color: white;
    }

    .card-custom { 
        border-radius: 18px; 
        box-shadow: 0 6px 25px rgba(0,0,0,0.05); 
        background: white; 
        padding: 30px; 
    }

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
    .flatpickr-calendar {
        border-radius: 18px !important;
        box-shadow: 0 15px 40px rgba(225, 29, 72, 0.18) !important;
        border: none !important;
        font-family: 'Segoe UI', sans-serif !important;
    }

    .flatpickr-months {
        background: linear-gradient(90deg, #fb7185, #e11d48) !important;
        border-radius: 18px 18px 0 0 !important;
    }

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


    /* ===== CENTER FILTER ===== */
    .filter-wrapper {
        max-width: 900px;
        margin: auto;
    }

    /* ===== TABLE HEADER MODERN STYLE ===== */
  .table thead th {
    background-color: white;
    border: none;
    padding: 15px;
}

.table thead th a {
    position: relative;
    color: #374151;
    text-decoration: none;
    padding: 6px 12px;
    border-radius: 999px;
    transition: 0.3s;
}

.table thead th a:hover {
    color: #e11d48;
}

.table thead th a::after {
    content: '';
    position: absolute;
    width: 0;
    height: 0;
    background-color: #ffe4e6;
    border-radius: 50%;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    transition: 0.3s ease;
    z-index: -1;
}

.table thead th a:hover::after {
    width: 100%;
    height: 100%;
}
    .table tbody tr:hover { background-color: #fff5f7; }

    .btn-edit { background-color: #fbbf24; color: white; padding: 6px 12px; border-radius: 8px; font-size: 12px; text-decoration: none; }

    .btn-delete { background-color: #dc2626; color: white; padding: 6px 12px; border-radius: 8px; font-size: 12px; border: none; }

    .btn-apply {
        background-color: #e11d48;
        color: white;
        border: none;
    }

    .btn-apply:hover {
        background-color: #be123c;
        color: white;
    }

    .btn-reset {
        background-color: #dc2626;
        color: white;
    }

    .btn-reset:hover {
        background-color: #b91c1c;
        color: white;
    }
</style>
</head>
<body>

<div class="sidebar">
    <h4>MovieApp</h4>
    <hr>
    <a href="{{ route('dashboard') }}">Dashboard</a>
    <a href="{{ route('movies.index') }}" class="active">Movies</a>
</div>

<div class="main-content">

    <div class="topbar">
        <h2 class="mb-0">Movie List</h2>
    </div>

    <!-- Alert Success dengan SweetAlert -->
    @if ($message = Session::get('success'))
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                Swal.fire({
                    icon: 'success',
                    title: 'success!',
                    text: '{{ $message }}',
                    showConfirmButton: false,
                    timer: 2500,
                    backdrop: `rgba(0,0,0,0.2)`
                });
            });
        </script>
    @endif

    <!-- FILTER -->
 <div class="card-custom mb-4">
    <div class="filter-wrapper">
        <form method="GET" action="{{ route('movies.index') }}" 
              class="row g-3 align-items-end justify-content-center">

            <div class="col-md-2">
                <input type="text" name="search" value="{{ request('search') }}" 
                       class="form-control" placeholder="Search title...">
            </div>

            <div class="col-md-2">
                <input type="text" name="genre" value="{{ request('genre') }}" 
                       class="form-control" placeholder="Genre">
            </div>

            <div class="col-md-2">
                <input type="text" id="start_date" name="start_date" value="{{ request('start_date') }}" 
                       class="form-control date-input" placeholder="Start Date">
            </div>

            <div class="col-md-2">
                <input type="text" id="end_date" name="end_date" value="{{ request('end_date') }}" 
                       class="form-control date-input" placeholder="End Date">
            </div>

            <!-- tombol sejajar -->
            <div class="col-md-4 d-flex gap-2">
                <a href="{{ route('movies.create') }}" class="btn btn-add flex-grow-1">+ Add</a>
                <button type="submit" class="btn btn-apply flex-grow-1">Apply</button>
                <a href="{{ route('movies.index') }}" class="btn btn-reset flex-grow-1">Reset</a>
            </div>

        </form>
    </div>
</div>

    <div class="mb-3"><strong>Total Movies:</strong> {{ $movies->count() }}</div>

    <div class="card-custom">
        <div class="table-responsive">
        <table class="table table-hover">

@php
    $currentSort = request('sort');
    $currentDirection = request('direction', 'desc');

    function sort_icon($column, $currentSort, $currentDirection) {
        if ($currentSort == $column) {
            return $currentDirection == 'asc' ? ' ↑' : ' ↓';
        }
        return '';
    }
@endphp

<thead>
<tr>
    <th>
        <a href="{{ route('movies.index', array_merge(request()->all(), ['sort'=>'title','direction'=> $currentSort=='title' && $currentDirection=='asc' ? 'desc' : 'asc'])) }}">
            Title{!! sort_icon('title',$currentSort,$currentDirection) !!}
        </a>
    </th>
    <th>
        <a href="{{ route('movies.index', array_merge(request()->all(), ['sort'=>'genre','direction'=> $currentSort=='genre' && $currentDirection=='asc' ? 'desc' : 'asc'])) }}">
            Genre{!! sort_icon('genre',$currentSort,$currentDirection) !!}
        </a>
    </th>
    <th>
        <a href="{{ route('movies.index', array_merge(request()->all(), ['sort'=>'release_date','direction'=> $currentSort=='release_date' && $currentDirection=='asc' ? 'desc' : 'asc'])) }}">
            Release Date{!! sort_icon('release_date',$currentSort,$currentDirection) !!}
        </a>
    </th>
    <th>
        <a href="{{ route('movies.index', array_merge(request()->all(), ['sort'=>'popularity','direction'=> $currentSort=='popularity' && $currentDirection=='asc' ? 'desc' : 'asc'])) }}">
            Popularity{!! sort_icon('popularity',$currentSort,$currentDirection) !!}
        </a>
    </th>
    <th>Action</th>
</tr>
</thead>

<tbody>
@forelse($movies as $movie)
<tr>
    <td><strong>{{ $movie->title }}</strong></td>
    <td>{{ $movie->genre }}</td>
    <td>{{ \Carbon\Carbon::parse($movie->release_date)->format('d M Y') }}</td>
    <td>{{ round($movie->popularity, 2) }}</td>
    <td>
        <a href="{{ route('movies.edit', $movie->id) }}" class="btn-edit">Edit</a>
        <!-- Form Delete dengan id unik untuk setiap movie -->
        <form id="delete-form-{{ $movie->id }}" action="{{ route('movies.destroy', $movie->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="button" class="btn-delete" onclick="confirmDelete('{{ $movie->id }}', '{{ addslashes($movie->title) }}')">Delete</button>
        </form>
    </td>
</tr>
@empty
<tr>
    <td colspan="5" class="text-center py-4">No movies found</td>
</tr>
@endforelse
</tbody>

        </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    // Init Flatpickr
    flatpickr("#start_date", {
        dateFormat: "Y-m-d",
        allowInput: true
    });

    flatpickr("#end_date", {
        dateFormat: "Y-m-d",
        allowInput: true
    });

    // SweetAlert2 Confirmation for Delete
    function confirmDelete(id, title) {
        Swal.fire({
            title: 'Delete Movie?',
            html: `You are about to delete <b>"${title}"</b>.<br>This action cannot be undone!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, Delete!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>
</body>
</html>