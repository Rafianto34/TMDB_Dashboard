<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'CineDash')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f6fa;
            font-family: 'Segoe UI', sans-serif;
        }
        .sidebar {
            height: 100vh;
            background: #ffffff;
            border-right: 1px solid #e5e7eb;
            position: fixed;
            width: 16.66%;
            padding: 30px 20px;
        }
        .sidebar h4 {
            font-weight: 600;
            color: #e11d48;
            margin-bottom: 20px;
        }
        .sidebar a {
            color: #6b7280;
            text-decoration: none;
            padding: 12px 15px;
            border-radius: 10px;
            display: block;
            margin-bottom: 8px;
            transition: 0.2s;
        }
        .sidebar a:hover,
        .sidebar a.active {
            background-color: #ffe4e6;
            color: #e11d48;
        }
        .main-content {
            margin-left: 16.66%;
            padding: 30px;
        }
        .topbar {
            background: linear-gradient(90deg, #fb7185, #e11d48);
            padding: 20px 30px;
            border-radius: 15px;
            color: white;
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .topbar h2 {
            margin: 0;
            font-weight: 600;
        }
        .btn-add {
            background-color: #fff;
            color: #e11d48;
            border: none;
            border-radius: 10px;
            padding: 10px 20px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: 0.2s;
        }
        .btn-add:hover {
            background-color: #f0f0f0;
        }
        .card-custom {
            border: none;
            border-radius: 18px;
            box-shadow: 0 6px 25px rgba(0,0,0,0.05);
            padding: 0;
            background: white;
            overflow: hidden;
        }
        .table thead {
            background: linear-gradient(90deg, #fb7185, #e11d48);
            color: white;
        }
        .table thead th {
            border: none;
            font-weight: 600;
            padding: 15px;
        }
        .table tbody td {
            padding: 15px;
            vertical-align: middle;
            border-color: #f0f0f0;
        }
        .table tbody tr:hover {
            background-color: #fff5f7;
        }
        .btn-edit {
            background-color: #fbbf24;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 12px;
            text-decoration: none;
            cursor: pointer;
            transition: 0.2s;
        }
        .btn-edit:hover {
            background-color: #f59e0b;
        }
        .btn-delete {
            background-color: #e11d48;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 12px;
            cursor: pointer;
            transition: 0.2s;
        }
        .btn-delete:hover {
            background-color: #be123c;
        }
    </style>
    @yield('extra-css')
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <div class="text-center mb-0">
        <h4 class="mb-0">CineDash</h4>
    </div>
    <hr style="border-color: #e5e7eb; margin-top: 0;">
    <a href="{{ route('dashboard') }}">Dashboard</a>
    <a href="{{ route('movies.index') }}">Movies</a>
    <a href="{{ route('tv_shows.index') }}">TV Shows</a>
    <a href="{{ route('people.index') }}">People</a>
</div>

<!-- Main Content -->
<div class="main-content">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@yield('extra-js')
</body>
</html>
