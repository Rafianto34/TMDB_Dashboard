<?php

namespace App\Http\Controllers;

use App\Models\TvShow;
use Illuminate\Http\Request;

class TvShowController extends Controller
{
    public function index(Request $request)
    {
        $query = TvShow::query();

        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->genre) {
            $query->where('genre', 'like', '%' . $request->genre . '%');
        }

        if ($request->start_date && $request->end_date) {
            $query->whereBetween('first_air_date', [$request->start_date, $request->end_date]);
        }

        $sort = $request->get('sort', 'updated_at');
        $direction = $request->get('direction', 'desc');
        $tvShows = $query->orderBy($sort, $direction)->get();

        return view('tv_shows.index', compact('tvShows'));
    }

    public function create()
    {
        return view('tv_shows.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'genre' => 'required',
            'first_air_date' => 'required|date',
            'popularity' => 'required|numeric',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'overview' => 'nullable|string',
        ]);

        $posterPath = null;
        if ($request->hasFile('poster')) {
            $posterPath = $request->file('poster')->store('posters', 'public');
            $posterPath = '/storage/' . $posterPath;
        }

        TvShow::create([
            'tmdb_id' => rand(100000, 999999),
            'name' => $request->name,
            'genre' => $request->genre,
            'first_air_date' => $request->first_air_date,
            'popularity' => $request->popularity,
            'poster_path' => $posterPath,
            'overview' => $request->overview,
        ]);

        return redirect()->route('tv_shows.index')->with('success', 'TV Show added successfully');
    }

    public function edit(TvShow $tvShow)
    {
        return view('tv_shows.edit', compact('tvShow'));
    }

    public function update(Request $request, TvShow $tvShow)
    {
        $request->validate([
            'name' => 'required',
            'genre' => 'required',
            'first_air_date' => 'required|date',
            'popularity' => 'required|numeric',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'overview' => 'nullable|string',
        ]);

        $data = $request->all();

        if ($request->hasFile('poster')) {
            $posterPath = $request->file('poster')->store('posters', 'public');
            $data['poster_path'] = '/storage/' . $posterPath;
        }

        $tvShow->update($data);

        return redirect()->route('tv_shows.index')->with('success', 'TV Show updated successfully');
    }

    public function destroy(TvShow $tvShow)
    {
        $tvShow->delete();
        return redirect()->route('tv_shows.index')->with('success', 'TV Show deleted successfully');
    }
}
