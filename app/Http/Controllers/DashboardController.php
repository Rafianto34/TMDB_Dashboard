<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
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

    $movies = $query->orderBy('release_date', 'desc')->get();

    // TOTAL MOVIES (FILTERED)
    $totalMovies = $movies->count();

    // GENRE COUNT
    $genreCount = [];
    foreach ($movies as $movie) {
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
    $latestMovie = $movies->first()->title ?? '-';

    //Genre Trend 6 Months
    $sixMonthsAgo = Carbon::now()->subMonths(6);

    $movies6Months = Movie::where('release_date', '>=', $sixMonthsAgo)->get();

    $grouped = $movies6Months->groupBy(function($movie) {
        return Carbon::parse($movie->release_date)->format('Y-m');
    });

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
    $lastSyncRecord = SyncLog::latest('last_sync_at')->first();
    $lastSync = $lastSyncRecord
        ? Carbon::parse($lastSyncRecord->last_sync_at)
            ->timezone('Asia/Jakarta')
            ->format('d M Y H:i:s')
        : '-';

    return view('dashboard', compact(
        'totalMovies',
        'topGenre',
        'latestMovie',
        'lastSync',
        'genreLabels',
        'genreCounts',
        'movies',
        'top5GenresLabels',
        'top5GenresCounts',
        'genreTrendLabels',
        'genreTrendData'
    ));
}
}