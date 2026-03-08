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
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'overview' => 'nullable|string',
        ]);

        $posterPath = null;
        if ($request->hasFile('poster')) {
            $posterPath = $request->file('poster')->store('posters', 'public');
            $posterPath = '/storage/' . $posterPath;
        }

        Movie::create([
            'tmdb_id' => rand(100000, 999999),
            'title' => $request->title,
            'genre' => $request->genre,
            'release_date' => $request->release_date,
            'popularity' => $request->popularity,
            'poster_path' => $posterPath,
            'overview' => $request->overview,
            'fetched_at' => now(),
        ]);

        return redirect()->route('movies.index')->with('success', 'Movie added successfully');
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
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'overview' => 'nullable|string',
        ]);

        $data = $request->only(['title', 'genre', 'release_date', 'popularity', 'overview']);

        if ($request->hasFile('poster')) {
            $posterPath = $request->file('poster')->store('posters', 'public');
            $data['poster_path'] = '/storage/' . $posterPath;
        }

        $movie->update($data);

        return redirect()->route('movies.index')->with('success', 'Movie updated successfully');
    }

    public function destroy(Movie $movie)
    {
        $movie->delete();

        return redirect()->route('movies.index')->with('success', 'Movie deleted successfully');
    }
}