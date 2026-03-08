<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\TvShow;
use App\Models\Person;
use App\Models\SyncLog;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
{
    $query = Movie::query();

    // FILTER DATE 
    if ($request->start_date && $request->end_date) {
        $query->whereBetween('release_date', [
            $request->start_date,
            $request->end_date
        ]);
    }

    $movies = $query->orderBy('release_date', 'desc')->take(10)->get();

    // TOTAL MOVIES (FILTERED)
    $totalMovies = Movie::count(); // Use absolute total for metric card

    // GENRE COUNT (Still based on all movies for accurate charts)
    $allMovies = Movie::all();
    $genreCount = [];
    foreach ($allMovies as $movie) {
        if ($movie->genre) {
            foreach (explode(',', $movie->genre) as $g) {
                $g = trim($g);
                $genreCount[$g] = ($genreCount[$g] ?? 0) + 1;
            }
        }
    }

    arsort($genreCount);

    $genreLabels = array_keys($genreCount);
    $genreCounts = array_values($genreCount);
    $topGenre = $genreLabels[0] ?? '-';

    //Top 5 Genres
    $top5 = array_slice($genreCount, 0, 5, true);
    $top5GenresLabels = array_keys($top5);
    $top5GenresCounts = array_values($top5);

    // Latest Movie (FILTERED) 
    $latestMovie = Movie::latest('release_date')->first()->title ?? '-';

    //Genre Trend 6 Months
    $sixMonthsAgo = Carbon::now()->subMonths(6);

    $movies6Months = Movie::where('release_date', '>=', $sixMonthsAgo)->get();

    $grouped = $movies6Months->groupBy(function($movie) {
        return Carbon::parse($movie->release_date)->format('Y-m');
    })->sortKeys();

    $genreTrendLabels = $grouped->keys()->toArray();

    $allGenres = [];
    foreach ($movies6Months as $movie) {
        if ($movie->genre) {
            foreach (explode(',', $movie->genre) as $g) {
                $allGenres[trim($g)] = 0;
            }
        }
    }

    $genreTrendData = [];

    foreach ($allGenres as $genre => $_) {
        $counts = [];
        foreach ($genreTrendLabels as $month) {
            $monthMovies = $grouped[$month] ?? collect();
            $count = 0;

            foreach ($monthMovies as $movie) {
                foreach(explode(',', $movie->genre) as $g) {
                    if(trim($g) === $genre) $count++;
                }
            }

            $counts[$month] = $count;
        }

        $genreTrendData[$genre] = $counts;
    }

    //  LAST SYNC 
    $lastSyncRecord = SyncLog::latest('id')->first();
    $lastSync = $lastSyncRecord
        ? Carbon::parse($lastSyncRecord->last_sync_at)
            ->timezone('Asia/Jakarta')
            ->format('d M Y H:i:s')
        : '-';

    // TV & People Metrics
    $totalTv = TvShow::count();
    $totalPeople = Person::count();

    // Data for Tables
    // Movies
    $popularMovies = Movie::orderBy('popularity', 'desc')->take(5)->get();
    $latestMovies = Movie::orderBy('release_date', 'desc')->take(5)->get();

    // TV Shows
    $popularTvShows = TvShow::orderBy('popularity', 'desc')->take(5)->get();
    $latestTvShows = TvShow::orderBy('first_air_date', 'desc')->take(5)->get();

    $people = Person::orderBy('popularity', 'desc')->take(10)->get();

    // TV Genre Distribution (Pie Chart) - based on all
    $tvGenresData = TvShow::all()->pluck('genre')
        ->flatMap(fn($g) => explode(', ', $g))
        ->filter()
        ->countBy();
    
    $tvGenreLabels = $tvGenresData->keys()->toArray();
    $tvGenreCounts = $tvGenresData->values()->toArray();

    // Top 5 Popular People (Bar Chart)
    $topPeople = Person::orderBy('popularity', 'desc')->take(5)->get();
    $peopleLabels = $topPeople->pluck('name')->toArray();
    $peoplePopularity = $topPeople->pluck('popularity')->toArray();

    return view('dashboard', compact(
        'totalMovies',
        'topGenre',
        'latestMovie',
        'lastSync',
        'genreLabels',
        'genreCounts',
        'popularMovies',
        'latestMovies',
        'popularTvShows',
        'latestTvShows',
        'people',
        'top5GenresLabels',
        'top5GenresCounts',
        'genreTrendLabels',
        'genreTrendData',
        'totalTv',
        'totalPeople',
        'tvGenreLabels',
        'tvGenreCounts',
        'peopleLabels',
        'peoplePopularity'
    ));
}
}
