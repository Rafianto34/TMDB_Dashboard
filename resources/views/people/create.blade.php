<!DOCTYPE html>
<html>
<head>
    <title>Add Person</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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

    .form-control, .form-select {
        border-radius: 12px;
        border: 1px solid #e5e7eb;
        padding: 10px 15px;
        transition: 0.2s;
    }
    
    .form-control:focus, .form-select:focus {
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
    <a href="{{ route('tv_shows.index') }}">TV Shows</a>
    <a href="{{ route('people.index') }}" class="active">People</a>
</div>
<div class="main-content">
    <div class="topbar">
        <h2 class="mb-0">Add Person</h2>
        <a href="{{ route('people.index') }}" class="btn-back">← Back</a>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger mb-4"><ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
    @endif
    <div class="card-custom">
        <form action="{{ route('people.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3"><label class="form-label">Name</label><input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Enter name"></div>
            <div class="mb-3">
                <label class="form-label">Department</label>
                <select name="known_for_department" class="form-select">
                    <option value="Acting">Acting</option>
                    <option value="Directing">Directing</option>
                    <option value="Production">Production</option>
                    <option value="Writing">Writing</option>
                </select>
            </div>
            <div class="mb-3"><label class="form-label">Popularity</label><input type="number" step="0.1" name="popularity" value="{{ old('popularity') }}" class="form-control" placeholder="0.0"></div>
            
            <div class="mb-3">
                <label class="form-label">Profile Image</label>
                <input type="file" name="profile" class="form-control" accept="image/*">
                <small class="text-muted">Max size: 2MB (jpeg, png, jpg)</small>
            </div>

            <div class="mb-4">
                <label class="form-label">Biography</label>
                <textarea name="biography" class="form-control" rows="4" placeholder="Enter person biography...">{{ old('biography') }}</textarea>
            </div>
            <button type="submit" class="btn-apply px-4">Save Person</button>
        </form>
    </div>
</div>
</body>
</html>
