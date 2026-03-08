<!DOCTYPE html>
<html>
<head>
    <title>Edit TV Show</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <style>
    <style>
    body { background-color: #f5f6fa; font-family: 'Segoe UI', sans-serif; }

    .sidebar { height: 100vh; background: #fff; border-right: 1px solid #e5e7eb; position: fixed; width: 16.66%; padding: 30px 20px; }
    .sidebar h4 { font-weight: 600; color: #e11d48; margin-bottom: 20px; }
    .sidebar a { color: #6b7280; text-decoration: none; padding: 12px 15px; border-radius: 10px; display: block; margin-bottom: 8px; transition: 0.2s; }
    .sidebar a:hover, .sidebar a.active { background-color: #ffe4e6; color: #e11d48; }

    .main-content { margin-left: 16.66%; padding: 30px; }

    .topbar { background: linear-gradient(90deg, #fb7185, #e11d48); padding: 20px 30px; border-radius: 15px; color: white; margin-bottom: 25px; display: flex; justify-content: space-between; align-items: center; }

    .btn-back { background-color: #fff; color: #e11d48; border: none; border-radius: 10px; padding: 10px 20px; font-weight: 600; text-decoration: none; }

    .card-custom { 
        border-radius: 18px; 
        box-shadow: 0 6px 25px rgba(0,0,0,0.05); 
        background: white; 
        padding: 30px; 
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

    .btn-apply {
        background-color: #e11d48;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 10px;
        font-weight: 600;
    }

    .btn-apply:hover {
        background-color: #be123c;
        color: white;
    }
    
    .form-label {
        font-weight: 600;
        color: #374151;
        margin-bottom: 8px;
    }

    /* ===== Flatpickr Custom Clean Pink Theme ===== */
    .flatpickr-calendar { border-radius: 18px !important; box-shadow: 0 15px 40px rgba(225, 29, 72, 0.18) !important; border: none !important; }
    .flatpickr-months { background: linear-gradient(90deg, #fb7185, #e11d48) !important; border-radius: 18px 18px 0 0 !important; }
    .flatpickr-current-month { color: #ffffff !important; }
    .flatpickr-day.selected { background: #e11d48 !important; border-color: #e11d48 !important; color: #ffffff !important; }
</style>
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
    <div class="topbar">
        <h2 class="mb-0">Edit TV Show</h2>
        <a href="{{ route('tv_shows.index') }}" class="btn-back">← Back</a>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger mb-4"><ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
    @endif
    <div class="card-custom">
        <form action="{{ route('tv_shows.update', $tvShow->id) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="mb-3"><label class="form-label">Name</label><input type="text" name="name" value="{{ old('name', $tvShow->name) }}" class="form-control"></div>
            <div class="mb-3"><label class="form-label">Genre</label><input type="text" name="genre" value="{{ old('genre', $tvShow->genre) }}" class="form-control"></div>
            <div class="mb-3"><label class="form-label">First Air Date</label><input type="text" id="first_air_date" name="first_air_date" value="{{ old('first_air_date', $tvShow->first_air_date) }}" class="form-control"></div>
            <div class="mb-3"><label class="form-label">Popularity</label><input type="number" step="0.1" name="popularity" value="{{ old('popularity', $tvShow->popularity) }}" class="form-control"></div>
            
            <div class="mb-3">
                <label class="form-label">Poster Image</label>
                @if($tvShow->poster_path)
                    <div class="mb-2">
                        <img src="{{ Str::startsWith($tvShow->poster_path, 'http') || Str::startsWith($tvShow->poster_path, '/storage') ? $tvShow->poster_path : 'https://image.tmdb.org/t/p/w200'.$tvShow->poster_path }}" alt="Current Poster" style="height: 100px; border-radius: 10px;">
                    </div>
                @endif
                <input type="file" name="poster" class="form-control" accept="image/*">
                <small class="text-muted">Max size: 2MB. Leave empty to keep current image.</small>
            </div>

            <div class="mb-4">
                <label class="form-label">Overview / Description</label>
                <textarea name="overview" class="form-control" rows="4" placeholder="Enter TV show description...">{{ old('overview', $tvShow->overview) }}</textarea>
            </div>
            <button type="submit" class="btn-apply px-4">Update TV Show</button>
        </form>
    </div>
</div>
<script>flatpickr("#first_air_date", { dateFormat: "Y-m-d", allowInput: true });</script>
</body>
</html>
