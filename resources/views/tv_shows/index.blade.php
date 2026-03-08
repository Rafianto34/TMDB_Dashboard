<!DOCTYPE html>
<html>
<head>
    <title>TV Shows List</title>
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

    .flatpickr-current-month .flatpickr-monthDropdown-month {
        background-color: #ffffff !important;
        color: #111827 !important;
    }

    .flatpickr-weekday {
        color: #e11d48 !important;
        font-weight: 600 !important;
    }

    .flatpickr-day.selected {
        background: #e11d48 !important;
        border-color: #e11d48 !important;
        color: #ffffff !important;
    }

    .filter-wrapper {
        max-width: 900px;
        margin: auto;
    }

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
        background-color: #991b1b;
        color: white;
    }
    .btn-reset:hover {
        background-color: #7f1d1d;
        color: white;
    }

    /* Modal Styling */
    .modal-content { border-radius: 20px; border: none; box-shadow: 0 10px 40px rgba(0,0,0,0.1); }
    .modal-header { border-bottom: none; padding: 25px 25px 10px; }
    .modal-body { padding: 25px; }
    .detail-image { border-radius: 15px; width: 100%; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
    
    tr.clickable-row { cursor: pointer; transition: 0.2s; }
    tr.clickable-row:hover { background-color: #fff1f2 !important; }
</style>
</head>
<body>
<div class="sidebar">
    <div class="text-center mb-0">
        <h4 class="mb-0">CineDash</h4>
    </div>
    <hr style="margin-top: 0;">
    <a href="{{ route('dashboard') }}">Dashboard</a>
    <a href="{{ route('movies.index') }}">Movies</a>
    <a href="{{ route('tv_shows.index') }}" class="active">TV Shows</a>
    <a href="{{ route('people.index') }}">People</a>
</div>
<div class="main-content">
    <div class="topbar"><h2 class="mb-0">TV Shows List</h2></div>
    @if ($message = Session::get('success'))
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                Swal.fire({ icon: 'success', title: 'Success!', text: '{{ $message }}', showConfirmButton: false, timer: 2500 });
            });
        </script>
    @endif
    <div class="card-custom mb-4">
        <div class="filter-wrapper">
            <form method="GET" action="{{ route('tv_shows.index') }}" class="row g-3 align-items-end justify-content-center">
                <div class="col-md-2"><input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search name..."></div>
                <div class="col-md-2"><input type="text" name="genre" value="{{ request('genre') }}" class="form-control" placeholder="Genre"></div>
                <div class="col-md-2"><input type="text" id="start_date" name="start_date" value="{{ request('start_date') }}" class="form-control date-input" placeholder="Start Date"></div>
                <div class="col-md-2"><input type="text" id="end_date" name="end_date" value="{{ request('end_date') }}" class="form-control date-input" placeholder="End Date"></div>
                <div class="col-md-4 d-flex gap-2">
                    <a href="{{ route('tv_shows.create') }}" class="btn btn-add flex-grow-1">+ Add</a>
                    <button type="submit" class="btn btn-apply flex-grow-1">Apply</button>
                    <a href="{{ route('tv_shows.index') }}" class="btn btn-reset flex-grow-1">Reset</a>
                </div>
            </form>
        </div>
    </div>
    <div class="mb-3"><strong>Total TV Shows:</strong> {{ $tvShows->count() }}</div>
    <div class="card-custom">
        <div class="table-responsive">
            <table class="table table-hover">
                @php
                    $currentSort = request('sort');
                    $currentDirection = request('direction', 'desc');
                    function sort_icon($column, $currentSort, $currentDirection) {
                        if ($currentSort == $column) return $currentDirection == 'asc' ? ' ↑' : ' ↓';
                        return '';
                    }
                @endphp
                <thead>
                    <tr>
                        <th><a href="{{ route('tv_shows.index', array_merge(request()->all(), ['sort'=>'name','direction'=> $currentSort=='name' && $currentDirection=='asc' ? 'desc' : 'asc'])) }}">Name{!! sort_icon('name',$currentSort,$currentDirection) !!}</a></th>
                        <th><a href="{{ route('tv_shows.index', array_merge(request()->all(), ['sort'=>'genre','direction'=> $currentSort=='genre' && $currentDirection=='asc' ? 'desc' : 'asc'])) }}">Genre{!! sort_icon('genre',$currentSort,$currentDirection) !!}</a></th>
                        <th><a href="{{ route('tv_shows.index', array_merge(request()->all(), ['sort'=>'first_air_date','direction'=> $currentSort=='first_air_date' && $currentDirection=='asc' ? 'desc' : 'asc'])) }}">First Air Date{!! sort_icon('first_air_date',$currentSort,$currentDirection) !!}</a></th>
                        <th><a href="{{ route('tv_shows.index', array_merge(request()->all(), ['sort'=>'popularity','direction'=> $currentSort=='popularity' && $currentDirection=='asc' ? 'desc' : 'asc'])) }}">Popularity{!! sort_icon('popularity',$currentSort,$currentDirection) !!}</a></th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tvShows as $tv)
                    <tr class="clickable-row"
                        data-title="{{ $tv->name }}"
                        data-date="{{ $tv->first_air_date }}"
                        data-genre="{{ $tv->genre }}"
                        data-overview="{{ $tv->overview ?? 'No description available.' }}"
                        data-image="{{ $tv->poster_path ? (Str::startsWith($tv->poster_path, 'http') || Str::startsWith($tv->poster_path, '/storage') ? $tv->poster_path : 'https://image.tmdb.org/t/p/w500'.$tv->poster_path) : '' }}">
                        <td><strong>{{ $tv->name }}</strong></td>
                        <td>{{ $tv->genre }}</td>
                        <td>{{ $tv->first_air_date ? \Carbon\Carbon::parse($tv->first_air_date)->format('d M Y') : '-' }}</td>
                        <td>{{ round($tv->popularity, 2) }}</td>
                        <td onclick="event.stopPropagation()">
                            <a href="{{ route('tv_shows.edit', $tv->id) }}" class="btn-edit" onclick="event.stopPropagation()">Edit</a>
                            <form id="delete-form-{{ $tv->id }}" action="{{ route('tv_shows.destroy', $tv->id) }}" method="POST" style="display:inline;" onclick="event.stopPropagation()">
                                @csrf @method('DELETE')
                                <button type="button" class="btn-delete" onclick="confirmDelete('{{ $tv->id }}', '{{ addslashes($tv->name) }}')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center py-4">No TV shows found</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr("#start_date", { dateFormat: "Y-m-d", allowInput: true });
    flatpickr("#end_date", { dateFormat: "Y-m-d", allowInput: true });
    function confirmDelete(id, title) {
        Swal.fire({
            title: 'Delete TV Show?',
            html: `You are about to delete <b>"${title}"</b>.<br>This action cannot be undone!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, Delete!'
        }).then((result) => { if (result.isConfirmed) document.getElementById('delete-form-' + id).submit(); });
    }

    // Modal Details Logic
    document.addEventListener('DOMContentLoaded', function() {
        const detailModal = document.getElementById('detailModal');
        const modalInstance = new bootstrap.Modal(detailModal);

        if (detailModal) {
            // Row Click Handler
            document.querySelectorAll('.clickable-row').forEach(row => {
                row.addEventListener('click', function(e) {
                    // Check if click was on a button or within the actions cell
                    if (e.target.closest('.btn-edit') || e.target.closest('.btn-delete') || e.target.closest('td[onclick]')) {
                        return;
                    }
                    
                    const title = this.getAttribute('data-title');
                    const date = this.getAttribute('data-date');
                    const genre = this.getAttribute('data-genre');
                    const overview = this.getAttribute('data-overview');
                    const image = this.getAttribute('data-image');

                    detailModal.querySelector('#modalTitle').textContent = title;
                    detailModal.querySelector('#modalDate').textContent = date;
                    detailModal.querySelector('#modalGenre').textContent = genre;
                    detailModal.querySelector('#modalOverview').textContent = overview;
                    
                    const imgElement = detailModal.querySelector('#modalImage');
                    imgElement.onerror = function() {
                        this.src = 'https://via.placeholder.com/500x750?text=No+Image';
                    };
                    imgElement.src = image || 'https://via.placeholder.com/500x750?text=No+Image';
                    imgElement.style.display = 'block';

                    modalInstance.show();
                });
            });
        }
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

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
