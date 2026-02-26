<!DOCTYPE html>
<html>
<head>
    <title>Edit Movie</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Flatpickr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <style>
    body { background-color: #f5f6fa; font-family: 'Segoe UI', sans-serif; }

    .sidebar { height: 100vh; background: #fff; border-right: 1px solid #e5e7eb; position: fixed; width: 16.66%; padding: 30px 20px; }
    .sidebar h4 { font-weight: 600; color: #e11d48; margin-bottom: 20px; }
    .sidebar a { color: #6b7280; text-decoration: none; padding: 12px 15px; border-radius: 10px; display: block; margin-bottom: 8px; transition: 0.2s; }
    .sidebar a:hover, .sidebar a.active { background-color: #ffe4e6; color: #e11d48; }

    .main-content { margin-left: 16.66%; padding: 30px; }

    .topbar { background: linear-gradient(90deg, #fb7185, #e11d48); padding: 20px 30px; border-radius: 15px; color: white; margin-bottom: 25px; display: flex; justify-content: space-between; align-items: center; }

    .btn-add { background-color: #fff; color: #e11d48; border: none; border-radius: 10px; padding: 10px 20px; font-weight: 600; text-decoration: none; }

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
        transition: 0.2s;
    }
    .date-input:focus {
        border-color: #e11d48;
        outline: none;
        box-shadow: 0 0 0 3px rgba(225,29,72,0.15);
    }
    
    .form-control {
        border-radius: 12px;
        border: 1px solid #e5e7eb;
        padding: 10px 15px;
        transition: 0.2s;
    }
    
    .form-control:focus {
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

    .btn-warning {
        padding: 10px 20px;
        border-radius: 10px;
        font-weight: 600;
        color: white;
    }
    
    .form-label {
        font-weight: 600;
        color: #374151;
        margin-bottom: 8px;
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
        <h2 class="mb-0">Edit Movie</h2>
        <a href="{{ route('movies.index') }}" class="btn-add">← Back</a>
    </div>

    <!-- Error Validation -->
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" style="border-radius: 15px;">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card-custom">
        <form action="{{ route('movies.update', $movie->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" value="{{ old('title', $movie->title) }}" class="form-control" placeholder="Masukkan judul movie...">
            </div>

            <div class="mb-3">
                <label class="form-label">Genre</label>
                <input type="text" name="genre" value="{{ old('genre', $movie->genre) }}" class="form-control" placeholder="Bisa dipisah koma (e.g. Action, Comedy)">
            </div>

            <div class="mb-3">
                <label class="form-label">Release Date</label>
                <input type="text" id="release_date" name="release_date" value="{{ old('release_date', $movie->release_date) }}" class="form-control date-input" placeholder="Pilih tanggal rilis">
            </div>

            <div class="mb-4">
                <label class="form-label">Popularity</label>
                <input type="number" step="0.1" name="popularity" value="{{ old('popularity', $movie->popularity) }}" class="form-control" placeholder="0.0">
            </div>

            <button type="submit" class="btn btn-warning px-4">Update Movie</button>
        </form>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    flatpickr("#release_date", {
        dateFormat: "Y-m-d",
        allowInput: true
    });
</script>
</body>
</html>