<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
  public function index(Request $request)
{
    $query = Movie::query();

    if ($request->search) {
        $query->where('title', 'like', '%' . $request->search . '%');
    }

    if ($request->genre) {
        $query->where('genre', 'like', '%' . $request->genre . '%');
    }

    // DATE RANGE FILTER
    if ($request->start_date && $request->end_date) {
        $query->whereBetween('release_date', [
            $request->start_date,
            $request->end_date
        ]);
    }

    $sort = $request->get('sort', 'updated_at');
    $direction = $request->get('direction', 'desc');

    $movies = $query->orderBy($sort, $direction)->get();

    return view('movies.index', compact('movies'));
}

    public function create()
    {
        return view('movies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'genre' => 'required',
            'release_date' => 'required|date',
            'popularity' => 'required|numeric',
        ]);

        Movie::create([
            'tmdb_id' => rand(100000, 999999),
            'title' => $request->title,
            'genre' => $request->genre,
            'release_date' => $request->release_date,
            'popularity' => $request->popularity,
            'fetched_at' => now(),
        ]);

        return redirect()->route('movies.index')->with('success', 'Movie berhasil ditambahkan');
    }

    public function edit(Movie $movie)
    {
        return view('movies.edit', compact('movie'));
    }

    public function update(Request $request, Movie $movie)
    {
        $request->validate([
            'title' => 'required',
            'genre' => 'required',
            'release_date' => 'required|date',
            'popularity' => 'required|numeric',
        ]);

        $movie->update([
            'title' => $request->title,
            'genre' => $request->genre,
            'release_date' => $request->release_date,
            'popularity' => $request->popularity,
        ]);

        return redirect()->route('movies.index')->with('success', 'Movie berhasil diupdate');
    }

    public function destroy(Movie $movie)
    {
        $movie->delete();

        return redirect()->route('movies.index')->with('success', 'Movie berhasil dihapus');
    }
}